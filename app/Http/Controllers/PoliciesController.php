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
use App\Branch_assign;
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
        if($client->fk_insurance != null)
        {
            $brnchAss = Branch_assign::select('id')->where('fk_insurance',$client->fk_insurance)->where('fk_branch',$client->fk_branch)->first();

            $assignedBranches = DB::table('Branch_assign')->select('fk_branch AS id','name')
                ->join('Branch','fk_branch','=','Branch.id')
                ->where('fk_insurance',$client->fk_insurance)
                ->whereNull('Branch_assign.deleted_at')->get();

            $assignedPlans = DB::table('Plans_assign')->select('fk_plans AS id','name')
                ->join('Plans','fk_plans','=','Plans.id')
                ->where('fk_brnchass',$brnchAss->id)
                ->whereNull('Plans_assign.deleted_at')->get();
        }
        else
        {
            $assignedBranches = $assignedPlans = null;
        }

        return response()->json(['status'=>true, "data"=>$client, "branches" => $assignedBranches, "plans" => $assignedPlans]);
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

        $policy->pna = $request->pna;
        $policy->fk_currency = $request->currency;
        $policy->fk_insurance = $request->insurance;
        $policy->fk_branch = $request->branch;
        $policy->fk_plan = $request->plan;
        $policy->fk_agent = $request->agent;
        $policy->fk_charge = $request->charge;
        $policy->fk_payment_form = $request->paymentForm;
        $policy->initial_date = $request->initial_date;
        $policy->end_date = $request->end_date;
        $policy->save();

        $id = Policy::where('policy',$request->policy)->first();

        if($request->arrayValues != null)
        {
            foreach($request->arrayValues as $values)
            {
                $receipts = new Receipts;
                $receipts->fk_policy = $id->id;
                $receipts->pna = $values['pna'];
                $receipts->expedition = $values['values_exp'];
                $receipts->financ_exp = $values['values_financ'];
                $receipts->other_exp = $values['values_other'];
                $receipts->iva = $values['iva'];
                $receipts->pna_t = $values['values_total'];
                $receipts->initial_date = $values['fechaBD'];
                $receipts->end_date = $values['fechaFin'];
                $receipts->save();
            }
        }
        return response()->json(['status'=>true]);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        Policy::where("id",$request->id)
        ->update(["pna"=>$request->pna,"initial_date"=>$request->initial_date,"end_date"=>$request->end_date,
        "fk_currency"=>$request->currency,"fk_insurance"=>$request->insurance,"fk_branch"=>$request->branch,"fk_agent"=>$request->agent,
        "fk_charge"=>$request->charge,"fk_payment_form"=>$request->paymentForm,"expended_exp"=>$request->expended,"exp_impute"=>$request->exp_imp,
        "financ_exp"=>$request->financ_exp,"financ_impute"=>$request->financ_imp,"other_exp"=>$request->other_exp,
        "other_impute"=>$request->other_imp,"renovable"=>$request->renovable,"iva"=>$request->iva,
        "total"=>$request->pna_t]);

        $receipts_edit = Receipts::where("fk_policy",$request->id)->get();
        foreach($receipts_edit as $receipts)
        {
            $receipts->delete();
        }
        // dd($request->arrayValues);
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
                $receipts->end_date = $values['fechaFin'];
                $receipts->save();
            }
        }
        return response()->json(['status'=>true,"message"=>"Poliza actualizada"]);
    }

    public function destroy($id)
    {
        $policy = Policy::find($id);
        $policy->delete();
        return response()->json(['status'=>true, "message"=>"Poliza eliminada"]);

    }

    public function getBranches($id)
    {
        $assignedBranches = DB::table('Branch_assign')->select('fk_branch AS id','name')
            ->join('Branch','fk_branch','=','Branch.id')
            ->where('fk_insurance',$id)
            ->orderBy('name')
            ->whereNull('Branch_assign.deleted_at')->get();
        // dd($id);

        return response()->json(['status'=>true, "branches" => $assignedBranches]);
    }

    public function getPlans($insurance, $branch)
    {
        if($branch != 0)
        {
            $brnchAss = Branch_assign::select('id')->where('fk_insurance',$insurance)->where('fk_branch',$branch)->first();

            $assignedPlans = DB::table('Plans_assign')->select('fk_plans AS id','name')
                ->join('Plans','fk_plans','=','Plans.id')
                ->where('fk_brnchass',$brnchAss->id)
                ->orderBy('name')
                ->whereNull('Plans_assign.deleted_at')->get();
        }
        else
        {
            $assignedPlans = [];
        }

        return response()->json(['status'=>true, "branches" => $assignedPlans]);
    }

}
