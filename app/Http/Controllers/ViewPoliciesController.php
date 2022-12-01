<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Policy;
use App\Permission;
use App\User;
use App\Receipts;
use App\Currency;
use App\Insurance;
use App\Paymentform;
use App\Charge;
use App\Branch;
use App\Status;
use App\Client;
use App\Branch_assign;
use DB;

class ViewPoliciesController extends Controller
{
    public function index ()
    {
        // $policy = DB::table('Policy')
        // ->select('Policy.*',DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(firstname, "")," ",IFNULL(lastname, "")) AS name'),'Client.rfc')
        // ->join('Client','Client.id','=','Policy.fk_client')->whereNull('Policy.deleted_at')
        // ->get();
        // dd($policy);
        $clients = Client::get();
        $policy = DB::table('Status')
        ->select('Status.id as statId','Status.name as statName','color','Policy.*',DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(firstname, "")," ",IFNULL(lastname, "")) AS name'),'Client.rfc')
        ->join('Policy','Policy.fk_status','=','Status.id')
        ->join('Client','Client.id','=','Policy.fk_client')
        ->whereNull('Policy.deleted_at')
        ->get();
        // dd($policy[0]->color);


        // CONCAT(isnull(`affiliate_name`,''),'-',isnull(`model`,''),'-',isnull(`ip`,'')
        $cmbStatus = Status::select('id','name')
        ->where("fk_section","20")
        ->pluck('name','id');
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
            return view('policies.viewPolicies', compact('perm_btn','policy','agents','currencies','insurances','paymentForms',
            'charges','branches','cmbStatus','clients'));
        }
    }

    public function ViewReceipts($id)
    {
        // dd($id);
        $receipts = Receipts::where('fk_policy',$id)->get();
        // dd($receipts);
        return response()->json(['status'=>true, "data"=>$receipts]);

    }

    public function GetInfo($id)
    {
        // dd($id);
        $policy = DB::table('Policy')->select('*',DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(firstname, "")," ",IFNULL(lastname, "")) AS name'))
            ->join('Client','fk_client','=','Client.id')
            ->where('Policy.id',$id)->first();
        // dd($policy);

        if($policy->fk_insurance != null)
        {
            $brnchAss = Branch_assign::select('id')->where('fk_insurance',$policy->fk_insurance)->where('fk_branch',$policy->fk_branch)->first();

            $assignedBranches = DB::table('Branch_assign')->select('fk_branch AS id','name')
                ->join('Branch','fk_branch','=','Branch.id')
                ->where('fk_insurance',$policy->fk_insurance)
                ->orderBy('name')
                ->whereNull('Branch_assign.deleted_at')->get();

            $assignedPlans = DB::table('Plans_assign')->select('fk_plans AS id','name')
                ->join('Plans','fk_plans','=','Plans.id')
                ->where('fk_brnchass',$brnchAss->id)
                ->orderBy('name')
                ->whereNull('Plans_assign.deleted_at')->get();
        }
        else
        {
            $assignedBranches = $assignedPlans = null;
        }

        // dd($policy,$assignedBranches,$assignedPlans);
        return response()->json(['status'=>true, "data"=>$policy, "branches" => $assignedBranches, "plans" => $assignedPlans]);

    }

    public function paypolicy(Request $request){
        // dd($request->all());

        $status = Receipts::where('id',$request->id)->first();
        // dd($status);
        // dd($request->all());
        $status->status = $request->auth;
        $status->save();
        return response()->json(['status'=>true, "message"=>"Recibo Pagado"]);

    }
    public function cancelpaypolicy(Request $request){
        // dd($request->all());

        $status = Receipts::where('id',$request->id)->first();
        // dd($status);
        // dd($request->all());
        $status->status = null;
        $status->save();
        return response()->json(['status'=>true, "message"=>"Recibo Cancelado"]);

    }
    public function updateStatus(Request $request)
    {
        $status = Policy::where('id',$request->id)->first();
        // dd($status);
        $status->fk_status = $request->status;
        $status->save();
        return response()->json(['status'=>true, "message"=>"Estatus Actualizado"]);
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
    public function GetInfoClient($id)
    {
        $client = DB::table('Client')->select('status',DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(firstname, "")," ",IFNULL(lastname, "")) AS name'))->where('id',$id)->first();
        return response()->json(['status'=>true, "data" => $client]);
    }
}
