<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidates;
use DateTime;
use DB;

class FormController extends Controller
{
    public function index ()
    {
        return view('hiring.form.form');
    }
    public function uploadRequest($origin,Request $request)
    {
        // dd($origin);
        date_default_timezone_set('America/Mexico_City');
        $today = new DateTime();

        if($request->hasFile("cv"))
        {
            $imagen = $request->file("cv");
            $nombreimagen = "CV_".$request->name."_".$request->firstname."_".$request->lastname."_".date_format($today, 'Y-m-d').".".$imagen->guessExtension();
            $ruta = public_path("files/cv/");

            copy($imagen->getRealPath(),$ruta.$nombreimagen);
        }

        $candidate = new Candidates;
        $candidate->name = $request->name;
        $candidate->firstname = $request->firstname;
        $candidate->lastname = $request->lastname;
        $candidate->age = $request->age;
        $candidate->city = $request->city;
        $candidate->scholarity = $request->scholarity;
        $candidate->social = $request->social;
        $candidate->sales_exp = $request->sales_exp;
        $candidate->mail = $request->mail;
        $candidate->cv = $nombreimagen;
        $candidate->application_date = date_format($today, 'Y-m-d');
        $candidate->origin = $origin;
        $candidate->save();

        return response()->json(['status'=>true]);
    }
    public function thankyou ()
    {
        return view('hiring.form.thanks');
    }
}
