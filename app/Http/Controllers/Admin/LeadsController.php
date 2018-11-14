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

        $query = "SELECT leads.`id`, leads.`name`, leads.`lastName`, leads.`email`, leads.`telephone`, leads.`city`, leads.`typeService`, leads.`typeProduct`, leads.`created_at`,liquidator.`creditLine`, liquidator.`pagaduria`, liquidator.`age`, liquidator.`customerType`, liquidator.`salary` 
            FROM leads 
            LEFT JOIN `liquidator` ON liquidator.`idLead` = leads.`id`
            WHERE 1";

        if($request->get('q')){
            $query .= sprintf(" AND (leads.`name` LIKE '%s' OR leads.`lastName` LIKE '%s') ", '%'.$request->get('q').'%', '%'.$request->get('q').'%');
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

        $query .= " ORDER BY leads.`id` DESC";

        $query .= sprintf(" LIMIT %s,30", $request->get('limitFrom'));

        $resp = DB::select($query);

        foreach ($resp as $key => $value) {
            $query2 = sprintf("SELECT comments.`comment`, comments.`created_at`, users.`name` FROM `comments` 
                LEFT JOIN `users` ON comments.`idLogin` = users.`id`
                WHERE `idLead` = %s
                ORDER BY comments.`id` DESC ", $resp[$key]->id);
            $resp[$key]->comments = DB::select($query2);
        }

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
        //
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


    public function addComent($lead, $comment){
        $commentNew= new Comments;
        
        $currentUser=\Auth::user();
        $commentNew->idLogin = $currentUser->id;
        $commentNew->idLead = $lead;
        $commentNew->comment = $comment;

        $commentNew->save();

        return response()->json([true]);


    }
}
