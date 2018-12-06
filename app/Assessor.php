<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;


class Assessor extends Model implements AuthenticatableContract
{
    use Authenticatable;

    public $table='ASESORES';
    protected $primaryKey= 'CODIGO';

    protected $fillable=['CODIGO','NUM_COD','NOMBRE','SUCURSAL','STATE'];

    /*protected $fillable = [

        'name', 'email', 'password','idProfile',

    ];*/



    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    /*protected $hidden = [

        'password', 'remember_token',

    ];*/
}
