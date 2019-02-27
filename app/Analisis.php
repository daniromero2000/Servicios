<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analisis extends Model
{
    public $table='ANALISIS';

    public $connection='oportudata';

    protected $primaryKey= 'solicitud';

    protected $fillable=['solicitud', 'ini_analis', 'ini_ref','fec_datacli', 'fec_datacod1', 'fec_datacod2', 'valor', 'rf_fpago', 'fin_analis', 'fin_analis', 'Fin_ref', 'autoriz', 'fact_aur', 'ini_def', 'fin_def', 'fec_aur', 'aurfe_cli1', 'aurfe_cli3', 'aurfe_cli3', 'aurfe_cod1', 'aurfe_cod12', 'aurfe_cod13', 'aurfe_cod2', 'aurfe_cod21', 'aurfe_cod22', 'aurcu_cli1', 'aurcu_cli2', 'aurcu_cli3', 'aurcu_cod1', 'aurcu_cod12', 'aurcu_cod13', 'aurcu_cod2', 'scor_cli', 'scor_cli', 'scor_cod2'];
    
    public $timestamps = false;
}