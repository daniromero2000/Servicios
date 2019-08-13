<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Moto;
use App\MotosImage;
use App\MotosLiquidator;
use App\MotosTimeLimits;
use App\MotosBrands;


class MotosAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $motos = Moto::select('motos.id','motos.image','motos.brand','motos.details','motos.manual',
                            'motos.name','motos.idBrand','motos.description','motos.price','motos.runt',
                            'motos.taxes','motos.aval','motos.initialFee','motos.soat','motos.creditEnrollment',
                            'motos.enrollment','motos.brandBonus','motos.creditPrice','motos.buttonText',
                            'motos.fee','motos.type','motos.power','motos.torque','motos.compression',
                            'motos.start','motos.engine','motos.displacement','motos.frontBrake','motos.rearBrake',
                            'motos.frontSuspension','motos.backSuspension','motos.tireFront','motos.tireBack','motos.ignition',
                            'motos.long','motos.height','motos.seatHeight','motos.width','motos.weight','motos.wheels',
                            'motos.tank','motos.axisDistance','motos.created_at','motos.updated_at','imageDescription',
                            'motos_brands.brand as brandMoto')
                            ->leftJoin('motos_brands','motos.idBrand','=','motos_brands.id')
                            ->get();
        
        $brands= MotosBrands::select('id','brand')->get();

		$data=[];

        $data['motos']=$motos;
        $data['brands']=$brands;
        
		return response()->json($data);
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
        try {
            //consulta
           $moto = new Moto;
           $moto->image = ($request->image)!=''?$request->image:NULL;
           $moto->brand = ($request->brand)!=''?$request->brand:NULL;
           $moto->ABS = ($request->ABS)!=''?$request->ABS:true;
           $moto->details = ($request->details)!=''?$request->details:NULL;
           $moto->manual = ($request->manual)!=''?$request->manual:NULL;
           $moto->name = ($request->name)!=''?$request->name:NULL;
           $moto->idBrand = ($request->idBrand)!=''?$request->idBrand:NULL;
           $moto->description = ($request->description)!=''?$request->description:NULL;
           $moto->price = ($request->price)!=''?$request->price:NULL;
           $moto->runt = ($request->runt)!=''?$request->runt:NULL;
           $moto->taxes = ($request->taxes)!=''?$request->taxes:NULL;
           $moto->aval = ($request->aval)!=''?$request->aval:NULL;
           $moto->initialFee = ($request->initialFee)!=''?$request->initialFee:NULL;
           $moto->soat = ($request->soat)!=''?$request->soat:NULL;
           $moto->creditEnrollment = ($request->creditEnrollment)!=''?$request->creditEnrollment:NULL;
           $moto->enrollment = ($request->enrollment)!=''?$request->enrollment:NULL;
           $moto->brandBonus = ($request->brandBonus)!=''?$request->brandBonus:NULL;
           $moto->creditPrice = ($request->creditPrice)!=''?$request->creditPrice:NULL;
           $moto->buttonText = ($request->buttonText)!=''?$request->buttonText:NULL;
           $moto->fee = ($request->fee)!=''?$request->fee:NULL;
           $moto->type = ($request->type)!=''?$request->type:NULL;
           $moto->power = ($request->power)!=''?$request->power:NULL;
           $moto->torque = ($request->torque)!=''?$request->torque:NULL;
           $moto->compression = ($request->compression)!=''?$request->compression:NULL;
           $moto->start = ($request->start)!=''?$request->start:NULL;
           $moto->engine = ($request->engine)!=''?$request->engine:NULL;
           $moto->displacement = ($request->displacement)!=''?$request->displacement:NULL;
           $moto->frontBrake = ($request->frontBrake)!=''?$request->frontBrake:NULL;
           $moto->rearBrake = ($request->rearBrake)!=''?$request->rearBrake:NULL;
           $moto->tireFront = ($request->tireFront)!=''?$request->tireFront:NULL;
           $moto->tireBack = ($request->tireBack)!=''?$request->tireBack:NULL;
           $moto->ignition = ($request->ignition)!=''?$request->ignition:NULL;
           $moto->long = ($request->long)!=''?$request->long:NULL;
           $moto->height = ($request->height)!=''?$request->height:NULL;
           $moto->seatHeight = ($request->seatHeight)!=''?$request->seatHeight:NULL;
           $moto->width = ($request->width)!=''?$request->width:NULL;
           $moto->weight = ($request->weight)!=''?$request->weight:NULL;
           $moto->wheels = ($request->wheels)!=''?$request->wheels:NULL;
           $moto->tank = ($request->tank)!=''?$request->tank:NULL;
           $moto->axisDistance = ($request->axisDistance)!=''?$request->axisDistance:NULL;
           $moto->imageDescription = ($request->imageDescription)!=''?$request->imageDescription:NULL;
           $moto->save();

           $data=[];

           $data['response']=true;
           $data['idMoto']=$moto->id;
           return response()->json($data);

       }
       catch(\Exception $e) {
           if ($e->getCode()=="23000"){
               return response()->json([$e->getCode(),$e->getMessage()]);
           }else{
               return response()->json($e->getMessage());
           }
       }
    }

    public function storeImageMoto(Request $request,$id){

        

            $moto = Moto::find($id);
            //return $request->file('imgs')->store('public');
            return  response()->json($request->file('imgs'));
            //$moto->image =  Explode("/",$request->file('imgs')->store('images'))[1];//take only name
           // $images->name =  Explode("/",$request->file('imgs'.$i)->store('public'))[1];//take only name

            $moto->save();

        

        return response()->json([true]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $motoImage=MotosImage::select('image')->where('id_moto','=',$id)->get();

        return response()->json($motoImage);
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
        try {
            //consulta
           $moto = Moto::find($id);
           $moto->image = ($request->image)!=''?$request->image:NULL;
           $moto->brand = ($request->brand)!=''?$request->brand:NULL;
           $moto->ABS = ($request->ABS)!=''?$request->ABS:true;
           $moto->details = ($request->details)!=''?$request->details:NULL;
           $moto->manual = ($request->manual)!=''?$request->manual:NULL;
           $moto->name = ($request->name)!=''?$request->name:NULL;
           $moto->idBrand = ($request->idBrand)!=''?$request->idBrand:NULL;
           $moto->description = ($request->description)!=''?$request->description:NULL;
           $moto->price = ($request->price)!=''?$request->price:NULL;
           $moto->runt = ($request->runt)!=''?$request->runt:NULL;
           $moto->taxes = ($request->taxes)!=''?$request->taxes:NULL;
           $moto->aval = ($request->aval)!=''?$request->aval:NULL;
           $moto->initialFee = ($request->initialFee)!=''?$request->initialFee:NULL;
           $moto->soat = ($request->soat)!=''?$request->soat:NULL;
           $moto->creditEnrollment = ($request->creditEnrollment)!=''?$request->creditEnrollment:NULL;
           $moto->enrollment = ($request->enrollment)!=''?$request->enrollment:NULL;
           $moto->brandBonus = ($request->brandBonus)!=''?$request->brandBonus:NULL;
           $moto->creditPrice = ($request->creditPrice)!=''?$request->creditPrice:NULL;
           $moto->buttonText = ($request->buttonText)!=''?$request->buttonText:NULL;
           $moto->fee = ($request->fee)!=''?$request->fee:NULL;
           $moto->type = ($request->type)!=''?$request->type:NULL;
           $moto->power = ($request->power)!=''?$request->power:NULL;
           $moto->torque = ($request->torque)!=''?$request->torque:NULL;
           $moto->compression = ($request->compression)!=''?$request->compression:NULL;
           $moto->start = ($request->start)!=''?$request->start:NULL;
           $moto->engine = ($request->engine)!=''?$request->engine:NULL;
           $moto->displacement = ($request->displacement)!=''?$request->displacement:NULL;
           $moto->frontBrake = ($request->frontBrake)!=''?$request->frontBrake:NULL;
           $moto->rearBrake = ($request->rearBrake)!=''?$request->rearBrake:NULL;
           $moto->tireFront = ($request->tireFront)!=''?$request->tireFront:NULL;
           $moto->tireBack = ($request->tireBack)!=''?$request->tireBack:NULL;
           $moto->ignition = ($request->ignition)!=''?$request->ignition:NULL;
           $moto->long = ($request->long)!=''?$request->long:NULL;
           $moto->height = ($request->height)!=''?$request->height:NULL;
           $moto->seatHeight = ($request->seatHeight)!=''?$request->seatHeight:NULL;
           $moto->width = ($request->width)!=''?$request->width:NULL;
           $moto->weight = ($request->weight)!=''?$request->weight:NULL;
           $moto->wheels = ($request->wheels)!=''?$request->wheels:NULL;
           $moto->tank = ($request->tank)!=''?$request->tank:NULL;
           $moto->axisDistance = ($request->axisDistance)!=''?$request->axisDistance:NULL;
           $moto->imageDescription = ($request->imageDescription)!=''?$request->imageDescription:NULL;
           $moto->save();
           return response()->json(true);

       }
       catch(\Exception $e) {
           if ($e->getCode()=="23000"){
               return response()->json([$e->getCode(),$e->getMessage()]);
           }else{
               return response()->json($e->getMessage());
           }
       }
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
}
