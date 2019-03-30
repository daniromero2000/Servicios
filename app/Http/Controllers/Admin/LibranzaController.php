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
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LibranzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images=Imagenes::all();
        return view('libranza.index',['images'=>$images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $lead= new Lead;
        $liquidator = new Liquidator;

        $lead->name=$request->get('name');
        $lead->lastName=$request->get('lastName');
        $lead->email=$request->get('email');
        $lead->telephone=$request->get('telephone');
        $lead->city=$request->get('city');
        $lead->typeService=$request->get('typeService');
        $lead->typeProduct=$request->get('typeProduct');
        $lead->channel=intval($request->get('channel'));
        $lead->termsAndConditions=$request->get('termsAndConditions');

        $lead->save();

        $liquidator->creditLine = $request->get('creditLine');
        $liquidator->pagaduria = $request->get('pagaduria');
        $liquidator->age = $request->get('age');
        $liquidator->customerType = $request->get('customerType');
        $liquidator->salary = $request->get('salary');
        $liquidator->idLead = $lead->id;

        
        $liquidator->save();
        return redirect()->route('thankYouPageLibranza');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function liquidator($maxAmount,$quota){  


        $maxAmountQuota=$maxAmount-$quota;

        $timeLimits=[13,18,24,36,48,60,72,84,96,108];
        

        $arrayFeesId=array();
        $arrayAmount=array();  
        $arrayResult=array();              
            
        $i=0;
        for($i;$i<count($timeLimits);$i++){
            $arrayFeesId[$i]=Fee::selectRaw("max(id) as idAmount")
                            ->where('fee','<',$quota)
                            ->where('timeLimit','=',$timeLimits[$i])
                            ->get();
        }
        
        $j=0;
        for($j;$j<count($arrayFeesId);$j++){
            $arrayAmount[$j]=Fee::selectRaw('timeLimit,amount')
                            ->where('id','=',$arrayFeesId[$j][0]->idAmount)
                            ->get();
        }
        
        $k=0;
        for($k;$k<count($arrayAmount);$k++){
                if(($maxAmount-$arrayAmount[$k][0]->amount) < 0){
                }else{
                    $arrayResult[$k]=$arrayAmount[$k][0];
                }

        }

        return response()->json($arrayResult);
    }

    public function getData(){

        $lines=LibranzaLines::select('id','name')->orderBy('id')->get();
        $pagaduria=Pagaduria::select('id','name','office','departament','category')->where('active','=',1)->get();
        $libranza_profile=LibranzaProfile::select('id','name')->where('name','!=','OTRO')->orderBy('id','desc')->get();
        $params=Simulator::select('rate','gap','assurance')->get();
        $timeLimits=TimeLimits::select('timeLimit')->get();
        $cities=CiudadesSoc::select('id','city','address','responsable','state','phone','office')->orderBy('city','ASC')->get()->unique('city');

        $data=[];
        $data['lines']=$lines;
        $data['pagaduria']=$pagaduria;
        $data['profiles']=$libranza_profile;
        $data['timeLimits']=$timeLimits;
        $data['params']=$params;
        $data['cities']=$cities;
        return response()->json($data);

    }


    public function assignPagaduria($idLibranzaProfile){

        $pagaduriaProfile=PagaduriaProfile::selectRaw('pagadurias_libranza_profiles.idPagaduria,pagaduria.name')
        ->leftJoin('pagaduria','pagadurias_libranza_profiles.idPagaduria','=','pagaduria.id')
        ->where('pagadurias_libranza_profiles.idProfile','=',$idLibranzaProfile)
        ->where('pagaduria.active','=',1)
        ->get();

        return response()->json($pagaduriaProfile);
    }

    public function test($request){
        $array = [1,2,3,4,5,6,7];
        return response()->json($array);
    }

    public function libranzaData(Request $request){

        $leads=Lead::select('id','name','lastName','email','telephone','city','typeService','typeProduct','state','channel','created_at','termsAndConditions','typeDocument','identificationNumber','occupation')
        ->where('typeService','=','Libranza');


        if(!is_null($request->city)){
            $leads->where('city', $request->city);
        }
        
        if(!is_null($request->fecha_ini)){
            $leads->where('fecha_ini', $request->fecha_ini);
        }
        
        if(!is_null($request->fecha_fin)){
            $leads->where('fecha_fin', $request->fecha_fin);
        }

        if(!is_null($request->state)){
            $leads->where('state', $request->state);
        }
        
        $leads->orderBy('id', 'desc')
                ->skip($request->page*($request->actual-1))
                ->take($request->page);
                
        return response()->json($leads->get());
    }

}
