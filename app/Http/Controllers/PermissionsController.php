<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Permission;
use App\Section;
use App\User;
use DB;

class PermissionsController extends Controller
{
    public function index(){
        $profiles = Profile::pluck('name','id');
        $profile = User::findProfile();
        $perm = Permission::permView($profile,7);
        $perm_btn =Permission::permBtns($profile,7);
        $padre =Section::whereRaw('id = reference')->orderBy('order','ASC')->get();
        // dd($padre);
        $hijos = Section::whereRaw('id!=reference')->orderBy('order','ASC')->get();
        // dd($hijos);
        if($perm==0) {
            return redirect()->route('home');
        } else {

            return view('admin.permission.permissions', compact('perm_btn','profile','padre','hijos','profiles'));
        }
    }
    public function edit($id){
        $per = Permission::where('fk_profile','=',$id)->get();
        return response()->json($per);
    }
    public function update_store(Request $request, $fk_profile, $fk_section,$btn,$reference){
        // dd($fk_section);
        $perm = Permission::where('fk_profile','=',$fk_profile)->where('fk_section','=',$fk_section)->count();
        // dd($perm);
        if($perm>0){
            // dd($fk_profile, $fk_section,$btn,$reference);
            Permission::updatePermission($fk_profile, $fk_section, $btn, $reference);
        }else{//no existe-crear permiso
            switch ($btn) {
                case 0://VER
                    $per_ = new Permission();
                    $per_ ->fk_profile=$fk_profile;
                    $per_ ->fk_section=$fk_section;
                    $per_ ->view=1;
                    $per_->save();
                    $permisions =   DB::table('Permissions as perm')
                        ->join('Sections','Sections.id','=','perm.fk_section')
                        ->where(['Sections.reference'=>$reference,'view'=>1,'fk_profile'=>$fk_profile])
                        ->count();
                    if($permisions>0){
                        $findPermisions = Permission::where('fk_section','=',$reference)->where('fk_profile','=',$fk_profile)->get();
                        if($findPermisions->count() == 0){
                            $createPermision = new Permission();
                            $createPermision->fk_profile=$fk_profile;
                            $createPermision->fk_section=$reference;
                            $createPermision->view=1;
                            $createPermision->save();
                        }
                    }
                    break;

                case 1://AGREGAR
                    // dd("entre");
                    $per_ = new Permission();
                    $per_ ->fk_profile=$fk_profile;
                    $per_ ->fk_section=$fk_section;
                    $per_ ->view=1;
                    $per_ ->addition=1;
                    $per_->save();
                    $perms = Permission::where('fk_profile','=',$fk_profile)->where('fk_section','=',$fk_section)->pluck('fk_section');
                    // dd($perms);
                    $permisions =   DB::table('Permissions as perm')
                        ->join('Sections','Sections.id','=','perm.fk_section')
                        ->where(['Sections.reference'=>$reference,'view'=>1,'fk_profile'=>$fk_profile])
                        ->count();
                    if($permisions>0){
                        $findPermisions = Permission::where('fk_section','=',$reference)->where('fk_profile','=',$fk_profile)->get();
                        if($findPermisions->count() == 0){
                            $createPermision = new Permission();
                            $createPermision->fk_profile=$fk_profile;
                            $createPermision->fk_section=$reference;
                            $createPermision->view=1;
                            $createPermision->save();
                        }
                    }
                    return response()->json($perms);
                    break;
                case 2://EDITAR
                    // dd($btn);
                    $per_ = new Permission();
                    $per_ ->fk_profile=$fk_profile;
                    $per_ ->fk_section=$fk_section;
                    $per_ ->view=1;
                    $per_ ->modify=1;
                    $per_->save();
                    $perms = Permission::where('fk_profile','=',$fk_profile)->where('fk_section','=',$fk_section)->pluck('fk_section');

                    $permisions =   DB::table('Permissions as perm')
                        ->join('Sections','Sections.id','=','perm.fk_section')
                        ->where(['Sections.reference'=>$reference,'view'=>1,'fk_profile'=>$fk_profile])
                        ->count();
                    if($permisions>0){
                        $findPermisions = Permission::where('fk_section','=',$reference)->where('fk_profile','=',$fk_profile)->get();
                        if($findPermisions->count() == 0){
                            $createPermision = new Permission();
                            $createPermision->fk_profile=$fk_profile;
                            $createPermision->fk_section=$reference;
                            $createPermision->view=1;
                            $createPermision->save();
                        }
                    }

                    return response()->json($perms);
                    break;
                case 3://ELIMINAR
                    $per_ = new Permission();
                    $per_ ->fk_profile=$fk_profile;
                    $per_ ->fk_section=$fk_section;
                    $per_ ->view=1;
                    $per_ ->erase=1;
                    $per_->save();
                    $perms = Permission::where('fk_profile','=',$fk_profile)->where('fk_section','=',$fk_section)->pluck('fk_section');

                    $permisions =   DB::table('Permissions as perm')
                        ->join('Sections','Sections.id','=','perm.fk_section')
                        ->where(['Sections.reference'=>$reference,'view'=>1,'fk_profile'=>$fk_profile])
                        ->count();
                    if($permisions>0){
                        $findPermisions = Permission::where('fk_section','=',$reference)->where('fk_profile','=',$fk_profile)->get();
                        if($findPermisions->count() == 0){
                            $createPermision = new Permission();
                            $createPermision->fk_profile=$fk_profile;
                            $createPermision->fk_section=$reference;
                            $createPermision->view=1;
                            $createPermision->save();
                        }
                    }
                    return response()->json($perms);
                    break;
            }
        }

    }
}
