<?php

namespace App\Http\Controllers\Admin;

use App\Imagenes;
use App\Fee;
use App\Lead;
use App\Liquidator;
use App\Pagaduria;
use App\LibranzaLines;
use App\LibranzaProfile;
use App\PagaduriaProfile;
use App\Simulator;
use App\TimeLimits;
use App\CiudadesSoc;
use App\FileLibranza;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Validator;


class LibranzaController extends Controller
{
    public function index()
    {
        return view('libranza.index', [
            'images' => Imagenes::all()
        ]);
    }

    public function create()
    { }

    public function store(Request $request)
    {
        $lead = new Lead;
        $liquidator = new Liquidator;
        $lead->name = $request->get('name');
        $lead->lastName = $request->get('lastName');
        $lead->email = $request->get('email');
        $lead->telephone = $request->get('telephone');
        $lead->city = $request->get('city');
        $lead->typeService = $request->get('typeService');
        $lead->typeDocument = $request->get('typeDocument');
        $lead->identificationNumber = $request->get('identificationNumber');
        $lead->typeProduct = $request->get('typeProduct');
        $lead->channel = intval($request->get('channel'));
        $lead->termsAndConditions = $request->get('termsAndConditions');
        $lead->save();

        $liquidator->idCreditLine = $request->get('creditLine');
        $liquidator->idPagaduria = $request->get('pagaduria');
        $liquidator->age = $request->get('age');
        $liquidator->customerType = $request->get('customerType');
        $liquidator->salary = $request->get('salary');
        $liquidator->idLead = $lead->id;
        $liquidator->rate = $request->get('rate');
        $liquidator->amount = $request->get('amount');
        $liquidator->timeLimit = $request->get('timeLimit');
        $liquidator->fee = $request->get('fee');
        $liquidator->save();
        return response()->json($lead->id);
    }

    private function validateDateConsultaComercial($identificationNumber)
    {
        $dateNow = date('Y-m-d');
        $queryTimeCreditPolicy = DB::connection('mysql')->select("SELECT timeLimit FROM credit_policy LIMIT 1");
        $timeScore = $queryTimeCreditPolicy[0]->timeLimit;
        $dateTwoMonths = strtotime($timeScore, strtotime($dateNow));
        $dateTwoMonths = date('Y-m-d', $dateTwoMonths);
        $dateLastConsultaComercial = DB::connection('oportudata')->select("SELECT fecha FROM consulta_ws WHERE cedula = :identificationNumber ORDER BY consec DESC LIMIT 1 ", ['identificationNumber' => $identificationNumber]);
        if (empty($dateLastConsultaComercial)) {
            return 'true';
        } else {
            $dateLastConsulta = $dateLastConsultaComercial[0]->fecha;

            if (strtotime($dateLastConsulta) < strtotime($dateTwoMonths)) {
                return 'true';
            } else {
                return 'false';
            }
        }
    }

    private function execLegal($identificationNumber)
    {
        $obj = new \stdClass();
        $obj->typeDocument = 1;
        $obj->identificationNumber = trim($identificationNumber);

        try {
            $ws = new \SoapClient("http://10.238.14.181:1000/Service1.svc?singleWsdl", array()); //correcta
            $result = $ws->ConsultarLegalCheck($obj);  // correcta
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }
    }

    private function execConsultaComercial($identificationNumber)
    {
        $obj = new \stdClass();
        $obj->typeDocument = 1;
        $obj->identificationNumber = trim($identificationNumber);
        $ws = new \SoapClient("http://10.238.14.181:2020/Service1.svc?singleWsdl", array()); //correcta
        $result = $ws->ConsultarInformacionComercial($obj);  // correcta
    }

    public function show($id)
    { }

    public function edit($id)
    { }

    public function update(Request $request, $id)
    { }

    public function destroy($id)
    { }

    public function liquidator($maxAmount, $quota)
    {
        $maxAmountQuota = $maxAmount - $quota;
        $timeLimits     = [13, 18, 24, 36, 48, 60, 72, 84, 96, 108];
        $arrayFeesId    = array();
        $arrayAmount    = array();
        $arrayResult    = array();

        $i = 0;
        for ($i; $i < count($timeLimits); $i++) {
            $arrayFeesId[$i] = Fee::selectRaw("max(id) as idAmount")
                ->where('fee', '<', $quota)
                ->where('timeLimit', '=', $timeLimits[$i])
                ->get();
        }

        $j = 0;
        for ($j; $j < count($arrayFeesId); $j++) {
            $arrayAmount[$j] = Fee::selectRaw('timeLimit,amount')
                ->where('id', '=', $arrayFeesId[$j][0]->idAmount)
                ->get();
        }

        $k = 0;
        for ($k; $k < count($arrayAmount); $k++) {
            if (($maxAmount - $arrayAmount[$k][0]->amount) < 0) { } else {
                $arrayResult[$k] = $arrayAmount[$k][0];
            }
        }

        return response()->json($arrayResult);
    }

    public function getData()
    {
        $lines = LibranzaLines::select('id', 'name')->orderBy('id')->get();
        $pagaduria = Pagaduria::select('id', 'name', 'office', 'departament', 'category')->where('active', '=', 1)->where('name', '!=', 'OTRO')->get();
        $libranza_profile = LibranzaProfile::select('id', 'name')->where('name', '!=', 'OTRO')->orderBy('id', 'desc')->get();
        $params = Simulator::select('rate', 'gap', 'assurance', 'assurance2')->get();
        $timeLimits = TimeLimits::select('timeLimit')->get();
        $cities = CiudadesSoc::select('id', 'city', 'address', 'responsable', 'state', 'phone', 'office')->orderBy('city', 'ASC')->get()->unique('city');

        $data               = [];
        $data['lines']      = $lines;
        $data['pagaduria']  = $pagaduria;
        $data['profiles']   = $libranza_profile;
        $data['timeLimits'] = $timeLimits;
        $data['params']     = $params;
        $data['cities']     = $cities;
        return response()->json($data);
    }

    public function getResumen($idLead)
    {
        $lead = Lead::selectRaw('leads.name,leads.lastName,liquidator.id as idLiquidator,liquidator.amount,liquidator.timeLimit,liquidator.fee')
            ->leftJoin('liquidator', 'leads.id', '=', 'liquidator.idLead')
            ->where('leads.id', '=', $idLead)
            ->first();

        return response()->json($lead);
    }


    public function assignPagaduria($idLibranzaProfile)
    {
        $pagaduriaProfile = PagaduriaProfile::selectRaw('pagadurias_libranza_profiles.idPagaduria,pagaduria.name')
            ->leftJoin('pagaduria', 'pagadurias_libranza_profiles.idPagaduria', '=', 'pagaduria.id')
            ->where('pagadurias_libranza_profiles.idProfile', '=', $idLibranzaProfile)
            ->where('pagaduria.active', '=', 1)
            ->get();

        return response()->json($pagaduriaProfile);
    }

    public function test($request)
    {
        $array = [1, 2, 3, 4, 5, 6, 7];
        return response()->json($array);
    }

    public function libranzaData(Request $request)
    {
        $data = [];
        $leads = Liquidator::selectRaw('pagaduria.name as pagaduriaName,libranza_profiles.name as customerType, libranza_lines.name as creditLineName , liquidator.age, liquidator.creditLine,liquidator.pagaduria,liquidator.fee,liquidator.rate , liquidator.salary, liquidator.amount , liquidator.timeLimit, leads.id,leads.identificationNumber,leads.name ,leads.lastName ,leads.email ,leads.telephone ,leads.city ,leads.typeService ,leads.typeProduct ,leads.state ,leads.channel ,leads.created_at ,leads.termsAndConditions ,leads.typeDocument ,leads.identificationNumber ,leads.occupation')
            ->leftJoin('leads', 'liquidator.idLead', '=', 'leads.id')
            ->leftJoin('pagaduria', 'liquidator.idPagaduria', '=', 'pagaduria.id')
            ->leftJoin('libranza_lines', 'liquidator.idCreditLine', '=', 'libranza_lines.id')
            ->leftJoin('libranza_profiles', 'liquidator.customerType', '=', 'libranza_profiles.id')
            ->where('leads.typeService', '=', 'Credito libranza');

        if (!is_null($request->city)) {
            $leads->where('leads.city', $request->city);
        }

        if (!is_null($request->fecha_ini)) {
            $leads->where('fecha_ini', $request->fecha_ini);
        }

        if (!is_null($request->fecha_fin)) {
            $leads->where('fecha_fin', $request->fecha_fin);
        }

        if (!is_null($request->state)) {
            $leads->where('leads.state', $request->state);
        }

        $leads->orderBy('leads.created_at', 'DESC')
            ->skip($request->page * ($request->current - 1))
            ->take($request->page)
            ->get();

        $leadsInfo = $leads->get();
        $data = [];
        $dataLeads = [];

        foreach ($leadsInfo as $key => $lead) {
            $idNumber = $lead->identificationNumber;
            $dataQuery = DB::connection('oportudata')->select("SELECT score FROM cifin_score WHERE scocedula = :identificationNumber", ['identificationNumber' => $idNumber]);
            $data = [
                'age'                  => $lead->age,
                'amount'               => $lead->amount,
                'channel'              => $lead->channel,
                'city'                 => $lead->city,
                'created_at'           => $lead->created_at,
                'creditLine'           => $lead->creditLine,
                'creditLineName'       => $lead->creditLineName,
                'customerType'         => $lead->customerType,
                'email'                => $lead->email,
                'id'                   => $lead->id,
                'identificationNumber' => $lead->identificationNumber,
                'lastName'             => $lead->lastName,
                'name'                 => $lead->name,
                'occupation'           => $lead->occupation,
                'pagaduria'            => $lead->pagaduria,
                'pagaduriaName'        => $lead->pagaduriaName,
                'salary'               => $lead->salary,
                'state'                => $lead->state,
                'fee'                  => $lead->fee,
                'rate'                 => $lead->rate,
                'telephone'            => $lead->telephone,
                'termsAndConditions'   => $lead->termsAndConditions,
                'timeLimit'            => $lead->timeLimit,
                'typeDocument'         => $lead->typeDocument,
                'typeProduct'          => $lead->typeProduct,
                'typeService'          => $lead->typeService
            ];

            $dataLeads[] = $data;
        }
        //$leadsInfo=$leads->get();
        return response()->json($dataLeads);
    }

    public function addAmount(Request $request, $id)
    {
        $idLiquidator = Liquidator::select('id')->where('idLead', '=', $id)->get();
        $liquidator = Liquidator::find($idLiquidator[0]->id);
        $liquidator->amount = $request->get('amount');
        $liquidator->timeLimit = $request->get('timeLimit')['timeLimit'];
        $liquidator->save();

        return response()->json(true);
    }

    public function updateLiquidator(Request $request, $id)
    {
        $idLiquidator = Liquidator::select('id')->where('idLead', '=', $id)->get();
        $liquidator = Liquidator::find($idLiquidator[0]->id);
        $liquidator->salary = $request->get('salary');
        $liquidator->age = $request->get('age');
        $liquidator->idCreditLine = $request->get('creditLine');
        $liquidator->customerType = $request->get('customerType');
        $liquidator->idPagaduria = $request->get('pagaduria');
        $liquidator->save();

        return response()->json(true);
    }

    public function uploadFile(Request $request)
    {
        $idLead = Liquidator::select('idLead')->where('id', '=', $request->get('id_simulation'))->get();
        $identificationNumber = Lead::select('identificationNumber')->where('id', '=', $idLead[0]->idLead)->get();
        $validator = Validator::make($request->file(), [
            'image_file' => 'mimetypes:image/jpeg,image/png,application/pdf|max:1024',
        ]);

        $validatorDocument = Validator::make($request->file(), [
            'document_file' => 'mimetypes:image/jpeg,image/png,application/pdf|max:1024',
        ]);

        if (($validator->fails()) && ($validatorDocument->fails())) {
            $errors = [];
            $errorsDocument = [];
            foreach ($validator->messages()->all() as $error) {
                array_push($errors, $error);
            }

            foreach ($validatorDocument->messages()->all() as $errorDocument) {
                array_push($errorsDocument, $errorDocument);
            }

            return response()->json([
                'errors' => $errors,
                'errorsDocument' => $errorsDocument,
                'status' => 400
            ], 400);
        }

        $hasFile = $request->hasFile('image_file');
        $hasDocument = $request->hasFile('document_file');
        $fileRequest = $hasFile ? $request->file('image_file') : $request->file('document_file');

        if ($hasFile) {
            $file = FileLibranza::create([
                'name' => $request->file('image_file')->getClientOriginalName(),
                'type' => $request->file('image_file')->extension(),
                'size' => $request->file('image_file')->getClientSize(),
                'id_simulation' => (int) $request->get('id_simulation')
            ]);

            if (PHP_OS == "Linux") {
                $request->file('image_file')->move(__DIR__ . '/../../../../public/images/libranza_files/' . $identificationNumber[0]->identificationNumber . '/', 'cedula.' . $file->type);
            } else {
                $request->file('image_file')->move(__DIR__ . '\..\..\..\..\public\images\libranza_files\\' . $identificationNumber[0]->identificationNumber . '\\', 'cedula.' . $file->type);
            }
        } elseif ($hasDocument) {
            $fileDocument = FileLibranza::create([
                'name' => $request->file('document_file')->getClientOriginalName(),
                'type' => $request->file('document_file')->extension(),
                'size' => $request->file('document_file')->getClientSize(),
                'id_simulation' => (int) $request->get('id_simulation')
            ]);

            if (PHP_OS == "Linux") {
                $request->file('document_file')->move(__DIR__ . '/../../../../public/images/libranza_files/' . $identificationNumber[0]->identificationNumber . '/', 'desp_nomina.' . $fileDocument->type);
            } else {
                //$request->file('document_file')->store()
                $request->file('document_file')->move(__DIR__ . '\..\..\..\..\public\images\libranza_files\\' . $identificationNumber[0]->identificationNumber . '\\', 'desp_nomina.' . $fileDocument->type);
            }
        }

        return response()->json(['errors' => [], 'files' => FileLibranza::all(), 'status' => 200, 'files' => $hasFile, 'Document' => $hasDocument], 200);
    }

    private function calculateAge($fecha)
    {
        $time = strtotime($fecha);
        $now  = time();
        $age  = ($now - $time) / (60 * 60 * 24 * 365.25);
        $age  = floor($age);

        return $age;
    }
}
