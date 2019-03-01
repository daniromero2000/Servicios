<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Analisis extends Model
{
    public $table='ANALISIS';

    public $connection='oportudata';

    protected $primaryKey= 'solicitud';

    protected $fillable=['solicitud', 'ini_analis', 'ini_ref','fec_datacli', 'fec_datacod1', 'fec_datacod2', 'valor', 'rf_fpago', 'fin_analis', 'fin_analis', 'Fin_ref', 'autoriz', 'fact_aur', 'ini_def', 'fin_def', 'fec_aur', 'aurfe_cli1', 'aurfe_cli3', 'aurfe_cli3', 'aurfe_cod1', 'aurfe_cod12', 'aurfe_cod13', 'aurfe_cod2', 'aurfe_cod21', 'aurfe_cod22', 'aurcu_cli1', 'aurcu_cli2', 'aurcu_cli3', 'aurcu_cod1', 'aurcu_cod12', 'aurcu_cod13', 'aurcu_cod2', 'scor_cli', 'scor_cli', 'scor_cod2', 'data_cli', 'data_cod1', 'data_cod2', 'rec_cod1', 'rec_cod2', 'io_cod1', 'io_cod2', 'aurcu_cod21', 'aurcu_cod22', 'vcu_cli1', 'vcu_cli2', 'vcu_cli3', 'vcu_cod1', 'vcu_cod12', 'vcu_cod13', 'vcu_cod2', 'vcu_cod21', 'vcu_cod22', 'aurcre_cli1', 'aurcre_cli2', 'aurcre_cli3', 'aurcre_cod1', 'aurcre_cod12', 'aurcre_cod13', 'aurcre_cod2', 'aurcre_cod21', 'aurcre_cod22'];
    
    public $timestamps = false;
}