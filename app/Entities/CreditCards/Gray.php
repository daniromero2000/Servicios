<?php

namespace App\Entities\CreditCards;

use Illuminate\Database\Eloquent\Model;

class Gray extends Model
{
    private  $name, $quotaApprovedProduct, $quotaApprovedAdvance;

    public function __construct()
    {
        $this->name              = "Tarjeta Gray";
        $this->quotaApprovedProduct = 1600000;
        $this->quotaApprovedAdvance = 200000;
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
