<?php

namespace App\Entities\FactoryRequests;

use App\Assessor;
use App\Entities\Codebtors\Codebtor;
use App\Entities\CreditCards\CreditCard;
use App\Entities\CustomerReferences\CustomerReference;
use App\Entities\Customers\Customer;
use App\Entities\FactoryRequestComments\FactoryRequestComment;
use App\Entities\FactoryRequestNotes\FactoryRequestNote;
use App\Entities\FactoryRequestProducts\FactoryRequestProduct;
use App\Entities\FactoryRequestProducts2\FactoryRequestProduct2;
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
            ->where('ESTADO', 'APROBADO');
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
        return $this->hasMany(FactoryRequestNote::class, 'SOLICITUD');
    }

    public function factoryRequestProducts()
    {
        return $this->hasMany(FactoryRequestProduct::class, 'SOLICITUD');
    }

    public function factoryRequestProducts2()
    {
        return $this->hasMany(FactoryRequestProduct2::class, 'SOLICITUD');
    }

    public function factoryRequestStatusesLogs()
    {
        return $this->hasMany(FactoryRequestStatusesLog::class, 'solic_fab_id')->with('oportudataUser');
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
        return $this->hasOne(Codebtor::class, 'SOLICITUD');
    }
}
