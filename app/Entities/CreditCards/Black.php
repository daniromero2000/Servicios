<?php

namespace App\Entities\CreditCards;

use Illuminate\Database\Eloquent\Model;

class Black extends Model
{
    private  $name, $quotaApprovedProduct, $quotaApprovedAdvance;

    public function __construct()
    {
        $this->name              = "Tarjeta Black";
        $this->quotaApprovedProduct = 1900000;
        $this->quotaApprovedAdvance = 500000;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getQuotaApprovedProduct()
    {
        return $this->quotaApprovedProduct;
    }

    public function getQuotaApprovedAdvance()
    {
        return $this->quotaApprovedAdvance;
    }
}
