<?php

namespace App\Entities\UbicaEmails\Repositories;

use App\Entities\UbicaEmails\UbicaEmail;
use App\Entities\UbicaEmails\Repositories\Interfaces\UbicaEmailRepositoryInterface;
use Illuminate\Database\QueryException;

class UbicaEmailRepository implements UbicaEmailRepositoryInterface
{
    public function __construct(
        UbicaEmail $ubicaEMail
    ) {
        $this->model = $ubicaEMail;
    }

    public function getUbicaEmailByConsec($email, $consec)
    {
        try {
            return $this->model
                ->where('ubicorreo', $email)
                ->where('ubiconsul', $consec)->get(['ubicorreo', 'ubiprimerrep']);
        } catch (QueryException $e) {
            dd($e);
        }
    }
}
