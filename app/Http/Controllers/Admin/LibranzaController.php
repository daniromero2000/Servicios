<?php

namespace App\Http\Controllers\Admin;
use App\Imagenes;
use App\Fee;
use App\Lead;
use App\Liquidator;
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
        $lead->state=intval($request->get('state'));
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


    public function test($request){
        $array = [1,2,3,4,5,6,7];
        return response()->json($array);
    }
}
