<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use App\Permission;
use App\User;

class PlansController extends Controller
{
    public function index ()
    {
        $plans = Plan::get();
        $profile = User::findProfile();
        $perm = Permission::permView($profile,10);
        $perm_btn =Permission::permBtns($profile,10);
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('admin.plan.plans', compact('plans','perm_btn'));
        }
    }
    // cambiar modelo de seguro a Plan
    public function GetInfo($id)
    {
        $plan = Plan::where('id',$id)->first();
        return response()->json(['status'=>true, "data"=>$plan]);
    }

    public function store(Request $request)
    {
        $plan = new Plan;
        $plan->name = $request->name;
        $plan->save();
        return response()->json(["status"=>true, "message"=>"Plan creado"]);
    }

    public function update(Request $request, $id)
    {
        $plan = Plan::where('id',$request->id)->update(['name'=>$request->name]);
        return response()->json(['status'=>true, 'message'=>"Plan actualizado"]);
    }

    public function destroy($id)
    {
        $plan = Plan::find($id);
        $plan->delete();
        return response()->json(['status'=>true, "message"=>"Plan eliminado"]);
    }
}
