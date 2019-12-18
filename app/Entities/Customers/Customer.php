<?php

namespace App\Entities\Customers;

use App\cliCel;
use App\Entities\CifinFinancialArrears\CifinFinancialArrear;
use App\Entities\CifinRealArrears\CifinRealArrear;
use App\Entities\CreditCards\CreditCard;
use App\Entities\CifinScores\CifinScore;
use App\Entities\CustomerCellPhones\CustomerCellPhone;
use App\Entities\ExtintFinancialCifins\ExtintFinancialCifin;
use App\Entities\ExtintRealCifins\ExtintRealCifin;
use App\Entities\FactoryRequests\FactoryRequest;
use App\Entities\Fosygas\Fosyga;
use App\Entities\Intentions\Intention;
use App\Entities\Ubicas\Ubica;
use App\Entities\UpToDateFinancialCifins\UpToDateFinancialCifin;
use App\Entities\UpToDateRealCifins\UpToDateRealCifin;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Customer extends Model
{

    use SearchableTrait;

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


    protected $searchable = [
        'columns' => [
            'CLIENTE_FAB.CEDULA'   => 10,
            'CLIENTE_FAB.NOMBRES'   => 10,
            'CLIENTE_FAB.APELLIDOS'   => 10,
        ],
    ];

    public function searchCustomers($term)
    {
        return self::search($term);
    }

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

    public function customersFactoryRequests()
    {
        return $this->hasMany(FactoryRequest::class, 'CLIENTE')->where('state', 'A');
    }

    public function latestIntention()
    {
        return $this->hasOne(Intention::class, 'CEDULA')->with('definition')->latest('FECHA_INTENCION');
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

    public function customerFosygas()
    {
        return $this->hasMany(Fosyga::class, 'cedula');
    }

    public function cliCell()
    {
        return $this->hasOne(cliCel::class, 'IDENTI');
    }

    public function cifinReals()
    {
        return $this->hasMany(CifinRealArrear::class, 'rmcedula')->where('rmestcon', '!=', '');
    }

    public function cifinFins()
    {
        return $this->hasMany(CifinFinancialArrear::class, 'fincedula')->where('finestcon', '!=', '');
    }

    public function UpToDateCifinFins()
    {
        return $this->hasMany(UpToDateFinancialCifin::class, 'fdcedula')->where('fdestcon', '!=', '');
    }

    public function UpToDateCifinReals()
    {
        return $this->hasMany(UpToDateRealCifin::class, 'rdcedula')->where('rdestcon', '!=', '');
    }

    public function extintsCifinReals()
    {
        return $this->hasMany(ExtintRealCifin::class, 'rexcedula')->where('rexestcon', '!=', '');
    }

    public function extintsCifinFins()
    {
        return $this->hasMany(ExtintFinancialCifin::class, 'extcedula')->where('extestcon', '!=', '');
    }

    public function customerIntentions()
    {
        return $this->hasMany(Intention::class, 'CEDULA')->with('definition');
    }
}
