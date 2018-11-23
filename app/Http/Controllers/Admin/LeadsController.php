<?php

namespace App\Http\Controllers\Admin;

use App\Lead;
use App\Liquidator;
use App\Comments;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LeadsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->except('logout');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = "SELECT leads.`id`, leads.`name`, leads.`lastName`, leads.`email`, leads.`telephone`, leads.`city`, leads.`typeService`, leads.`typeProduct`, leads.`created_at`, leads.`state`,leads.`channel`,liquidator.`creditLine`, liquidator.`pagaduria`, liquidator.`age`, liquidator.`customerType`, liquidator.`salary`, campaigns.`name` as campaignName
            FROM leads 
            LEFT JOIN `liquidator` ON liquidator.`idLead` = leads.`id`      
            LEFT JOIN `campaigns` ON campaigns.`id` = leads.`campaign`
            WHERE 1 ";

        if($request->get('q')){
            $query .= sprintf(" AND (leads.`name` LIKE '%s' OR leads.`lastName` LIKE '%s') ", '%'.$request->get('q').'%', '%'.$request->get('q').'%');
        }

        if($request->get('state')){
            $query .= sprintf(" AND leads.`state` = %s ", $request->get('state'));
        }

        if($request->get('city')){
            $query .= sprintf(" AND leads.`city` = '%s' ", $request->get('city'));
        }

        if($request->get('typeProduct')){
            $query .= sprintf(" AND leads.`typeProduct` = '%s' ", $request->get('typeProduct'));
        }

        if($request->get('typeService')){
            $query .= sprintf(" AND leads.`typeService` = '%s' ", $request->get('typeService'));
        }

        if($request->get('fecha_ini')){
            $query .= sprintf(" AND leads.`created_at` > '%s' ", $request->get('fecha_ini').' 00:00:00');
        }

        if($request->get('fecha_fin')){
            $query .= sprintf(" AND leads.`created_at` < '%s' ", $request->get('fecha_fin').' 23:59:59');
        }

        if($request->get('libranzaLead')){
            $query .= sprintf(" AND leads.`state` != 0 ");
        }

         if($request->get('communityLead')){
            $query .= sprintf(" AND leads.`channel` = 2");
        }
        
        $query .= " ORDER BY leads.`id` DESC";

        $query .= sprintf(" LIMIT %s,30", $request->get('limitFrom'));

        $resp = DB::select($query);

        return $resp;
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $leads=Lead::find($id);
        $leadsQuery = Lead::selectRaw('leads.*,liquidator.*')
                    ->leftjoin('liquidator','leads.id','=','liquidator.idLead')
                    ->where('leads.id','=',$leads->id)
                    ->orderBy('leads.id')->get();


        return view('leads.show',compact('leads','leadsQuery'));
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

     public function addCommunityLeads(Request $request){

        $lead= new Lead;

        $lead->name=$request->name;
        $lead->lastName=$request->lastName;
        $lead->email=$request->email;
        $lead->telephone=$request->telephone;
        $lead->city=$request->city;
        $lead->typeProduct=$request->typeProduct;
        $lead->typeService=$request->typeService;
        $lead->channel=$request->channel; 
        $lead->termsAndConditions = 2; 

        $lead->save();

        return response()->json($lead);
        
    }

    public function viewCommunityLeads($id){

        $lead=Lead::findOrfail($id);

        return response()->json($lead);
    }

    public function deleteCommunityLeads($id){
        
        $lead=Lead::findOrfail($id);
        $lead->delete();

        return response()->json([true]);
    }


    public function updateCommunityLeads(Request $request){

        $lead=lead::findOrfail($request->get('id'));
        $lead->name = $request->get('name');
        $lead->lastName = $request->get('lastName');
        $lead->email = $request->get('email');
        $lead->telephone = $request->get('telephone');
        $lead->city = $request->get('city');
        $lead->typeProduct = $request->get('typeProduct');
        $lead->typeService = $request->get('typeService');
        $lead->channel = $request->get('channel');

        $lead->save();

        return response()->json([true]);
    }


    public function addComent($lead, $comment){
        $commentNew= new Comments;
        
        $currentUser=\Auth::user();
        $commentNew->idLogin = $currentUser->id;
        $commentNew->idLead = $lead;
        $commentNew->comment = $comment;

        $commentNew->save();

        return response()->json([true]);
    }


    public function getComentsLeads($idLead){
        $query = sprintf("SELECT comments.`comment`, comments.`created_at`, users.`name` FROM `comments` 
                LEFT JOIN `users` ON comments.`idLogin` = users.`id`
                WHERE `idLead` = %s
                ORDER BY comments.`id` DESC", $idLead);
        $resp = DB::select($query);

        return $resp;
    }

    public function deniedRequest($idLead, $comment){
        $employee = Lead::find($idLead);
        $employee->state = 4;
        $employee->save();

        $this->addComent($idLead, $comment);

        return response()->json([true]);
    }

    public function cahngeStateLead($idLead, $comment, $state){
        $employee = Lead::find($idLead);
        $employee->state = $state;
        $employee->save();

        $this->addComent($idLead, $comment);

        return response()->json([true]);
    }
}
