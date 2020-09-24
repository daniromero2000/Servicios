<?php

namespace App\Entities\FactoryRequests;

use App\Assessor;
use App\Entities\CreditBusinesDetails\CreditBusinesDetail;
use App\Entities\CreditBusiness\CreditBusines;
use App\Entities\CreditCards\CreditCard;
use App\Entities\CustomerReferences\CustomerReference;
use App\Entities\Customers\Customer;
use App\Entities\FactoryRequestComments\FactoryRequestComment;
use App\Entities\FactoryRequestNotes\FactoryRequestNote;
use App\Entities\FactoryRequestProducts\FactoryRequestProduct;
use App\Entities\FactoryRequestProducts2\FactoryRequestProduct2;
use App\Entities\FactoryRequestStatuses\FactoryRequestStatus;
use App\Entities\FactoryRequestStatusesLogs\FactoryRequestStatusesLog;
use App\Entities\Subsidiaries\Subsidiary;
use App\Entities\TurnoOportuyas\TurnoOportuya;
use App\Entities\Turnos\Turno;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class FactoryRequest extends Model
{
    use SearchableTrait;

    protected $fillable = [
        'AVANCE_W',
        'PRODUC_W',
        'CLIENTE',
        'CODASESOR',
        'id_asesor',
        'ID_EMPRESA',
        'FECHASOL',
        'SUCURSAL',
        'ESTADO',
        'FTP',
        'STATE',
        'GRAN_TOTAL',
        'SOLICITUD_WEB',
        'CODEUDOR1',
    ];

    protected $table = 'SOLIC_FAB';

    protected $connection = 'oportudata';

    protected $primaryKey = 'SOLICITUD';

    public $timestamps = false;

    protected $hidden = [
        'relevance'
    ];

    protected $searchable = [
        'columns' => [
            'SOLIC_FAB.CLIENTE'   => 1,
            'SOLIC_FAB.SOLICITUD' => 5,
        ],
    ];

    protected $dates = ['FECHASOL'];

    public function searchFactoryRequest($term)
    {
        return self::search($term);
    }

    public function searchFactoryRequestTurnsTotal($term)
    {
        return self::search($term);
    }

    public function searchFactoryRequestTurns($term)
    {
        return self::search($term);
    }

    public function searchFactoryDirectorsZona($term)
    {
        return self::search($term);
    }

    public function searchFactoryAseessors($term)
    {
        return self::search($term);
    }

    public function searchFactoryDirectors($term)
    {
        return self::search($term);
    }

    public function hasCustomer()
    {
        return $this->belongsTo(Customer::class, 'CLIENTE')
            ->where('ESTADO', 19);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CLIENTE');
    }

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class);
    }

    public function creditCard()
    {
        return $this->hasOne(CreditCard::class, 'SOLICITUD');
    }

    public function comments()
    {
        return $this->hasMany(FactoryRequestComment::class, 'solicitud');
    }

    public function references()
    {
        return $this->hasMany(CustomerReference::class, 'SOLICITUD');
    }

    public function factoryRequestNotes()
    {
        return $this->hasMany(FactoryRequestNote::class, 'SOLICITUD')->orderBy('FECHA', 'DESC');
    }

    public function factoryRequestProducts()
    {
        return $this->hasMany(FactoryRequestProduct::class, 'SOLICITUD');
    }

    public function factoryRequestStatus()
    {
        return $this->belongsTo(FactoryRequestStatus::class, 'ESTADO');
    }

    public function factoryRequestProducts2()
    {
        return $this->hasMany(FactoryRequestProduct2::class, 'SOLICITUD');
    }

    public function factoryRequestStatusesLogs()
    {
        return $this->hasMany(FactoryRequestStatusesLog::class, 'solic_fab_id')->orderBy('created_at', 'DESC')->with('oportudataUser');
    }

    public function turnoTradicional()
    {
        return $this->belongsTo(Turno::class, 'SOLICITUD', 'SOLICITUD');
    }

    public function turnoOportuya()
    {
        return $this->belongsTo(TurnoOportuya::class, 'SOLICITUD', 'SOLICITUD');
    }

    public function factoryRequestaAssessors()
    {
        return $this->belongsTo(Assessor::class, 'CODASESOR', 'CODIGO');
    }

    public function factoryRequestCodebtor1()
    {
        return $this->hasOne(Customer::class, 'CEDULA', 'CODEUDOR1');
    }

    public function factoryRequestCodebtor2()
    {
        return $this->hasOne(Customer::class, 'CEDULA', 'CODEUDOR2');
    }

    public function states()
    {
        return $this->belongsToMany(FactoryRequestStatus::class, 'ESTADOSOLICITUDESSOLIC_FAB', 'solic_fab_id', 'estadosolicitudes_id');
    }

    public function recoveringStates()
    {
        return $this->belongsToMany(FactoryRequestStatus::class, 'ESTADOSOLICITUDESSOLIC_FAB', 'solic_fab_id', 'estadosolicitudes_id')->where('estadosolicitudes_id', 8)->orWhere('estadosolicitudes_id', 18)->withPivot('created_at');
    }

    public function recoveringStates1()
    {
        return $this->hasMany(FactoryRequestStatusesLog::class, 'solic_fab_id');
    }

    public function super()
    {
        return $this->hasMany(CreditBusines::class, 'SOLICITUD');
    }

    public function super2()
    {
        return $this->hasMany(CreditBusinesDetail::class, 'SOLICITUD');
    }
}
