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
        'protection',
        'min_tolerance',
        'max_tolerance',
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
<<<<<<< HEAD
<<<<<<< HEAD
}
=======
=======
>>>>>>> e0b9b72037d270bde3fe017da725cfc68b793823

    public function getPriceProductForAllCurrentList($product_id)
    {
        $dataProduct = [];
        $product = $this->findListProductById($product_id);
        $product = $product->toArray();
        $currentProductLists = $this->productListInterface->getAllCurrentProductLists();
        $currentProductLists = $currentProductLists->toArray();
        $priceGiveAway = $this->giveAwayInterface->getPriceGiveAwayProduct($product['base_cost']);
        $priceGiveAway = $priceGiveAway->total;
        $protectionVat = $product['protection'] * 1.19;
        $factors = $this->factorInterface->getAllFactors();
        $factors = $factors->toArray();
        $monthlyRate = ($factors[0]['value'] / 100);
        $bond = 1 - ($factors[1]['value'] / 100);
        $optionalIncrement = 1 - ($factors[2]['value'] / 100);
        $cashPromotionLowZone = 0;
        $percentageProtectionDividedPrice = round(($protectionVat / $product['iva_cost']) * 100, 2);
        foreach ($currentProductLists as $key => $productList) {
            if ($productList['apply_protection'] == 1) {
                $protectionVat = $protectionVat;
                $percentageProtectionDividedPrice = $percentageProtectionDividedPrice;
            } else {
                $protectionVat = 0;
                $percentageProtectionDividedPrice = 0;
            }
            $normalPublicPrice = round(($product['iva_cost'] + $priceGiveAway) / ((100 - $productList['public_price_percentage']) / 100) / 0.95);
            if ($productList['zone'] == 'MEDIA') {
                if ($percentageProtectionDividedPrice == 0) {
                    $percentageProtection = 0;
                } elseif ($percentageProtectionDividedPrice <= 10) {
                    $percentageProtection = 70;
                } elseif ($percentageProtectionDividedPrice > 10 && $percentageProtectionDividedPrice <= 20) {
                    $percentageProtection = 80;
                } else {
                    $percentageProtection = 90;
                }
                $cashPromotion                   = round(($product['iva_cost'] - $protectionVat) / ((100 - $productList['cash_margin']) / 100));
                $promotionPublicPrice            = round(($product['iva_cost'] - ($protectionVat * ($percentageProtection / 100))) / ((100 - $productList['percentage_public_price_promotion']) / 100));;
                $traditionalCreditPrice          = round(($promotionPublicPrice * 1.119) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $traditionalCreditBondPrice      = round(($promotionPublicPrice * 1.119) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $basePublicPriceOportuyaCustomer = round(($product['iva_cost'] - $protectionVat) / ((100 - $productList['percentage_base_oportuya_customer']) / 100));
                $bluePublicPrice                 = round($basePublicPriceOportuyaCustomer * ((100 - $productList['percentage_credit_card_blue']) / 100));
                $blueBondPrice                   = round(($bluePublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $blackPublicPrice                = round($basePublicPriceOportuyaCustomer * ((100 - $productList['percentage_credit_card_black']) / 100));
                $blackBondPrice                  = round(($blackPublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
            } elseif ($productList['zone'] == 'BAJA') {
                $cashPromotion                   = round(($product['iva_cost'] - $protectionVat) / ((100 - $productList['cash_margin']) / 100));
                $cashPromotionLowZone            = $cashPromotion;
                $promotionPublicPrice            = round((($product['iva_cost'] - ($protectionVat * 0.5)) + $priceGiveAway) / ((100 - $productList['percentage_public_price_promotion']) / 100) / $bond);
                $traditionalCreditPrice          = round(($promotionPublicPrice * 1) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $traditionalCreditBondPrice      = round($traditionalCreditPrice * (1 - ($productList['bond_traditional'] / 100)));
                $basePublicPriceOportuyaCustomer = round((($product['iva_cost'] - ($protectionVat * 1.5)) + $priceGiveAway) / ((100 - $productList['percentage_base_oportuya_customer']) / 100) / $bond);
                $bluePublicPrice                 = round($basePublicPriceOportuyaCustomer * $optionalIncrement);
                $blueBondPrice                   = round(($bluePublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond);
                $blackPublicPrice                = round($basePublicPriceOportuyaCustomer * ((100 - $productList['percentage_credit_card_black']) / 100) * ((100 - $productList['percentage_credit_card_black']) / 100));
                $blackBondPrice                  = round(($blackPublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond);
            } else {
                $cashPromotion                   = round($cashPromotionLowZone / ((100 - $productList['cash_margin']) / 100));
                $promotionPublicPrice            = round((($product['iva_cost'] - ($protectionVat * 0.5)) + $priceGiveAway) / ((100 - $productList['percentage_public_price_promotion']) / 100) / $bond);
                $traditionalCreditPrice          = round(($promotionPublicPrice * 1) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))));
                $traditionalCreditBondPrice      = round($traditionalCreditPrice * (1 - ($productList['bond_traditional'] / 100)));
                $basePublicPriceOportuyaCustomer = round((($product['iva_cost'] - ($protectionVat * 1.5)) + $priceGiveAway) / ((100 - $productList['percentage_base_oportuya_customer']) / 100) / $bond);
                $bluePublicPrice                 = round($basePublicPriceOportuyaCustomer * $optionalIncrement);
                $blueBondPrice                   = round(($bluePublicPrice) * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond);
                $blackPublicPrice                = round($basePublicPriceOportuyaCustomer * ((100 - $productList['percentage_credit_card_black']) / 100) * ((100 - $productList['percentage_credit_card_black']) / 100));
                $blackBondPrice                  = round($blackPublicPrice * ($monthlyRate / (1 - pow((1 + $monthlyRate), -12))) * $bond);
            }

            $dataProduct[$productList['name']] = [
                'normal_public_price'                 => $normalPublicPrice,
                'cash_promotion'                      => $cashPromotion,
                'promotion_public_price'              => $promotionPublicPrice,
                'traditional_credit_price'            => $traditionalCreditPrice * 12,
                'traditional_credit_bond_price'       => $traditionalCreditBondPrice * 12,
                'base_public_price_oportuya_customer' => $basePublicPriceOportuyaCustomer,
                'blue_public_price'                   => $bluePublicPrice,
                'blue_bond_price'                     => $blueBondPrice * 12,
                'black_public_price'                  => $blackPublicPrice,
                'black_bond_price'                    => $blackBondPrice * 12,
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

        $list = $this->productListInterface->getCurrentProductListsForZone($zone);
        $listPrices = $this->getPriceProductForAllCurrentList($product_id);
        $data[$list[0]->name] = $listPrices[$list[0]->name];

        return $data;
    }

    public function getPriceProductForZoneEspecifiedPrices($product_id, $zone, $prices = [])
    {
        $listPrices = $this->getPriceProductForZone($product_id, $zone);

        return $this->extractPrices($listPrices, $prices);
    }
<<<<<<< HEAD
}
>>>>>>> 2807f8870ec76370f84a241f431e8464d683fdae
=======
}
>>>>>>> e0b9b72037d270bde3fe017da725cfc68b793823
