<?php

namespace App\Entities\Customers;

use App\cliCel;
use App\Entities\CifinBasicDatas\CifinBasicData;
use App\Entities\CifinFinancialArrears\CifinFinancialArrear;
use App\Entities\CifinRealArrears\CifinRealArrear;
use App\Entities\CreditCards\CreditCard;
use App\Entities\CifinScores\CifinScore;
use App\Entities\CifinWebServices\CifinWebService;
use App\Entities\ConfrontaFootprints\ConfrontaFootprint;
use App\Entities\ConfrontaResults\ConfrontaResult;
use App\Entities\ConfrontaWebServices\Confronta;
use App\Entities\CustomerCellPhones\CustomerCellPhone;
use App\Entities\DebtorInsuranceOportuyas\DebtorInsuranceOportuya;
use App\Entities\DebtorInsurances\DebtorInsurance;
use App\Entities\ExtintFinancialCifins\ExtintFinancialCifin;
use App\Entities\ExtintRealCifins\ExtintRealCifin;
use App\Entities\FactoryRequests\FactoryRequest;
use App\Entities\Ruafs\Ruaf;
use App\Entities\Fosygas\Fosyga;
use App\Entities\Intentions\Intention;
use App\Entities\Registradurias\Registraduria;
use App\Entities\Ubicas\Ubica;
use App\Entities\UpToDateFinancialCifins\UpToDateFinancialCifin;
use App\Entities\UpToDateRealCifins\UpToDateRealCifin;
use App\Entities\Warranties\Warranty;
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
        'NOMBRES', 'APELLIDOS', 'EMAIL',  'CELULAR', 'termsAndConditions',
        'TIPO_DOC', 'CEDULA',
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

    protected $hidden = [];


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
        return $this->hasOne(Intention::class, 'CEDULA')->with('definition')->orderBy('FECHA_INTENCION', 'DESC');
    }

    public function Intentions()
    {
        return $this->hasMany(Intention::class, 'CEDULA')->with('definition');
    }

    public function ubicaConsultations()
    {
        return $this->hasMany(Ubica::class, 'cedula')->with(['ubicaLastCellPhone', 'ubicaLastPhone', 'ubicAddress', 'ubicEmails', 'ubicPrincipal']);
    }

    public function lastUbicaConsultation()
    {
        return $this->hasOne(Ubica::class, 'cedula')->latest('fecha');
    }

    public function checkedPhone()
    {
        return $this->hasOne(CustomerCellPhone::class, 'IDENTI')->where('CEL_VAL', 1);
    }

    public function customerFosygas()
    {
        return $this->hasMany(Fosyga::class, 'cedula')->orderBy('fechaConsulta', 'DESC');
    }

    public function customerRegistraduria()
    {
        return $this->hasMany(Registraduria::class, 'cedula')->orderBy('fechaConsulta', 'DESC');
    }

    public function customerConfronta()
    {
        return $this->hasMany(ConfrontaResult::class, 'cedula');
    }

    public function confrontaFootprint()
    {
        return $this->hasMany(ConfrontaFootprint::class, 'cedula');
    }
    public function DebtorInsurance()
    {
        return $this->hasMany(DebtorInsurance::class, 'CEDULA')->orderBy('FECHA', 'DESC');
    }
    public function DebtorInsuranceOportuya()
    {
        return $this->hasMany(DebtorInsuranceOportuya::class, 'CEDULA')->orderBy('FECHA', 'DESC');
    }
    public function cliCell()
    {
        return $this->hasOne(cliCel::class, 'IDENTI');
    }

    public function fosygaRuaf()
    {
        return $this->hasMany(Ruaf::class, 'cedula');
    }

    public function cifinReals()
    {
        return $this->hasMany(CifinRealArrear::class, 'rmcedula')->where('rmestcon', '!=', '');
    }

    public function cifinFins()
    {
        return $this->hasMany(CifinFinancialArrear::class, 'fincedula')->where('finestcon', '!=', '');
    }

    public function cifinWebService()
    {
        return $this->hasMany(CifinWebService::class, 'cedula')->with('cifinRealArrear', 'cifinFinancialArrear', 'upToDateFinancialCifin', 'upToDateRealCifin', 'extintRealCifin', 'extintFinancialCifin', 'cifinFrootprint');
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
        return $this->hasMany(Intention::class, 'CEDULA')->with('definition', 'assessor')->orderBy('FECHA_INTENCION', 'DESC');
    }

    public function customerWarranties()
    {
        return $this->hasMany(Warranty::class, 'CEDULA');
    }
}