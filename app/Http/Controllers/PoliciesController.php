<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Policy;
use App\Permission;
use App\User;
use App\Client;
use DB;
use App\Initial;
use App\Currency;
use App\Insurance;
use App\Paymentform;
use App\Charge;
use App\Branch;

class PoliciesController extends Controller
{
    public function index ()
    {

        // $policy = Policy::get();
        $clients = Client::get();
        $profile = User::findProfile();
        $perm = Permission::permView($profile,11);
        $perm_btn =Permission::permBtns($profile,11);
        $agents = User::select('id', DB::raw('CONCAT(name," ",firstname) AS name'))->where("fk_profile","12")->pluck('name','id');
        $currencies = Currency::pluck('name','id');
        $insurances = Insurance::pluck('name','id');
        $paymentForms = Paymentform::pluck('name','id');
        $charges = Charge::pluck('name','id');
        $branches = Branch::pluck('name','id');
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('policies.policy', compact('perm_btn','clients','agents','currencies','insurances','paymentForms','charges','branches'));
        }
    }
    public function GetInfo($id)
    {
        $client = DB::table("Client")
        ->select('Client.inicial','Client.status', 'fk_agent', 'fk_insurance', 'fk_branch', 'pna',
        'fk_currency', 'fk_payment_form', 'fk_charge')
        ->leftJoin('Initials','Initials.id','=','inicial')
        ->where('Client.id',$id)
        ->first();
        // dd($client);
        return response()->json(['status'=>true, "data"=>$client]);
    }
    public function CheckPolicy($policy)
    {
        $policy = Policy::where('policy',$policy)->first();
        if($policy == null)
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }

    // public function savepolicy(Request $request)
    // {
    //     // dd($request->all());
    //     $initial = new Initial;
    //     $initial->firstname = $request->idClient;
    //     $initial->pna = $request->pna;
    //     $initial->fk_currency = $request->currency;
    //     $initial->fk_insurance = $request->insurance;
    //     $initial->fk_branch = $request->branch;
    //     $initial->fk_agent = $request->agent;
    //     $initial->fk_charge = $request->charge;
    //     $initial->fk_payment_form = $request->paymentForm;
    //     $initial->save();
    //     $initial_id = DB::table('Initials')->select('id')->where('firstname', $request->idClient)->first();
    //     // dd($initial_id);
    //     $client = Client::where('id', $request->idClient)->first();
    //     $client->inicial = $initial_id->id;

    //     // dd($client);
    //     $client->save();
    // }

    public function store(Request $request)
    {
        // dd($request->all());
        $policy = new Policy;
        $policy->fk_client = $request->id;
        $policy->policy = $request->policy;
        $policy->expended_exp = $request->expended;
        $policy->exp_impute = $request->exp_imp;
        $policy->financ_exp = $request->financ_exp;
        $policy->financ_impute = $request->financ_imp;
        $policy->other_exp = $request->other_exp;
        $policy->other_impute = $request->other_imp;
        $policy->iva = $request->iva;
        $policy->total = $request->pna_t;
        $policy->renovable = $request->renovable;
        $policy->pay_frec = $request->pay_frec;

        $policy->pna = $request->pna;
        $policy->fk_currency = $request->currency;
        $policy->fk_insurance = $request->insurance;
        $policy->fk_branch = $request->branch;
        $policy->fk_agent = $request->agent;
        $policy->fk_charge = $request->charge;
        $policy->fk_payment_form = $request->paymentForm;
        $policy->initial_date = $request->inital_date;
        $policy->end_date = $request->end_date;

        $policy->save();
        return response()->json(['status'=>true]);

    }

    public function CheckDate(Request $request)
    {
        
    }
}
