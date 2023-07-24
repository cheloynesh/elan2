<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use App\Permission;
use App\AgentCode;
use App\Insurance;
use DB;

class UsersController extends Controller
{
    public function index(){
        $users = User::get();
        $profiles = Profile::pluck('name','id');
        $insurances = Insurance::pluck('name','id');
        $profile = User::findProfile();
        $perm = Permission::permView($profile,3);
        $perm_btn =Permission::permBtns($profile,3);
        // dd($perm_btn);
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('admin.users.user', compact('profiles','users','perm_btn','insurances'));
        }

    }

    public function GetInfo($id)
    {
        $user = User::where('id',$id)->with('agent_codes')->first();
        $codes = DB::table('Agent')->select('*')
            ->join('Insurance','fk_insurance','=','Insurance.id')
            ->where('fk_user','=',$id)
            ->whereNull('Agent.deleted_at')->get();
        return response()->json(['status'=>true, "data"=>$user, "codes"=>$codes]);

    }

    public function store(Request $request)
    {
        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->name = $request->name;
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->cellphone = $request->cellphone;
        $user->fk_profile = $request->fk_profile;
        $user->subprofile = $request->subProfile;
        $user->save();
        if($request->codes != null)
        {
            foreach($request->codes as $code)
            {
                $agentCode = new AgentCode;
                $agentCode->fk_user = $user->id;
                $agentCode->code = $code["code"];
                $agentCode->fk_insurance = $code['insurance'];
                $agentCode->save();
            }

        }

        return response()->json(['status'=>true, 'message'=>'Usuario Creado']);
    }

    public function update(Request $request)
    {
        // dd($request->all());
        if($request->password == null)
        {
            $user = User::where('id',$request->id)
            ->update(['email'=>$request->email,
            'name'=>$request->name,'firstname'=>$request->firstname,'lastname'=>$request->lastname,
            'cellphone'=>$request->cellphone,'fk_profile'=>$request->fk_profile,'subprofile'=>$request->subProfile]);
        }
        else
        {
            $user = User::where('id',$request->id)
            ->update(['email'=>$request->email,'password'=>bcrypt($request->password),
            'name'=>$request->name,'firstname'=>$request->firstname,'lastname'=>$request->lastname,
            'cellphone'=>$request->cellphone,'fk_profile'=>$request->fk_profile,'subprofile'=>$request->subProfile]);
        }
        $codes_edit = AgentCode::where('fk_user', $request->id)->get();
        foreach($codes_edit as $codes)
        {
            $codes->delete();
        }
        if($request->codigoseditar != null)
        {
            foreach($request->codigoseditar as $codigos)
            {
                $agentCode = new AgentCode;
                $agentCode->fk_user = $request->id;
                $agentCode->code = $codigos["code"];
                $agentCode->fk_insurance = $codigos["insurance"];
                $agentCode->save();
            }
        }
        return response()->json(['status'=>true, 'message'=>"Usuario Actualizado"]);

    }
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json(['status'=>true, "message"=>"Usuario eliminado"]);

    }
}
