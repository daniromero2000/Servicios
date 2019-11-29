<?php

namespace App\Entities\Customers;

use App\Entities\CreditCards\CreditCard;
use App\Entities\CifinScores\CifinScore;
use App\Entities\CustomerCellPhones\CustomerCellPhone;
use App\Entities\FactoryRequests\FactoryRequest;
use App\Entities\Intentions\Intention;
use App\Entities\Ubicas\Ubica;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'CLIENTE_FAB';

    protected $connection = 'oportudata';

    protected $primaryKey = 'CEDULA';

    public $timestamps = false;

    protected $fillable = [
        'NOMBRES',
        'APELLIDOS',
        'EMAIL',
        'CELULAR',
        'termsAndConditions',
        'TIPO_DOC',
        'CEDULA',
        'PROFESION',
        'TIPOCLIENTE',
        'SUBTIPO',
        'SEXO',
        'FEC_EXP',
        'CIUD_EXP',
        'CIUD_UBI',
        'DEPTO',
        'TIPOV',
        'TIEMPO_VIV',
        'PROPIETARIO',
        'DIRECCION',
        'VRARRIENDO',
        'TELFIJO',
        'ESTRATO',
        'FEC_NAC',
        'EDAD',
        'ESTADOCIVIL',
        'NOMBRE_CONYU',
        'CEDULA_C',
        'CELULAR_CONYU',
        'TRABAJO_CONYU',
        'PROFESION_CONYU',
        'CARGO_CONYU',
        'SALARIO_CONYU',
        'EPS_CONYU',
        'ESTUDIOS',
        'POSEEVEH',
        'PLACA',
        'STATE',
        'SUC',
        'CREACION',
        'ACTIVIDAD',
        'PERSONAS',
        'TEL_PROP',
        'VARRIENDO',
        'N_EMPLEA',
        'VENTASMES',
        'COSTOSMES',
        'GASTOS',
        'DEUDAMES',
        'TEL3',
        'TEL4',
        'TEL5',
        'TEL6',
        'TEL7',
        'DIRECCION2',
        'DIRECCION3',
        'DIRECCION4',
        'CIUD_NAC',
        'NOTA1',
        'NOTA2',
        'CON3',
        'ORIGEN',
        'ESTADO',
        'PASO',
        'RAZON_SOC',
        'FEC_ING',
        'ANTIG',
        'CARGO',
        'DIR_EMP',
        'TEL_EMP',
        'TIPO_CONT',
        'SUELDO',
        'NIT_IND',
        'RAZON_IND',
        'ACT_IND',
        'EDAD_INDP',
        'FEC_CONST',
        'OTROS_ING',
        'SUELDOIND',
        'VCON_NOM1',
        'VCON_CED1',
        'VCON_TEL1',
        'VCON_NOM2',
        'VCON_CED2',
        'VCON_TEL2',
        'MEDIO_PAGO',
        'TRAT_DATOS',
        'BANCOP',
        'ACT_ECO',
        'CAMARAC',
        'ID_CIUD_EXP',
        'ID_CIUD_NAC',
        'ID_CIUD_UBI',
        'VCON_DIR',
        'MIGRADO',
        'CLIENTE_WEB',
        'MIGRADO',
        'TRAT_DATOS',
        'USUARIO_ACTUALIZACION',
        'USUARIO_CREACION',
        'FECHA_ACTUALIZACION'
    ];

    protected $hidden = [
        'CON1',
        'USU',
        'CON2',
        'TEL2_EMP',
        'termsAndConditions',
        'NIT_EMP',
        'PROFESION',
        'SUBTIPO',
        'SEXO',
        'CIUD_EXP',
        'TARJETA_OP',
        'DEPTO',
        'TIEMPO_VIV',
        'VRARRIENDO',
        'ESTRATO',
        'EDAD',
        'NOMBRE_CONYU',
        'CEDULA_C',
        'CELULAR_CONYU',
        'TRABAJO_CONYU',
        'PROFESION_CONYU',
        'CARGO_CONYU',
        'SALARIO_CONYU',
        'EPS_CONYU',
        'ESTUDIOS',
        'POSEEVEH',
        'PLACA',
        'STATE',
        'CREACION',
        'PERSONAS',
        'TEL_PROP',
        'VARRIENDO',
        'N_EMPLEA',
        'VENTASMES',
        'COSTOSMES',
        'GASTOS',
        'DEUDAMES',
        'TEL3',
        'TEL4',
        'TEL5',
        'TEL6',
        'TEL7',
        'DIRECCION2',
        'DIRECCION3',
        'DIRECCION4',
        'CIUD_NAC',
        'NOTA1',
        'NOTA2',
        'CON3',
        'ORIGEN',
        'PASO',
        'RAZON_SOC',
        'FEC_ING',
        'ANTIG',
        'CARGO',
        'DIR_EMP',
        'TEL_EMP',
        'TIPO_CONT',
        'NIT_IND',
        'RAZON_IND',
        'EDAD_INDP',
        'FEC_CONST',
        'VCON_NOM1',
        'VCON_CED1',
        'VCON_TEL1',
        'VCON_NOM2',
        'VCON_CED2',
        'VCON_TEL2',
        'MEDIO_PAGO',
        'TRAT_DATOS',
        'BANCOP',
        'ACT_ECO',
        'CAMARAC',
        'ID_CIUD_EXP',
        'ID_CIUD_NAC',
        'ID_CIUD_UBI',
        'VCON_DIR',
        'MIGRADO',
        'CLIENTE_WEB',
        'MIGRADO',
        'TRAT_DATOS',
        'USUARIO_ACTUALIZACION',
        'USUARIO_CREACION',
        'FECHA_ACTUALIZACION'
    ];

    public function latestCifinScore()
    {
        return $this->hasOne(CifinScore::class, 'scocedula')->latest('scoconsul');
    }

    public function creditCard()
    {
        return $this->hasOne(CreditCard::class, 'CLIENTE');
    }

    public function hasFactoryRequests()
    {
        return $this->hasOne(FactoryRequest::class, 'CLIENTE');
    }

    public function factoryRequests()
    {
        return $this->hasOne(FactoryRequest::class, 'CLIENTE')->where('ESTADO', 'APROBADO')->where('GRAN_TOTAL', 0)->where('SOLICITUD_WEB', 1)->latest('FECHASOL');
    }

    public function latestIntention()
    {
        return $this->hasOne(Intention::class, 'CEDULA')->latest('FECHA_INTENCION');
    }

    public function ubicaConsultations()
    {
        return $this->hasMany(Ubica::class, 'cedula');
    }

    public function lastUbicaConsultation()
    {
        return $this->hasOne(Ubica::class, 'cedula');
    }

    public function checkedPhone()
    {
        return $this->hasOne(CustomerCellPhone::class, 'IDENTI')->where('CEL_VAL', 1);
    }
}
