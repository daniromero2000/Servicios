<?php

namespace App\Entities\Fosygas\Repositories;

use App\Entities\Fosygas\Fosyga;
use App\Entities\Fosygas\Repositories\Interfaces\FosygaRepositoryInterface;
use Illuminate\Database\QueryException;

class FosygaRepository implements FosygaRepositoryInterface
{
    public function __construct(
        Fosyga $fosyga
    ) {
        $this->model = $fosyga;
    }

    public function getLastFosygaConsultation($identificationNumber)
    {
        try {

            return $this->model->where('identificationNumber', $identificationNumber)
                ->orderBy('idBdua', 'desc')->get(['fechaConsulta', 'fuenteFallo'])
                ->first();
        } catch (QueryException $e) { }
    }

    public function createConsultaFosyga($infoBdua, $identificationNumber)
    {
        $bdua = new Fosyga();
        $infoBdua = (array) $infoBdua;
        $infoBdua = $infoBdua['original'];

        if ($infoBdua['fuenteFallo'] == "SI") {
            $bdua->cedula = $identificationNumber;
            $bdua->fuenteFallo = "SI";
            $bdua->save();
            return -1;
        }

        $bdua->cedula = $infoBdua['personaVO']['numeroDocumento'];
        $bdua->tipoDocumento = $infoBdua['personaVO']['tipoDocumento'];
        $bdua->pais = $infoBdua['personaVO']['pais'];
        $bdua->primerNombre = $infoBdua['personaVO']['nombres']['BDUA']['primerNombre'];
        $bdua->primerApellido = $infoBdua['personaVO']['nombres']['BDUA']['primerApellido'];
        $bdua->tipoNombre = $infoBdua['personaVO']['nombres']['BDUA']['tipoNombre'];
        $bdua->estado = $infoBdua['estado'];
        $bdua->entidad = $infoBdua['entidad'];
        $bdua->regimen = $infoBdua['regimen'];
        $bdua->fechaAfiliacion = $infoBdua['fechaAfiliacion'];
        $bdua->fechaFinalAfiliacion = $infoBdua['fechaFinalAfiliacion'];
        $bdua->departamento = $infoBdua['departamento'];
        $bdua->ciudad = $infoBdua['ciudad'];
        $bdua->tipoAfiliado = $infoBdua['tipoAfiliado'];
        $bdua->fechaConsulta = $infoBdua['fechaConsulta'];
        $bdua->fuenteFallo = $infoBdua['fuenteFallo'];
        $bdua->save();

        return 1;
    }
}
