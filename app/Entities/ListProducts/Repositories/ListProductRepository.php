<?php

namespace App\Entities\ListProducts\Repositories;

use App\Entities\Factors\Repositories\Interfaces\FactorRepositoryInterface;
use App\Entities\ListGiveAways\Repositories\Interfaces\ListGiveAwayRepositoryInterface;
use App\Entities\ListProducts\ListProduct;
use App\Entities\ListProducts\Repositories\Interfaces\ListProductRepositoryInterface;
use App\Entities\ProductLists\Repositories\Interfaces\ProductListRepositoryInterface;
use Illuminate\Database\QueryException;

class ListProductRepository implements ListProductRepositoryInterface
{
    private $productListInterface;
    private $giveAwayInterface;
    private $factorInterface;
    private $columns = [
        'sku',
        'item',
        'base_cost',
        'iva_cost',
        'cash_cost',
        'protection',
        'type_product',
        'min_tolerance',
        'max_tolerance',
        'type_product'
    ];

    public function __construct(
        ListProduct $ListProduct,
        ProductListRepositoryInterface $productListRepositoryInterface,
        ListGiveAwayRepositoryInterface $listGiveAwayRepositoryInterface,
        FactorRepositoryInterface $factorRepositoryInterface
    ) {
        $this->model = $ListProduct;
        $this->productListInterface = $productListRepositoryInterface;
        $this->giveAwayInterface    = $listGiveAwayRepositoryInterface;
        $this->factorInterface      = $factorRepositoryInterface;
    }


    public function createListProduct($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw $e;
        }
    }

    public function getAllListProducts()
    {
        try {
            return $this->model->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findListProductById($id)
    {
        try {
            return $this->model->find($id);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findListProductBySku($sku)
    {
        try {
            return $this->model->where('sku', $sku)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findListProductBySkuAndType($sku, $type)
    {
        try {
            return $this->model->where('sku', $sku)->where('type_product', $type)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateListProduct($data)
    {
        try {
            return $this->model->updateOrCreate(['id' => $data['id']], $data);
        } catch (QueryException $e) {
            return $e;
        }
    }

    public function deleteListProduct($id)
    {
        $data = $this->findListProductById($id);
        if ($data) {
            return $data->delete();
        }

        return [];
    }

    public function getPriceProductForAllCurrentList($product_id)
    {
        $dataProduct         = [];
        $product             = $this->findListProductById($product_id);
        $product             = $product->toArray();
        $currentProductLists = $this->productListInterface->getAllCurrentProductLists();
        $currentProductLists = $currentProductLists->toArray();
        $priceGiveAway       = $this->giveAwayInterface->getPriceGiveAwayProduct($product['iva_cost']);
        $priceGiveAway       = $priceGiveAway->total;
        $protectionVat       = $product['protection'] * 1.19;
        $factors             = $this->factorInterface->getAllFactors();
        $factors             = $factors->toArray();
        $monthlyRate         = ($factors[0]['value'] / 100);
        $bond                = 1 - ($factors[1]['value'] / 100);
        $optionalIncrement   = 1 - ($factors[2]['value'] / 100);

        $product['iva_cost'] = $product['iva_cost'] == 0 ? 1 : $product['iva_cost'];
        $percentageProtectionDividedPrice = round(($protectionVat / $product['iva_cost']) * 100, 2);
        foreach ($currentProductLists as $key => $productList) {
            if ($productList['apply_protection'] == 1) {
                $applyProteccion = $protectionVat;
                $percentageProtectionDividedPriceProteccion = $percentageProtectionDividedPrice;
            } else {
                $applyProteccion = 0;
                $percentageProtectionDividedPriceProteccion = 0;
            }
            $normalPublicPrice = round(($product['iva_cost'] + $priceGiveAway) / ((100 - $productList['public_price_percentage']) / 100) / 0.95);
            $normalPublicPrice = round(1000 * ceil($normalPublicPrice / 1000));
            if ($productList['zone'] == 'ALTA') {
                //Especial
                if ($percentageProtectionDividedPriceProteccion == 0) {
                    $percentageProtection = 0;
                } elseif ($percentageProtectionDividedPriceProteccion <= 10) {
                    $percentageProtection = 70;
                } elseif ($percentageProtectionDividedPriceProteccion > 10 && $percentageProtectionDividedPriceProteccion <= 20) {
                    $percentageProtection = 80;
                } else {
                    $percentageProtection = 90;
                }
                $cashPromotion                    = round(($product['iva_cost'] - $applyProteccion) / ((100 - $productList['cash_margin']) / 100));
                $promotionPublicPrice             = round(($product['iva_cost'] - ($applyProteccion * ($percentageProtection / 100))) / ((100 - $productList['percentage_public_price_promotion']) / 100));
                $percentagePublicPrice            = round(100 - (($promotionPublicPrice * 100) / $normalPublicPrice), 2);
                $traditionalCreditPrice           = round(($promotionPublicPrice * 1.119) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $percentageTraditionalCreditPrice = round((100 - ((($traditionalCreditPrice * 12) * 100) / ($normalPublicPrice))), 2);
                $traditionalCreditBondPrice       = round(($promotionPublicPrice * 1.119) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $basePublicPriceOportuyaCustomer  = round(($product['iva_cost'] - $applyProteccion) / ((100 - $productList['percentage_base_oportuya_customer']) / 100));
                $percentageBaseOportuyaCustomer   = round(100 - (($basePublicPriceOportuyaCustomer * 100) / $normalPublicPrice), 2);
                $bluePublicPrice                  = round($basePublicPriceOportuyaCustomer * ((100 - $productList['percentage_credit_card_blue']) / 100));
                $percentageBluePublicPrice        = round(100 - (($bluePublicPrice * 100) / $normalPublicPrice), 2);
                $blueBondPrice                    = round(($bluePublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) /  0.95);
                $blueBondOnPrice                  = round(($bluePublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $blackPublicPrice                 = round($basePublicPriceOportuyaCustomer * ((100 - $productList['percentage_credit_card_black']) / 100));
                $percentageBlackPublicPrice       = round(100 - (($blackPublicPrice * 100) / $normalPublicPrice), 2);
                $blackBondPrice                   = round(($blackPublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) /  0.95);
                $blackBondOnPrice                 = round(($blackPublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
            } elseif ($productList['zone'] == 'MEDIA') {
                //Resto del pais
                $cashPromotion                    = round(($product['iva_cost'] - $applyProteccion) / ((100 - $productList['cash_margin']) / 100));
                // $cashPromotionLowZone             = $cashPromotion;
                $promotionPublicPrice             = round((($product['iva_cost'] - ($applyProteccion * 0.5)) + $priceGiveAway) / ((100 - $productList['percentage_public_price_promotion']) / 100) / $bond);
                $percentagePublicPrice            = round(100 - (($promotionPublicPrice * 100) / $normalPublicPrice), 2);
                $traditionalCreditPrice           = round(($promotionPublicPrice * 1) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $percentageTraditionalCreditPrice = round((100 - ((($traditionalCreditPrice * 12) * 100) / ($normalPublicPrice))), 2);
                $traditionalCreditBondPrice       = round($traditionalCreditPrice * (1 - ($productList['bond_traditional'] / 100)));
                $basePublicPriceOportuyaCustomer  = round((($product['iva_cost'] - ($applyProteccion * 1.5)) + $priceGiveAway) / ((100 - $productList['percentage_base_oportuya_customer']) / 100) / $bond);
                $percentageBaseOportuyaCustomer   = round(100 - (($basePublicPriceOportuyaCustomer * 100) / $normalPublicPrice), 2);
                $bluePublicPrice                  = round($basePublicPriceOportuyaCustomer * $optionalIncrement);
                $percentageBluePublicPrice        = round(100 - (($bluePublicPrice * 100) / $normalPublicPrice), 2);
                $blueBondPrice                    = round((($bluePublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond) /  0.95);
                $blueBondOnPrice                  = round(($bluePublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond);
                $blackPublicPrice                 = round($basePublicPriceOportuyaCustomer * ((100 - $productList['percentage_credit_card_black']) / 100) * ((100 - $productList['percentage_credit_card_black']) / 100));
                $percentageBlackPublicPrice       = round(100 - (($blackPublicPrice * 100) / $normalPublicPrice), 2);
                $blackBondPrice                   = round((($blackPublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond) /  0.95);
                $blackBondOnPrice                 = round(($blackPublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond);
            } elseif ($productList['zone'] == 'BAJA') {
                //Pueblos
                $cashPromotion                    = round((($product['iva_cost'] - $applyProteccion) / ((100 - $productList['cash_margin']) / 100)) / (0.96));
                $promotionPublicPrice             = round((($product['iva_cost'] - ($applyProteccion * 0.5)) + $priceGiveAway) / ((100 - $productList['percentage_public_price_promotion']) / 100) / $bond);
                $percentagePublicPrice            = round(100 - (($promotionPublicPrice * 100) / $normalPublicPrice), 2);
                $traditionalCreditPrice           = round(($promotionPublicPrice * 1) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $percentageTraditionalCreditPrice = round((100 - ((($traditionalCreditPrice * 12) * 100) / ($normalPublicPrice))), 2);
                $traditionalCreditBondPrice       = round($traditionalCreditPrice * (1 - ($productList['bond_traditional'] / 100)));
                $basePublicPriceOportuyaCustomer  = round((($product['iva_cost'] - ($applyProteccion * 1.5)) + $priceGiveAway) / ((100 - $productList['percentage_base_oportuya_customer']) / 100) / $bond);
                $percentageBaseOportuyaCustomer   = round(100 - (($basePublicPriceOportuyaCustomer * 100) / $normalPublicPrice), 2);
                $bluePublicPrice                  = round($basePublicPriceOportuyaCustomer * $optionalIncrement);
                $percentageBluePublicPrice        = round(100 - (($bluePublicPrice * 100) / $normalPublicPrice), 2);
                $blueBondPrice                    = round((($bluePublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond) /  0.95);
                $blueBondOnPrice                  = round(($bluePublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond);
                $blackPublicPrice                 = round($basePublicPriceOportuyaCustomer * ((100 - $productList['percentage_credit_card_black']) / 100) * ((100 - $productList['percentage_credit_card_black']) / 100));
                $percentageBlackPublicPrice       = round(100 - (($blackPublicPrice * 100) / $normalPublicPrice), 2);
                $blackBondPrice                   = round(($blackPublicPrice * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond) /  0.95);
                $blackBondOnPrice                 = round($blackPublicPrice * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond);
            } else if ($productList['zone'] == 'VOLANTE ESPECIAL') {
                //Volante Especial
                if ($percentageProtectionDividedPriceProteccion == 0) {
                    $percentageProtection = 0;
                } elseif ($percentageProtectionDividedPriceProteccion <= 10) {
                    $percentageProtection = 70;
                } elseif ($percentageProtectionDividedPriceProteccion > 10 && $percentageProtectionDividedPriceProteccion <= 20) {
                    $percentageProtection = 80;
                } else {
                    $percentageProtection = 90;
                }
                $cost = $product['iva_cost'] + 30000;
                $cashPromotion                    = round(($cost - $applyProteccion) / ((100 - $productList['cash_margin']) / 100));
                $promotionPublicPrice             = round(($cost - ($applyProteccion * ($percentageProtection / 100))) / ((100 - $productList['percentage_public_price_promotion']) / 100));;
                $percentagePublicPrice            = round(100 - (($promotionPublicPrice * 100) / $normalPublicPrice), 2);
                $traditionalCreditPrice           = round(($promotionPublicPrice * 1.119) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $percentageTraditionalCreditPrice = round((100 - ((($traditionalCreditPrice * 12) * 100) / ($normalPublicPrice))), 2);
                $traditionalCreditBondPrice       = round(($promotionPublicPrice * 1.119) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $basePublicPriceOportuyaCustomer  = round(($cost - $applyProteccion) / ((100 - $productList['percentage_base_oportuya_customer']) / 100));
                $percentageBaseOportuyaCustomer   = round(100 - (($basePublicPriceOportuyaCustomer * 100) / $normalPublicPrice), 2);
                $bluePublicPrice                  = round($basePublicPriceOportuyaCustomer * ((100 - $productList['percentage_credit_card_blue']) / 100));
                $percentageBluePublicPrice        = round(100 - (($bluePublicPrice * 100) / $normalPublicPrice), 2);
                $blueBondPrice                    = round(($bluePublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) /  0.95);
                $blueBondOnPrice                  = round(($bluePublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $blackPublicPrice                 = round($basePublicPriceOportuyaCustomer * ((100 - $productList['percentage_credit_card_black']) / 100));
                $percentageBlackPublicPrice       = round(100 - (($blackPublicPrice * 100) / $normalPublicPrice), 2);
                $blackBondPrice                   = round(($blackPublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) /  0.95);
                $blackBondOnPrice                 = round(($blackPublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
            } else {
                //Volanteo
                $cashPromotion                    = round(($product['iva_cost'] - $applyProteccion) / ((100 - $productList['cash_margin']) / 100));
                $promotionPublicPrice             = round(($product['iva_cost'] - ($applyProteccion * 0.5)) / ((100 - $productList['percentage_public_price_promotion']) / 100) / $bond, -1, PHP_ROUND_HALF_UP);
                // dd($promotionPublicPrice, $normalPublicPrice);
                $percentagePublicPrice            = round(100 - (($promotionPublicPrice * 100) / $normalPublicPrice), 2);
                $traditionalCreditPrice           = round(($promotionPublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $percentageTraditionalCreditPrice = round((100 - ((($traditionalCreditPrice * 12) * 100) / ($normalPublicPrice))), 2);
                $traditionalCreditBondPrice       = round(($promotionPublicPrice * 0.95) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $basePublicPriceOportuyaCustomer  = round(($product['iva_cost'] - ($applyProteccion * 1.5)) / ((100 - $productList['percentage_base_oportuya_customer']) / 100) / $bond);
                $percentageBaseOportuyaCustomer   = round(100 - (($basePublicPriceOportuyaCustomer * 100) / $normalPublicPrice), 2);
                $bluePublicPrice                  = round($basePublicPriceOportuyaCustomer * ((100 - $productList['percentage_credit_card_blue']) / 100));
                $percentageBluePublicPrice        = round(100 - (($bluePublicPrice * 100) / $normalPublicPrice), 2);
                $blueBondPrice                    = round((($bluePublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond) /  0.95);
                $blueBondOnPrice                  = round(($bluePublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond);
                $blackPublicPrice                 = round($basePublicPriceOportuyaCustomer * ((100 - $productList['percentage_credit_card_black']) / 100));
                $percentageBlackPublicPrice       = round(100 - (($blackPublicPrice * 100) / $normalPublicPrice), 2);
                $blackBondPrice                   = round((($blackPublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond) /  0.95);
                $blackBondOnPrice                 = round(($blackPublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond);
            }

            $dataProduct[$productList['name']] = [
                'normal_public_price'                 => $normalPublicPrice,
                'cash_promotion'                      => $cashPromotion,
                'promotion_public_price'              => $promotionPublicPrice,
                'percentage_promotion_public_price'   => $percentagePublicPrice,
                'traditional_credit_price'            => $traditionalCreditPrice * 12,
                'percentage_traditional_credit_price' => $percentageTraditionalCreditPrice,
                'traditional_credit_bond_price'       => $traditionalCreditBondPrice * 12,
                'base_public_price_oportuya_customer' => round($basePublicPriceOportuyaCustomer, -1, PHP_ROUND_HALF_UP),
                'percentage_oportuya_customer'        => $percentageBaseOportuyaCustomer,
                'blue_public_price'                   => $bluePublicPrice,
                'percentage_blue_public_price'        => $percentageBluePublicPrice,
                'blue_bond_price'                     => $blueBondPrice * 12,
                'blue_bond_on_price'                  => $blueBondOnPrice * 12,
                'black_public_price'                  => $blackPublicPrice,
                'percentage_black_public_price'       => $percentageBlackPublicPrice,
                'black_bond_price'                    => $blackBondPrice * 12,
                'black_bond_on_price'                 => $blackBondOnPrice * 12,
                'zone'                                => $productList['zone'],
                'apply_gift'                          => $productList['apply_gift'],
            ];
        }

        return $dataProduct;
    }

    private function extractPrices($listPrices, $prices)
    {
        $data = [];
        if (count($prices) > 0) {
            foreach ($listPrices as $listName => $listPrice) {
                foreach ($prices as $price) {
                    $data[$listName][$price] = $listPrice[$price];
                }
            }
        } else {
            $data = $listPrices;
        }

        return $data;
    }

    public function getPriceProductForAllCurrentListEspecifiedPrices($product_id, $prices = [])
    {

        $listPrices = $this->getPriceProductForAllCurrentList($product_id);
        $data = $this->extractPrices($listPrices, $prices);
        return $data;
    }

    public function getPriceProductForZone($product_id, $zone)
    {
        $data = [];
        $listPrices = $this->getPriceProductForAllCurrentList($product_id);
        if ($zone == 'MEDIA' || $zone == 'BAJA') {
            $list = $this->productListInterface->getCurrentProductListsForZone('VOLANTE');
            if (!empty($list->toArray())) {
                $data[$list[0]->name] = $listPrices[$list[0]->name];
                return $data;
            }
        }

        $list = $this->productListInterface->getCurrentProductListsForZone($zone);
        $data[$list[0]->name] = $listPrices[$list[0]->name];
        return $data;
    }

    public function getPriceProductForList($product_id, $list)
    {
        $data = [];
        $listPrices = $this->getPriceProductForAllCurrentList($product_id);
        $list = $this->productListInterface->getCurrentProductListsForName($list);
        $data[$list[0]->name] = $listPrices[$list[0]->name];
        return $data;
    }

    public function getPriceProductForCatalogo($product_id, $zone)
    {
        $data = [];
        $listPrices = $this->getPriceProductForAllCurrentList($product_id);
        if ($zone == 'MEDIA' || $zone == 'BAJA') {
            $list = $this->productListInterface->getProductListsForTheCatalog('VOLANTE');
            if (!empty($list->toArray())) {
                $data[$list[0]->name] = $listPrices[$list[0]->name];
                return $data;
            }
        }

        $list = $this->productListInterface->getProductListsForTheCatalog($zone);
        $data[$list[0]->name] = $listPrices[$list[0]->name];
        return $data;
    }

    public function getPriceProductForZoneEspecifiedPrices($product_id, $zone, $prices = [])
    {
        $listPrices = $this->getPriceProductForZone($product_id, $zone);

        return $this->extractPrices($listPrices, $prices);
    }
}
