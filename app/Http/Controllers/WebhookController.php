<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Policy;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('Datos recibidos del webhook:', $request->all());

        $datas = $request->all();
        foreach ($datas as $data)
        {
            switch($data["propertyName"])
            {
                case "poliza": $initial = Policy::where('id_hubspot',$data["objectId"])->update(['policy' => $data["propertyValue"]]); break;
                case "pna_monto": $initial = Policy::where('id_hubspot',$data["objectId"])->update(['pna' => $data["propertyValue"]]); break;
                case "referencia": $initial = Policy::where('id_hubspot',$data["objectId"])->update(['reference' => $data["propertyValue"]]); break;
            }
        }
        return response()->json(['message' => 'Webhook procesado'], 200);
    }
}
