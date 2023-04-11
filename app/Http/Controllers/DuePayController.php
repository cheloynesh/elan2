<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Permission;
use App\Branch;
use App\Insurance;
use App\Profile;
use DB;
use DateTime;

class DuePayController extends Controller
{
    public function index ()
    {
        $profile = User::findProfile();
        $perm = Permission::permView($profile,24);
        $perm_btn =Permission::permBtns($profile,24);
        $insurances = Insurance::orderBy('name')->pluck('name','id');
        $branches = Branch::orderBy('name')->pluck('name','id');
        // $agents = User::select('id', DB::raw('CONCAT(name," ",firstname) AS name'))->orderBy('name')->where("fk_profile","12")->pluck('name','id');
        $arrayAux = array();
        // $arrayAgents = array();
        // $prueba = User::select('id', DB::raw('CONCAT(name," ",firstname) AS name'))->orderBy('name');
        // $prueba = $prueba->where('id',2);
        // $prueba = $prueba->get();
        // dd($prueba);
        // $names = DB::select('exec insurancescount("2023")');
        // $names = DB::get('call insurancescount()');
        // dd($statcont);
        // foreach($agents as $id => $agent)
        // {
        //     $arrayAux = array();
        //     $ingresadas = DB::table('Initials')->select(DB::raw('count(id) as s_ing, sum(pna) as sum_ing'))->where('fk_status', '!=', 4)->where('fk_agent', $id)->whereNull('deleted_at')->first();
        //     $emitidas = DB::table('Initials')->select(DB::raw('count(id) as s_ing, sum(pna) as sum_ing'))->where('fk_status', 4)->where('fk_agent', $id)->whereNull('deleted_at')->first();
        //     $polizas = DB::table('Policy')->select(DB::raw('count(id) as s_ing, sum(pna) as sum_ing'))->where('type', 1)->where('fk_agent', $id)->whereNull('deleted_at')->first();
        //     array_push($arrayAux,$id,$agent,$ingresadas->s_ing,'$' . number_format($ingresadas->sum_ing, 2),$emitidas->s_ing,'$' . number_format($emitidas->sum_ing, 2),$polizas->s_ing,'$' . number_format($polizas->sum_ing, 2));
        //     array_push($arrayAgents,$arrayAux);
        // }
        $arrayAgents = DB::select('call agentscount(?,?,?,?,?)',["%","%","%","%","2023"]);
        // dd($arrayAgents);
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            // return view('reports.duepay.duepay', compact('perm_btn'));
            return view('reports.duepay.duepay', compact('perm_btn','arrayAgents','insurances','branches'));
        }
    }
    public function GetInfo($id)
    {
        date_default_timezone_set('America/Mexico_City');
        $today = new DateTime();
        $inscont = DB::select('call insurancescount(?,?,?,?,?)',["%","%","%","%",$today->format('Y')]);
        $branchcont = DB::select('call branchescount(?,?,?,?,?)',["%","%","%","%",$today->format('Y')]);
        $paycont = DB::select('call paycont(?,?,?,?,?)',["%","%","%","%",$today->format('Y')]);
        $statcont = DB::select('call statcont(?,?,?,?,?)',["%","%","%","%",$today->format('Y')]);
        return response()->json(['status'=>true, "insurances"=>$inscont, "branches" => $branchcont, "pay" => $paycont, "status" => $statcont]);
    }
    public function GetInfoFilters(Request $request)
    {
        date_default_timezone_set('America/Mexico_City');
        $today = new DateTime();
        $arrayAgents = DB::select('call agentscount(?,?,?,?,?)',[$request->branch,$request->insurance,$request->month,$request->quarter,$today->format('Y')]);
        $inscont = DB::select('call insurancescount(?,?,?,?,?)',[$request->branch,$request->insurance,$request->month,$request->quarter,$today->format('Y')]);
        $branchcont = DB::select('call branchescount(?,?,?,?,?)',[$request->branch,$request->insurance,$request->month,$request->quarter,$today->format('Y')]);
        $paycont = DB::select('call paycont(?,?,?,?,?)',[$request->branch,$request->insurance,$request->month,$request->quarter,$today->format('Y')]);
        $statcont = DB::select('call statcont(?,?,?,?,?)',[$request->branch,$request->insurance,$request->month,$request->quarter,$today->format('Y')]);
        // dd($request->all());
        return response()->json(['status'=>true, "data"=>$arrayAgents, "insurances"=>$inscont, "branches" => $branchcont, "pay" => $paycont, "status" => $statcont]);
    }
}
