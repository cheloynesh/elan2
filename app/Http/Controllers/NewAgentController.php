<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Status;
use App\Permission;
use App\Candidates;
use DB;

class NewAgentController extends Controller
{
    public function index()
    {
        $profile = User::findProfile();
        $perm = Permission::permView($profile,30);
        $perm_btn =Permission::permBtns($profile,30);
        $candidates = DB::select('call newAgentTable(1)');
        // dd($candidates);
        $cmbStatus = Status::select('id','name')
        ->where("fk_section","30")
        ->pluck('name','id');
        // dd($perm_btn);
        if($perm==0)
        {
            return redirect()->route('home');
        }
        else
        {
            return view('hiring.control.newagent', compact('perm_btn','candidates','cmbStatus'));
        }
    }

    public function GetTable($id)
    {
        $candidates = DB::select('call newAgentTable(1)');
        // dd($candidates);
        return response()->json(['status'=>true, "data"=>$candidates]);
    }

    public function SaveYesNo(Request $request)
    {
        // dd($request->all());
        $profile = Candidates::where('id',$request->id)->first();
        $btns = explode("-", $profile->btn_colors);
        if(intval($request->input) == 0) $btns[intval($request->btns)] = "danger"; else $btns[intval($request->btns)] = "success";
        $btn = join("-",$btns);
        // dd($btn);
        $prof = Candidates::where('id',$request->id)->update([$request->field => $request->input,'btn_colors' => $btn]);

        $this->checkStatus($profile,$request->field,$request->input);

        $candidates = DB::select('call newAgentTable(1)');
        return response()->json(['status'=>true, 'message'=>"Actualizado", "data"=>$candidates]);
    }

    public function SaveDocs(Request $request)
    {
        $profile = Candidates::where('id',$request->id)->first();
        $btns = explode("-", $profile->btn_colors);
        if(intval($request->input) == 0) $btns[intval($request->btns)] = "danger"; else $btns[intval($request->btns)] = "success";
        $btn = join("-",$btns);
        $prof = Candidates::where('id',$request->id)->update([$request->field => $request->input,'btn_colors' => $btn,
        'doc_curp' => $request->doc_curp === 'true'? 1: 0, 'doc_fiscadd' => $request->doc_fiscadd === 'true'? 1: 0, 'doc_add' => $request->doc_add === 'true'? 1: 0, 'doc_bank' => $request->doc_bank === 'true'? 1: 0,
        'doc_birth' => $request->doc_birth === 'true'? 1: 0, 'doc_sat' => $request->doc_sat === 'true'? 1: 0, 'doc_school' => $request->doc_school === 'true'? 1: 0, 'doc_ine' => $request->doc_ine === 'true'? 1: 0]);

        $this->checkStatus($profile,$request->field,$request->input);

        $candidates = DB::select('call newAgentTable(1)');
        return response()->json(['status'=>true, 'message'=>"Actualizado", "data"=>$candidates]);
    }

    public function SaveCharge(Request $request)
    {
        $prof = Candidates::where('id',$request->id)->update([$request->field => $request->input]);
        $candidates = DB::select('call newAgentTable(1)');
        return response()->json(['status'=>true, 'message'=>"Actualizado", "data"=>$candidates]);
    }

    public function SaveDate(Request $request)
    {
        // dd($request->all());
        $profile = Candidates::where('id',$request->id)->first();
        $btns = explode("-", $profile->btn_colors);
        if($request->input == null) $btns[intval($request->btns)] = "danger"; else $btns[intval($request->btns)] = "success";
        $btn = join("-",$btns);
        // dd($btn);
        $prof = Candidates::where('id',$request->id)->update([$request->field => $request->input,'btn_colors' => $btn]);
        $this->checkStatus($profile,$request->field,$request->input);
        $candidates = DB::select('call newAgentTable(1)');
        return response()->json(['status'=>true, 'message'=>"Actualizado", "data"=>$candidates]);
    }

    public function SaveText(Request $request)
    {
        $prof = Candidates::where('id',$request->id)->update([$request->field => $request->input]);
        $candidates = DB::select('call newAgentTable(1)');
        return response()->json(['status'=>true, 'message'=>"Actualizado", "data"=>$candidates]);
    }

    public function SaveSales(Request $request)
    {
        $profile = Candidates::where('id',$request->id)->first();
        $btns = explode("-", $profile->btn_colors);
        // dd($request->all());
        if(intval($request->total) == 0) $btns[intval($request->btns)] = "danger"; else $btns[intval($request->btns)] = "success";
        $btn = join("-",$btns);

        $prof = Candidates::where('id',$request->id)->update(["sales" => $request->sales,'btn_colors' => $btn]);
        $this->checkStatus($profile,$request->field,$request->total);
        $candidates = DB::select('call newAgentTable(1)');
        return response()->json(['status'=>true, 'message'=>"Actualizado", "data"=>$candidates]);
    }

    public function GetDocs(Request $request)
    {
        $prof = Candidates::select('doc_curp', 'doc_fiscadd', 'doc_add', 'doc_bank', 'doc_birth', 'doc_sat', 'doc_school', 'doc_ine')->where('id',$request->id)->first();
        return response()->json(['status'=>true, "docs"=>$prof]);
    }

    public function checkStatus($agent,$status,$input)
    {
        $stat = 0;
        switch($status)
        {
            case 'date_fst_int':
                if($agent->second_status < 31 && $input != null) $stat = 31;
                break;
            case 'pda':
                if($agent->second_status < 32 && intval($input) != 0) $stat = 32;
                break;
            case 'date_sec_int':
                if($agent->second_status < 33 && $input != null) $stat = 33;
                break;
            case 'confirmed':
                if($agent->second_status < 34 && intval($input) != 0) $stat = 34;
                break;
            case 'induction':
                if($agent->second_status < 35 && $input != null) $stat = 35;
                break;
            case 'sales_dates':
                if($agent->second_status < 36 && intval($input) != 0) $stat = 36;
                break;
            case 'sales':
                if($agent->second_status < 37 && intval($input) != 0) $stat = 37;
                break;
            case 'signed_cia':
                if($agent->second_status < 38 && intval($input) != 0) $stat = 38;
                break;
            case 'cia':
                if($agent->second_status < 39 && $input != null) $stat = 39;
                break;
            case 'exam_date':
                if($agent->second_status < 40 && $input != null) $stat = 40;
                break;
            case 'exam':
                if($agent->second_status < 41 && intval($input) != 0) $stat = 41;
                break;
            case 'cnsf_date':
                if($agent->second_status < 42 && intval($input) != 0) $stat = 42;
                break;
            case 'license':
                if($agent->second_status < 43 && $input != null) $stat = 43;
                break;
            case 'metlife_sign':
                if($agent->second_status < 44 && $input != null) $stat = 44;
                break;
            case 'met_graduate':
                if($agent->second_status < 45 && intval($input) != 0) $stat = 45;
                break;
        }
        if($stat != 0)
        {
            // dd($stat);
            $prof = Candidates::where('id',$agent->id)->update(['second_status' => $stat]);
        }
        return response()->json(['status'=>true]);
    }

    public function updateStatus(Request $request)
    {
        $status = Candidates::where('id',$request->id)->first();
        // dd($status);
        $status->second_status = $request->status;
        $status->save();

        $candidates = DB::select('call newAgentTable(1)');

        return response()->json(['status'=>true, "message"=>"Estatus Actualizado", "candidates" => $candidates]);
    }

    public function updateStatusAct(Request $request)
    {
        $status = Candidates::where('id',$request->id)->first();
        // dd($status);
        $status->active_stat = $request->status;
        $status->save();

        $candidates = DB::select('call newAgentTable(1)');

        return response()->json(['status'=>true, "message"=>"Estatus Actualizado", "candidates" => $candidates]);
    }
}
