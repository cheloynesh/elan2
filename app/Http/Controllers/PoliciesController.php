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
use App\Receipts;

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
        $policy->initial_date = $request->initial_date;
        $policy->end_date = $request->end_date;

        if($request->arrayValues != null)
        {
            foreach($request->arrayValues as $values)
            {
                $receipts = new Receipts;
                $receipts->fk_policy = $request->policy;
                $receipts->pna = $values['pna'];
                $receipts->expedition = $values['values_exp'];
                $receipts->financ_exp = $values['values_financ'];
                $receipts->other_exp = $values['values_other'];
                $receipts->iva = $values['iva'];
                $receipts->pna_t = $values['values_total'];
                $receipts->initial_date = $values['fechaBD'];
                $receipts->end_date = $values['fechaBD'];
                $receipts->save();
            }
        }
        $policy->save();
        return response()->json(['status'=>true]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        Policy::where("id",$request->id)
        ->update(["pna"=>$request->pna,"initial_date"=>$request->initial_date,"end_date"=>$request->enda_date,
        "fk_currency"=>$request->currency,"fk_insurance"=>$request->insurance,"fk_branch"=>$request->branch,"fk_agent"=>$request->agent,
        "fk_charge"=>$request->charge,"fk_payment_form"=>$request->paymentForm,"expended_exp"=>$request->expended,"exp_impute"=>$request->exp_imp,
        "financ_exp"=>$request->financ_exp,"financ_impute"=>$request->financ_imp,"other_exp"=>$request->other_exp,
        "other_impute"=>$request->other_imp,"renovable"=>$request->renovable,"pay_frec"=>$request->pay_frec,"iva"=>$request->iva,
        "total"=>$request->pna_t]);

        $receipts_edit = Receipts::where("fk_policy",$request->id)->get();
        foreach($receipts_edit as $receipts)
        {
            $receipts->delete();
        }
        if($request->arrayValues != null)
        {
            foreach($request->arrayValues as $values)
            {
                $receipts = new Receipts;
                $receipts->fk_policy = $request->policy;
                $receipts->pna = $values['pna'];
                $receipts->expedition = $values['values_exp'];
                $receipts->financ_exp = $values['values_financ'];
                $receipts->other_exp = $values['values_other'];
                $receipts->iva = $values['iva'];
                $receipts->pna_t = $values['values_total'];
                $receipts->initial_date = $values['fechaBD'];
                $receipts->end_date = $values['fechaBD'];
                $receipts->save();
            }
        }
        
    }

    public function destroy($id)
    {
        $policy = Policy::find($id);
        $policy->delete();
        return response()->json(['status'=>true, "message"=>"Poliza eliminada"]);

    }

}
