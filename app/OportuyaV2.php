<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OportuyaV2 extends Model
{
        protected $table = 'CLIENTE_FAB';

    protected $fillable = ['NOMBRES', 'APELLIDOS', 'EMAIL', 'CELULAR', 'termsAndConditions', 'TIPO_DOC', 'CEDULA','PROFESION','TIPOCLIENTE','SUBTIPO','SEXO','FEC_EXP','CIUD_EXP','CIUD_UBI','DEPTO','TIPOV','TIEMPO_VIV','PROPIETARIO','DIRECCION','VRARRIENDO','TELFIJO','ESTRATO','FEC_NAC','EDAD','ESTADOCIVIL','NOMBRE_CONYU','CEDULA_C','CELULAR_CONYU','TRABAJO_CONYU','PROFESION_CONYU','CARGO_CONYU','SALARIO_CONYU','EPS_CONYU','ESTUDIOS','POSEEVEH','PLACA'];
}
