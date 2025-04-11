<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Prueba;
use App\Insurance;
use App\Initial;
use App\Service;
use App\Policy;
use App\Imports\InitialsImport;
use App\Imports\ServiceImport;

use HubSpot\Factory;
use HubSpot\Client\Crm\Contacts\ApiException;

class PruebasController extends Controller
{
    public function index(){
        $profiles = Prueba::get();
        $prof = Prueba::pluck('name','id');
        $insurances = Insurance::get();
        return view('admin.pruebas.prueba', compact('profiles','insurances','prof'));
    }

    public function GetInfo($id)
    {
        $profile = Prueba::where('id',$id)->first();
        // dd($profile);
        return response()->json(['status'=>true, "data"=>$profile]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $profile = new Prueba;
        $profile->name = $request->name;
        $profile->save();
        return response()->json(["status"=>true, "message"=>"Perfil Creado"]);
    }

    public function update(Request $request, $id)
    {
        $profile = Prueba::where('id',$request->id)->update(['name'=>$request->name]);
        return response()->json(['status'=>true, 'message'=>"Perfil Actualizado"]);
    }

    public function destroy($id)
    {
        $profile = Prueba::find($id);
        $profile->delete();
        return response()->json(['status'=>true, "message"=>"Perfil eliminado"]);
    }

    public function import($active, Request $request)
    {
        // dd("entre");
        set_time_limit(1000);
        $file = $request->file('excl');
        // $file = $request->file;
        $imp = new InitialsImport();
        $new_balance = 0;
        $prev_balance = 0;
        // dd($request);
        // Excel::import($imp, $file);
        $array = ($imp)->toArray($file);
        // dd($array[0][1]);
        $array2 = array();
        $arrayNotFound = array();
        $cont = 0;
        $goodCont = 0;
        foreach ($array[0] as $moves)
        {
            $initial = Initial::where('id',$moves[0])->update(['guide' => $moves[1]]);
        }

        return response()->json(['status'=>true, 'message'=>"Datos Subidos"]);
    }

    public function importServ($active, Request $request)
    {
        // dd("entre");
        set_time_limit(1000);
        $file = $request->file('excl');
        // $file = $request->file;
        $imp = new ServiceImport();
        $new_balance = 0;
        $prev_balance = 0;
        // dd($request);
        // Excel::import($imp, $file);
        $array = ($imp)->toArray($file);
        // dd($array[0][1]);
        $array2 = array();
        $arrayNotFound = array();
        $cont = 0;
        $goodCont = 0;
        foreach ($array[0] as $moves)
        {
            $initial = Service::where('id',$moves[0])->update(['guide' => $moves[1]]);
        }

        return response()->json(['status'=>true, 'message'=>"Datos Subidos"]);
    }

    public function importHub($active, Request $request)
    {
        // dd("entre");
        set_time_limit(1000);
        $file = $request->file('excl');
        // $file = $request->file;
        $imp = new ServiceImport();
        $new_balance = 0;
        $prev_balance = 0;
        // dd($request);
        // Excel::import($imp, $file);
        $array = ($imp)->toArray($file);
        // dd($array[0][1]);
        $array2 = array();
        $arrayNotFound = array();
        $cont = 0;
        $goodCont = 0;
        foreach ($array[0] as $moves)
        {
            $initial = Policy::where('policy',$moves[0])->update(['id_hubspot' => $moves[1]]);
        }

        return response()->json(['status'=>true, 'message'=>"Datos Subidos"]);
    }

    public function GetHubspot($id)
    {
        $client = Factory::createWithAccessToken('pat-na1-07d46786-1140-446c-a8a0-474543dad55e');

        // try {
        //     $apiResponse = $client->crm()->contacts()->basicApi()->getPage(100, false);
        //     dd($apiResponse);
        // } catch (ApiException $e) {
        //     echo "Exception when calling basic_api->get_page: ", $e->getMessage();
        // }
        try {
            // $apiResponse = $client->crm()->deals()->basicApi()->getPage(10, false);
            $apiResponse = $client->crm()->deals()->basicApi()->getPage(10, '0', ['poliza','dealname'], false);
            Log::info('Webhook recibido:', $apiResponse->getResults());
            Log::info('------------------------------------------------------------');
            dd($apiResponse->getResults());
        } catch (ApiException $e) {
            echo "Exception when calling basic_api->get_page: ", $e->getMessage();
        }
        // dd($profile);
        // return response()->json(['status'=>true, "data"=>$profile]);
    }
    public function HubSpotChange(Request $request)
    {
        Log::info('hubspot---------------------------------------');
        Log::info('Webhook recibido:', $request);
    }
}
