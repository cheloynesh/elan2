<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Insurance;
use App\User;
use App\Branch;
use App\Plan;
use App\Permission;
use App\Profile;
use App\Branch_assign;
use App\Plans_assign;
use DB;

class InsuranceController extends Controller
{
    public function index(){
        $insurances = Insurance::get();
        $profile = User::findProfile();
        $perm = Permission::permView($profile,6);
        $perm_btn =Permission::permBtns($profile,6);
        // dd($perm_btn);
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('admin.insurance.insurances', compact('insurances','perm_btn'));
        }
    }

    public function GetInfo($id)
    {
        $insurance = Insurance::where('id',$id)->first();
        return response()->json(['status'=>true, "data"=>$insurance]);
    }

    public function store(Request $request)
    {
        $insurance = new Insurance;
        $insurance->name = $request->name;
        $insurance->save();
        return response()->json(["status"=>true, "message"=>"Aseguradora creada"]);
    }

    public function update(Request $request, $id)
    {
        $insurance = Insurance::where('id',$request->id)->update(['name'=>$request->name]);
        return response()->json(['status'=>true, 'message'=>"Aseguradora actualizada"]);
    }

    public function destroy($id)
    {
        $insurance = Insurance::find($id);
        $insurance->delete();
        return response()->json(['status'=>true, "message"=>"Aseguradora eliminada"]);
    }
    public function getBranchesCont($id)
    {
        $assignedBranches = DB::table('Branch_assign')->select('fk_branch AS id','name')
            ->join('Branch','fk_branch','=','Branch.id')
            ->where('fk_insurance',$id)
            ->orderBy('name')
            ->whereNull('Branch_assign.deleted_at')->get();

        $assbrnch = array();
        foreach($assignedBranches as $branch)
        {
            // dd($branch);
            array_push($assbrnch,$branch->id);
        }

        $branches = DB::table('Branch')->select('id','name')
            ->whereNotIn('id',$assbrnch)
            ->orderBy('name')
            ->whereNull('Branch.deleted_at')->get();

        $result = array($assignedBranches,$branches);

        return $result;
    }

    public function getBranches($id)
    {
        $result = $this->getBranchesCont($id);

        return response()->json(['status'=>true, "assigned" => $result[0], "branches" => $result[1]]);
    }

    public function saveBranch(Request $request)
    {
        $assigment = new Branch_assign;
        $assigment->fk_insurance = $request->insurance;
        $assigment->fk_branch = $request->branch;
        $assigment->save();

        $result = $this->getBranchesCont($request->insurance);

        return response()->json(["status"=>true, "message"=>"Ramo Asignado", "assigned" => $result[0], "branches" => $result[1]]);
    }

    public function deleteBranch(Request $request)
    {
        $assignedBranch = DB::table('Branch_assign')->select('id')
            ->where('fk_insurance',$request->insurance)
            ->where('fk_branch',$request->branch)
            ->whereNull('deleted_at')->first();

        // dd($assignedBranch->id);
        $brnchass = Branch_assign::find($assignedBranch->id);
        $brnchass->delete();

        $result = $this->getBranchesCont($request->insurance);

        return response()->json(["status"=>true, "message"=>"Ramo removido", "assigned" => $result[0], "branches" => $result[1]]);
    }

    public function saveNewBranch(Request $request)
    {
        $branch = new Branch;
        $branch->name = $request->name;
        $branch->days = $request->days;
        $branch->save();

        $result = $this->getBranchesCont($request->insurance);

        return response()->json(["status"=>true, "message"=>"Ramo guardado", "assigned" => $result[0], "branches" => $result[1]]);
    }

    public function getPlansCont($branch, $insurance)
    {
        $brnchAss = Branch_assign::select('id')->where('fk_insurance',$insurance)->where('fk_branch',$branch)->first();

        $assignedPlans = DB::table('Plans_assign')->select('fk_plans AS id','name')
            ->join('Plans','fk_plans','=','Plans.id')
            ->where('fk_brnchass',$brnchAss->id)
            ->orderBy('name')
            ->whereNull('Plans_assign.deleted_at')->get();

        $asspln = array();
        foreach($assignedPlans as $plan)
        {
            // dd($branch);
            array_push($asspln,$plan->id);
        }

        $plans = DB::table('Plans')->select('id','name')
            ->whereNotIn('id',$asspln)
            ->orderBy('name')
            ->whereNull('Plans.deleted_at')->get();

        $result = array($assignedPlans,$plans);

        return $result;
    }

    public function getPlans($branch, $insurance)
    {
        $result = $this->getPlansCont($branch, $insurance);

        return response()->json(['status'=>true, "assigned" => $result[0], "plans" => $result[1]]);
    }

    public function savePlan(Request $request)
    {
        $brnchAss = Branch_assign::select('id')->where('fk_insurance',$request->insurance)->where('fk_branch',$request->branch)->first();

        $assigment = new Plans_assign;
        $assigment->fk_brnchass = $brnchAss->id;
        $assigment->fk_plans = $request->plan;
        $assigment->save();

        $result = $this->getPlansCont($request->branch, $request->insurance);

        return response()->json(["status"=>true, "message"=>"Ramo Asignado", "assigned" => $result[0], "plans" => $result[1]]);
    }

    public function deletePlan(Request $request)
    {
        $brnchAss = Branch_assign::select('id')->where('fk_insurance',$request->insurance)->where('fk_branch',$request->branch)->first();
        $planAss = Plans_assign::select('id')->where('fk_brnchass',$brnchAss->id)->where('fk_plans',$request->plan)->first();

        // dd($assignedBranch->id);
        $planAss = Plans_assign::find($planAss->id);
        $planAss->delete();

        $result = $this->getPlansCont($request->branch, $request->insurance);

        return response()->json(["status"=>true, "message"=>"Plan removido", "assigned" => $result[0], "plans" => $result[1]]);
    }

    public function saveNewPlan(Request $request)
    {
        $plan = new Plan;
        $plan->name = $request->name;
        $plan->save();

        $result = $this->getPlansCont($request->branch, $request->insurance);

        return response()->json(["status"=>true, "message"=>"Plan guardado", "assigned" => $result[0], "plans" => $result[1]]);
    }
}
