<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Prueba;
use App\Insurance;
use App\Initial;
use App\Service;
use App\Policy;
use App\Imports\InitialsImport;
use App\Imports\ServiceImport;

use App\Exports\HubExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

use HubSpot\Factory;
use HubSpot\Client\Crm\Invoices\Model\PublicAssociation;
use HubSpot\Client\Crm\Contacts\ApiException;
use HubSpot\Client\Crm\Invoices\Model\AssociationSpec;
use HubSpot\Client\Crm\Invoices\Model\PublicAssociationsForObject;
use HubSpot\Client\Crm\Invoices\Model\PublicObjectId;
use HubSpot\Client\Crm\Invoices\Model\SimplePublicObjectInputForCreate;

use Carbon\Carbon;

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

    public function importPoliz($active, Request $request)
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
            // $moves[18] = $this->transformDate($moves[18]);
            // $moves[19] = $this->transformDate($moves[19]);
            // $initial = Policy::where('id',$moves[0])->update([
            //     'reference' => $moves[1],
            //     'pna' => $moves[2],
            //     'expended_exp' => $moves[3],
            //     'exp_impute' => $moves[4],
            //     'financ_exp' => $moves[5],
            //     'financ_impute' => $moves[6],
            //     'other_exp' => $moves[7],
            //     'other_impute' => $moves[8],
            //     'iva' => $moves[9],
            //     'total' => $moves[10],
            //     'fk_insurance' => $moves[11],
            //     'fk_branch' => $moves[12],
            //     'fk_plan' => $moves[13],
            //     'renovable' => $moves[14],
            //     'fk_currency' => $moves[15],
            //     'fk_charge' => $moves[16],
            //     'fk_payment_form' => $moves[17],
            //     'initial_date' => $moves[18],
            //     'end_date' => $moves[19],
            //     'rcp_update' => 1,
            // ]);

            $initial = Policy::where('id',$moves[0])->update([
                'fk_agent' => $moves[2],
                'fk_client' => $moves[3],
            ]);
        }

        return response()->json(['status'=>true, 'message'=>"Datos Subidos"]);
    }

    public function transformDate($value)
    {
        return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value))->format('Y-m-d');
    }

    public function importHub($active, Request $request)
    {
        // dd("entre");
        set_time_limit(3600);
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
        $token = env('HUBSPOT_TOKEN');
        foreach ($array[0] as $moves)
        {
            // dump($moves[0],$moves[1],$moves[2],$moves[3]);
            // $cont = $this->HubSpotCreateInvoice($moves[0],$moves[1],$moves[2],$moves[3]);
            // array_push($array2,array($cont,$moves[1],$moves[3]));

            $cont = $this->getInvoiceCompanyAssociationTypeId($moves[0],$moves[1],$moves[2]);
        }
        // $filename = 'hub_export_' . now()->format('Ymd_His') . '.xlsx';
        // $path = public_path("exports/{$filename}");

        // // Asegura que la carpeta exista
        // if (!file_exists(public_path('exports'))) {
        //     mkdir(public_path('exports'), 0777, true);
        // }

        // // Guarda el archivo en public/exports
        // Excel::store(new HubExport($array2), "exports/{$filename}", 'public');
        // if (Storage::disk('public')->exists("exports/{$filename}")) {
        //     echo "✅ Archivo creado en: storage/app/public/exports/{$filename}";
        //     echo "\nAccede en: " . asset("storage/exports/{$filename}");
        // } else {
        //     echo "❌ No se guardó el archivo.";
        // }
        // return Excel::download(new HubExport($array2), 'hub_export.xlsx');

        return response()->json(['status'=>true, 'message'=>"Datos Subidos"]);
    }

    public function GetHubspot($id)
    {
        $token = Factory::createWithAccessToken(env('HUBSPOT_TOKEN'));

        // try {
        //     $apiResponse = $client->crm()->contacts()->basicApi()->getPage(100, false);
        //     dd($apiResponse);
        // } catch (ApiException $e) {
        //     echo "Exception when calling basic_api->get_page: ", $e->getMessage();
        // }
        // try {
        //     // $apiResponse = $client->crm()->deals()->basicApi()->getPage(10, false);
        //     $apiResponse = $client->crm()->deals()->basicApi()->getPage(10, '0', ['poliza','dealname'], false);
        //     dd($apiResponse->getResults());
        // } catch (ApiException $e) {
        //     echo "Exception when calling basic_api->get_page: ", $e->getMessage();
        // }
        // dd($profile);
        // return response()->json(['status'=>true, "data"=>$profile]);

        $url = "https://api.hubapi.com/crm/v3/objects/deals/search";

        $payload = [
            "filterGroups" => [[
                "filters" => [[
                    "propertyName" => "poliza",
                    "operator" => "EQ",
                    "value" => "1074161"
                ]]
            ]],
            "properties" => ["dealname", "poliza", "pipeline", "dealstage"],
            "limit" => 10
        ];

        $response = $token->crm()->deals()->searchApi()->doSearch($payload);

        dd($response);

        if ($response->successful()) {
            return $response->json();
        } else {
            dd("❌ Error al buscar deals", $response->status(), $response->json());
        }
    }
    public function HubSpotChange(Request $request)
    {
        Log::info('hubspot---------------------------------------');
        Log::info('Webhook recibido:', $request);
    }

    public function HubSpotCreateInvoice($number,$date,$empresaId,$newLineItemAmount)
    {
        $token = env('HUBSPOT_TOKEN');
        // $empresaId = '34931261783';
        $contactId = '115804290053';
        $lineItemId = '31763898235'; // Replace with your actual line item ID

        $now = now()->toIso8601String();

        // $data = [
        //     'properties' => [
        //         'hs_initial_amount' => $newLineItemAmount,
        //         'hs_initiated_date' => now()->toIso8601String(),
        //     ]
        // ];

        // $response = Http::withToken($token)
        //     ->post('https://api.hubapi.com/crm/v3/objects/commerce_payments', $data);

        // if ($response->successful()) {
        //     $paymentId = $response->json()['id'];
        //     // dump('✅ Pago creada con éxito:', $response->json());
        //     echo "✅ Pago creado con ID: $paymentId";
        // } else {
        //     dd('❌ Error al crear el pago:', $response->status(), $response->json());
        // }

        $body = [
            'properties' => [
                'name' => 'Ingresos',
                'price' => $newLineItemAmount,
                'quantity' => '1',
                'hs_product_id' => null, // Opcional si no está vinculado a un producto
                'description' => 'Comisiones y bonos'
            ]
        ];

        $response = Http::withToken($token)
            ->post('https://api.hubapi.com/crm/v3/objects/line_items', $body);

        if ($response->successful()) {
            $nuevoId = $response->json()['id'];
            dump("✅ Line item creado con ID: $nuevoId");
        } else {
            dd('❌ Error al crear line item:', $response->status(), $response->json());
        }

        $invoicePayload = [
            'inputs' => [
                [
                    'properties' => [
                        'hs_title' => 'Factura desde batch',
                        'hs_number' => $number,
                        'hs_currency' => 'MXN',
                        'hs_invoice_date' => \Carbon\Carbon::parse($date)->toIso8601String()
                        // 'hs_invoice_status' => 'open'
                    ],
                    'associations' => [
                        [
                            'to' => [
                                'id' => $empresaId
                            ],
                            'types' => [
                                [
                                    'associationCategory' => 'HUBSPOT_DEFINED',
                                    'associationTypeId' => 179
                                ]
                            ]
                        ],
                        [
                            'to' => [
                                'id' => $nuevoId
                            ],
                            'types' => [
                                [
                                    'associationCategory' => 'HUBSPOT_DEFINED',
                                    'associationType' => 'INVOICE_TO_LINE_ITEM',
                                    'associationTypeId' => 409
                                ]
                            ]
                        ],
                        [
                            'to' => [
                                'id' => $contactId
                            ],
                            'types' => [
                                [
                                    'associationCategory' => 'HUBSPOT_DEFINED',
                                    'associationTypeId' => 177
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $invoiceResponse = Http::withToken($token)
            ->post('https://api.hubapi.com/crm/v3/objects/invoices/batch/create', $invoicePayload);

        if ($invoiceResponse->successful()) {
            dump('✅ Factura creada con éxito:', $invoiceResponse->json());
            $invoiceId = $invoiceResponse->json()['results'][0]['id'];
        } else {
            dd('❌ Error al crear la factura:', $invoiceResponse->status(), $invoiceResponse->json());
        }

        $updateData = [
            'properties' => [
                'hs_invoice_status' => 'open',
            ]
        ];

        $response = Http::withToken($token)
            ->patch("https://api.hubapi.com/crm/v3/objects/invoices/{$invoiceId}", $updateData);

        $updateData = [
            'properties' => [
                'hs_number' => $number,
            ]
        ];

        $response = Http::withToken($token)
            ->patch("https://api.hubapi.com/crm/v3/objects/invoices/{$invoiceId}", $updateData);
            // ->patch("https://api.hubapi.com/crm/v3/objects/invoices/443049167025", $updateData);
        return $invoiceId;
    }

    public function getInvoiceCompanyAssociationTypeId($invoiceId,$date,$pay)
    {
        $token = env('HUBSPOT_TOKEN');
        // $invoiceId = 443063158392;

        $data = [
            'properties' => [
                'hs_initial_amount' => $pay,
                'hs_initiated_date' => \Carbon\Carbon::parse($date)->toIso8601String()
            ]
        ];

        $response = Http::withToken($token)
            ->post('https://api.hubapi.com/crm/v3/objects/commerce_payments', $data);

        if ($response->successful()) {
            $paymentId = $response->json()['id'];
            // dump('✅ Pago creada con éxito:', $response->json());
            echo "✅ Pago creado con ID: $paymentId";
        } else {
            dd('❌ Error al crear el pago:', $response->status(), $response->json());
        }

        $payload = [
            'inputs' => [
                [
                    'from' => ['id' => $invoiceId],
                    'to' => ['id' => $paymentId],
                    'type' => 'invoice_to_commerce_payment'
                ]
            ]
        ];

        $response = Http::withToken($token)
            ->post('https://api.hubapi.com/crm/v3/associations/invoices/commerce_payments/batch/create', $payload);

        if ($response->successful()) {
            echo "✅ Pago asociado correctamente a la factura.";
        } else {
            dd('❌ Error al asociar pago:', $response->status(), $response->json());
        }

        // $auxcont = 1;
        // foreach($array2 as $id)
        // {
        //     $auxcont++;
        // }

        // $response = Http::withToken($token)
        // ->get('https://api.hubapi.com/crm/v3/objects/line_items', [
        //     'limit' => 10,
        //     'properties' => 'name,price,quantity,hs_product_id'
        // ]);

        // if ($response->successful()) {
        //     $items = $response->json()['results'];
        //     foreach ($items as $item) {
        //         echo "🧾 ID: {$item['id']} — {$item['properties']['name']} — Precio: {$item['properties']['price']}\n";
        //     }
        // } else {
        //     dd('Error al obtener line items', $response->status(), $response->json());
        // }

        // $response = Http::withToken($token)
        // ->get('https://api.hubapi.com/crm/v3/objects/payments', [
        //     'limit' => 5,
        //     'properties' => 'hs_payment_amount,hs_payment_status'
        // ]);

        // if ($response->successful()) {
        //     $pagos = $response->json()['results'];
        //     foreach ($pagos as $pago) {
        //         echo "💳 Pago ID: {$pago['id']} — Monto: {$pago['properties']['hs_payment_amount']} — Estado: {$pago['properties']['hs_payment_status']}\n";
        //     }
        // } else {
        //     dd('Error al obtener pagos', $response->status(), $response->json());
        // }

        // $client = Factory::createWithAccessToken(env('HUBSPOT_TOKEN'));

        // try {
        //     $apiResponse = $client
        //         ->crm()
        //         ->associations()
        //         ->schema()
        //         ->typesApi()
        //         ->getAll('invoices', 'commerce_payment');

        //     foreach ($apiResponse->getResults() as $assoc) {
        //         dd($assoc);
        //         echo "ID: " . $assoc->getAssociationTypeId() . ' — ' . $assoc->getName() . "\n";
        //     }

        //     return $apiResponse->getResults();
        // } catch (ApiException $e) {
        //     echo "Error al obtener asociaciones: " . $e->getMessage();
        // }
    }
}
