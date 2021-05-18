<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Permission;
use App\Initial;
use App\Currency;
use App\Insurance;
use App\Paymentform;
use App\Charge;
use App\Branch;
use App\Application;
use DB;


class InitialController extends Controller
{
    public function index()
    {
        $initials = Initial::get();
        $agents = User::select('id', DB::raw('CONCAT(name," ",firstname) AS name'))->where("fk_profile","12")->pluck('name','id');
        $currencies = Currency::pluck('name','id');
        $insurances = Insurance::pluck('name','id');
        $paymentForms = Paymentform::pluck('name','id');
        $charges = Charge::pluck('name','id');
        $branches = Branch::pluck('name','id');
        $applications = Application::pluck('name','id');

        $profile = User::findProfile();
        $perm = Permission::permView($profile,14);
        $perm_btn =Permission::permBtns($profile,14);
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('processes.OT.initials.initial', 
            compact('initials','agents','currencie','insurances','paymentForms','charges','branches','applications','perm_btn'));
        }
    }
    public function GetInfo($id)
    {
        $initial = Initial::where('id',$id)->first();
        return response()->json(['status'=>true, "data"=>$initial]);
    }

    public function store(Request $request)
    {
        $initial = new Initial;
        $initial->fk_agent = $request->fk_agent;
        $initial->client = $request->client;
        $initial->rfc = $request->rfc;
        $initial->promoter_date = $request->promoter_date;
        $initial->system_date = $request->system_date;
        $initial->folio = $request->folio;
        $initial->fk_insurance = $request->fk_insurance;
        $initial->fk_branch = $request->fk_branch;
        $initial->fk_application = $request->fk_application;
        $initial->month = $request->month;
        $initial->pna = $request->pna;
        $initial->fk_payment_form = $request->fk_payment_form;
        $initial->fk_currency = $request->fk_currency;
        $initial->fk_charge = $request->fk_charge;
        $initial->save();
        return response()->json(["status"=>true, "message"=>"Inicial creada"]);
    }

    public function update(Request $request, $id)
    {
        $initial = Initial::where('id',$request->id)->
        update(['fk_agent'=>$request->fk_agent,
        'client' => $request->client,
        'rfc' => $request->rfc,
        'promoter_date' => $request->promoter_date,
        'system_date' => $request->system_date,
        'folio' => $request->folio,
        'fk_insurance' => $request->fk_insurance,
        'fk_branch' => $request->fk_branch,
        'fk_application' => $request->fk_application,
        'month' => $request->month,
        'pna' => $request->pna,
        'fk_payment_form' => $request->fk_payment_form,
        'fk_currency' => $request->fk_currency,
        'fk_charge' => $request->fk_charge]);
        return response()->json(['status'=>true, 'message'=>"Inicial actualizada"]);
    }

    public function destroy($id)
    {
        $initial = Initial::find($id);
        $initial->delete();
        return response()->json(['status'=>true, "message"=>"Inicial eliminado"]);
    }
}
