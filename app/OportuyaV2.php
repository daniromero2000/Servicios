<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OportuyaV2 extends Model
{
    public $connection='oportudata';
    
    protected $table = 'CLIENTE_FAB';

    protected $primaryKey = 'CEDULA';

    public $timestamps = false;

    protected $fillable = ['NOMBRES', 'APELLIDOS', 'EMAIL', 'CELULAR', 'termsAndConditions', 'TIPO_DOC', 'CEDULA','PROFESION','TIPOCLIENTE','SUBTIPO','SEXO','FEC_EXP','CIUD_EXP','CIUD_UBI','DEPTO','TIPOV','TIEMPO_VIV','PROPIETARIO','DIRECCION','VRARRIENDO','TELFIJO','ESTRATO','FEC_NAC','EDAD','ESTADOCIVIL','NOMBRE_CONYU','CEDULA_C','CELULAR_CONYU','TRABAJO_CONYU','PROFESION_CONYU','CARGO_CONYU','SALARIO_CONYU','EPS_CONYU','ESTUDIOS','POSEEVEH','PLACA', 'STATE', 'SUC', 'CREACION', 'ACTIVIDAD', 'PERSONAS', 'TEL_PROP', 'VARRIENDO', 'N_EMPLEA', 'VENTASMES', 'COSTOSMES', 'GASTOS', 'DEUDAMES', 'TEL3', 'TEL4', 'TEL5', 'TEL6', 'TEL7', 'DIRECCION2', 'DIRECCION3', 'DIRECCION4', 'CIUD_NAC', 'NOTA1', 'NOTA2', 'CON3', 'ORIGEN', 'ESTADO', 'PASO'];
}
