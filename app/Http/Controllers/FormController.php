<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index ()
    {
        return view('hiring.form.form');
    }
    public function uploadRequest(Request $request)
    {
        // dd("entre");
        if($request->hasFile("cv")){

            $imagen = $request->file("cv");
            $nombreimagen = "CV.".$imagen->guessExtension();
            $ruta = public_path("files/cv/");

            //$imagen->move($ruta,$nombreimagen);
            copy($imagen->getRealPath(),$ruta.$nombreimagen);
        }
        // dd($request->flagTR);
        // return;
        return response()->json(['status'=>true, "message"=>"Estatus Actualizado"]);
    }
    public function thankyou ()
    {
        return view('hiring.form.thanks');
    }
}
