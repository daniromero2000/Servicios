<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Simulator;
use App\TimeLimits;
use App\Pagaduria;
use App\LibranzaProfile;
use App\PagaduriaProfile;
use App\CiudadesSoc;

class SimulatorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('logout');
    }

    public function index()
    {
        return view('simulator.index');
    }

    public function store(Request $request)
    {
        try {
            //consulta
            $timeLimit = new TimeLimits;
            $timeLimit->timeLimit = $request->timeLimit;
            $timeLimit->save();
            return response()->json(true);
        } catch (\Exception $e) {
            if ($e->getCode() == "23000") {
                return response()->json($e->getCode());
            } else {
                return response()->json($e->getMessage());
            }
        }
    }

    public function update(Request $request, $id)
    {
        try {
            //quey
            $params = Simulator::find($id);
            $params->rate = $request->rate;
            $params->gap = $request->gap;
            $params->assurance = $request->assurance;
            $params->save();
            return response()->json(true);
        }
        // if resource already exist return error
        catch (\Exception $e) {
            if ($e->getCode() == "23000") {
                return response()->json($e->getCode());
            } else {
                return response()->json($e->getMessage());
            }
        }
    }

    public function destroy($id)
    {
        $timeLimit = TimeLimits::findOrFail($id);
        $timeLimit->delete();

        return response()->json([true]);
    }

    public function getData()
    {
        $params = Simulator::select('rate', 'gap', 'assurance', 'assurance2')->get();
        $timeLimits = TimeLimits::select('id', 'timeLimit')->get();
        $pagadurias = Pagaduria::select('id', 'name', 'office', 'address', 'city', 'departament', 'category', 'active', 'phoneNumber')->orderBy('id', 'DESC')->get();
        $libranzaProfiles = LibranzaProfile::select('id', 'name')->get();
        $cities = CiudadesSoc::select('id', 'city', 'address', 'responsable', 'state', 'phone', 'office')->orderBy('city', 'ASC')->get()->unique('city');

        $i = 0;
        $dataPagaduria = [];

        for ($i; $i < count($pagadurias); $i++) {

            $idPagaduria = $pagadurias[$i]['id'];
            $profilesQuery = PagaduriaProfile::select('libranza_profiles.id', 'libranza_profiles.name')
                ->leftJoin('libranza_profiles', 'pagadurias_libranza_profiles.idProfile', '=', 'libranza_profiles.id')
                ->where('idPagaduria', $idPagaduria)->get();

            $dataPagaduria[$i] = $pagadurias[$i];
            $dataPagaduria[$i]['profiles'] = $profilesQuery;
        }

        $data['dataProfile'] = $dataPagaduria;
        $data['params'] = $params;
        $data['timeLimits'] = $timeLimits;
        $data['libranzaProfiles'] = $libranzaProfiles;
        $data['cities'] = $cities;

        return response()->json($data);
    }

    public function addPagaduria(Request $request)
    {
        try {
            $pagaduria = new Pagaduria;
            $pagaduria->name = $request->name;
            $pagaduria->office = $request->office;
            $pagaduria->city = $request->city;
            $pagaduria->departament = $request->departament;
            $pagaduria->address = $request->address;
            $pagaduria->phoneNumber = $request->phoneNumber;
            $pagaduria->active = $request->active;
            $pagaduria->category = $request->category;

            $pagaduria->save();

            $i = 0;
            $idPagaduria = $pagaduria->id;
            for ($i; $i < count($request->profiles); $i++) {
                $profPag = new PagaduriaProfile;
                $profPag->idProfile = $request->profiles[$i]['id'];
                $profPag->idPagaduria = $idPagaduria;
                $profPag->save();
            }

            return response()->json(true);
        } catch (\Exception $e) {
            if ($e->getCode() == "23000") {
                return response()->json($e->getCode());
            } else {
                return response()->json($e->getMessage());
            }
        }
    }

    public function deletePagaduria($id)
    {
        $pagaduriasProfile = PagaduriaProfile::where('idPagaduria', $id)->delete();
        $pagaduria = Pagaduria::findOrFail($id);
        $pagaduria->delete();

        return response()->json([true]);
    }

    public function updatePagaduria(Request $request, $id)
    {
        try {
            $pagaduria = Pagaduria::findOrFail($id);
            $pagaduria->name = $request->get('name');
            $pagaduria->address = $request->get('address');
            $pagaduria->city = $request->get('city');
            $pagaduria->departament = $request->get('departament');
            $pagaduria->office = $request->get('office');
            $pagaduria->phoneNumber = $request->get('phoneNumber');
            $pagaduria->save();

            $pagaduriasProfile = PagaduriaProfile::where('idPagaduria', $id)->delete();

            $i = 0;
            for ($i; $i < count($request->profiles); $i++) {
                $profPag = new PagaduriaProfile;
                $profPag->idProfile = $request->profiles[$i]['id'];
                $profPag->idPagaduria = $id;
                $profPag->save();
            }

            return response()->json(true);
        } catch (\Exception $e) {
            if ($e->getCode() == "23000") {
                return response()->json($e->getCode());
            } else {
                return response()->json($e->getMessage());
            }
        }
    }

    public function addProfile(Request $request)
    {
        try {
            $profile = new LibranzaProfile;
            $profile->name = $request->name;
            $profile->save();

            return response()->json(true);
        } catch (\Exception $e) {
            if ($e->getCode() == "23000") {
                return response()->json($e->getCode());
            } else {
                return response()->json($e->getMessage());
            }
        }
    }

    public function deleteProfile($id)
    {
        $pagaduriasProfile = PagaduriaProfile::where('idProfile', $id)->delete();
        $profile = LibranzaProfile::findOrFail($id);
        $profile->delete();

        return response()->json([true]);
    }
}
