<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Policy;
use App\Permission;
use App\User;
use App\Receipts;
use App\Currency;
use App\Insurance;
use App\Paymentform;
use App\Charge;
use App\Branch;
use App\Status;
use App\Client;
use App\Branch_assign;
use App\Status_History;
use App\Plan;
use DateTime;
use DB;
use HubSpot\Factory;
use HubSpot\Client\Crm\Invoices\Model\PublicAssociation;
use HubSpot\Client\Crm\Contacts\ApiException;
use HubSpot\Client\Crm\Invoices\Model\AssociationSpec;
use HubSpot\Client\Crm\Invoices\Model\PublicAssociationsForObject;
use HubSpot\Client\Crm\Invoices\Model\PublicObjectId;
use HubSpot\Client\Crm\Invoices\Model\SimplePublicObjectInputForCreate;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $maritalMap = [
            'Soltero (a)' => 1,
            'Casado (a)' => 2,
            'Divorciado (a)' => 3,
            'Viudo (a)' => 4,
            'Unión libre' => 5,
        ];
        Log::info('Datos recibidos del webhook:', $request->all());
        $receiptflag = 0;

        $token = Factory::createWithAccessToken(env('HUBSPOT_TOKEN'));

        $datas = $request->all();
        foreach ($datas as $data)
        {
            if($data["subscriptionType"] == "deal.propertyChange")
            {
                $deal = $token->crm()->deals()->basicApi()->getById($data["objectId"],['poliza','iva__','inversion_o_seguro']);

                Log::info('Datos del request:', $deal->getProperties());

                $policy = Policy::where('policy',$deal->getProperties()['poliza'])->first();

                if($policy != null && $deal->getProperties()['inversion_o_seguro'] == "SEGUROS")
                {
                    switch($data["propertyName"])
                    {
                        case "poliza": $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['policy' => $data["propertyValue"]]); break;
                        case "referencia": $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['reference' => $data["propertyValue"]]); break;
                        case "pna_monto": $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['pna' => $data["propertyValue"]]); $receiptflag = 1; break;
                        case "gastos_de_expedicion": $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['expended_exp' => $data["propertyValue"]]); $receiptflag = 1; break;
                        case "gastos_expedicion___imputar": $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['exp_impute' => $data["propertyValue"] == "Primero" ? 1 : 2]); $receiptflag = 1; break;
                        case "gastos_financieros": $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['financ_exp' => $data["propertyValue"]]); $receiptflag = 1; break;
                        case "imputar": $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['financ_impute' => $data["propertyValue"] == "Primero" ? 1 : 2]); $receiptflag = 1; break;
                        case "otros_gastos": $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['other_exp' => $data["propertyValue"]]); $receiptflag = 1; break;
                        case "otros_gastos___imputar": $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['other_impute' => $data["propertyValue"] == "Primero" ? 1 : 2]); $receiptflag = 1; break;
                        case "iva__": $receiptflag = 1; break;
                        case "deal_currency_code":
                            $val = Currency::where('name',$data["propertyValue"])->first();
                            $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['fk_currency' => $val->id]);
                            break;
                        case "renovable": $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['renovable' => $data["propertyValue"] == "true" ? 1 : 2]); $receiptflag = 1; break;
                        case "conducto_de_cobro":
                            $val = Charge::where('name',$data["propertyValue"])->first();
                            $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['fk_charge' => $val->id]);
                            break;
                        case "aseguradora":
                            $val = Insurance::where('name',$data["propertyValue"])->first();
                            $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['fk_insurance' => $val->id]);
                            break;
                        case "ramo":
                            $val = Branch::where('name',$data["propertyValue"])->first();
                            $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['fk_branch' => $val->id]);
                            break;
                        case "plan":
                            $val = Plan::where('name',$data["propertyValue"])->first();
                            $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['fk_plan' => $val->id]);
                            break;
                        case "forma_de_pago":
                            $val = Paymentform::where('name',$data["propertyValue"])->first();
                            $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['fk_payment_form' => $val->id]);
                            $receiptflag = 1;
                            break;
                        case "hubspot_owner_id":
                            $owner = $token->crm()->owners()->ownersApi()->getById($data["propertyValue"]);
                            $email = $owner->getEmail();
                            $val = User::where('email',$email)->first();
                            $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['fk_agent' => $val->id]);
                            break;
                        case "inicio_de_vigencia":
                            $timestampMs = $data["propertyValue"];
                            $timestampSec = intval($timestampMs) / 1000;

                            $fecha = \Carbon\Carbon::createFromTimestamp($timestampSec);
                            $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['initial_date' => $fecha->toDateString()]);
                            $receiptflag = 1;
                            break;
                        case "fin_de_vigencia":
                            $timestampMs = $data["propertyValue"];
                            $timestampSec = intval($timestampMs) / 1000;

                            $fecha = \Carbon\Carbon::createFromTimestamp($timestampSec);
                            $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['end_date' => $fecha->toDateString()]);
                            $receiptflag = 1;
                            break;
                        case "dealstage":
                            $cancelada = [
                                '256428973',
                                '1212773209',
                                '261767681',
                                '268048653',
                                '952035181',
                                '973117547',
                            ];

                            $otros = [
                                '1217253252',
                                '1214529107',
                            ];

                            $terminada = [
                                '1212759697',
                            ];

                            if(in_array($data['propertyValue'], $cancelada, true)) $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['fk_status' => 16]);
                            else if(in_array($data['propertyValue'], $otros, true)) $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['fk_status' => 47]);
                            else if(in_array($data['propertyValue'], $terminada, true)) $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['fk_status' => 24]);
                            break;
                    }

                    if($receiptflag == 1)
                    {
                        $policy = Policy::where('policy',$deal->getProperties()['poliza'])->first();
                        $temp = $policy->other_exp + $policy->financ_exp + $policy->pna + $policy->expended_exp;
                        $ivaGral = $temp * $deal->getProperties()['iva__'];
                        $temp += $ivaGral;
                        $policy->update(['iva' => $ivaGral, 'total' => $temp, 'rcp_update' => 1]);
                    }
                }
                else if($deal->getProperties()['poliza'] != null && $deal->getProperties()['inversion_o_seguro'] == "SEGUROS")
                {
                    Log::info('No se encontro la póliza:');
                    $deal = $token->crm()->deals()->basicApi()->getById($data["objectId"],['poliza','iva__','referencia','pna_monto','gastos_de_expedicion',
                        'gastos_expedicion___imputar','gastos_financieros','imputar','otros_gastos','otros_gastos___imputar','deal_currency_code','renovable',
                        'conducto_de_cobro','aseguradora','ramo','plan','forma_de_pago','hubspot_owner_id','inicio_de_vigencia','fin_de_vigencia']);
                    Log::info('Datos de la poliza:', $deal->getProperties());

                    $curr = Currency::where('name',$deal->getProperties()['deal_currency_code'])->first();
                    $charge = Charge::where('name',$deal->getProperties()['conducto_de_cobro'])->first();
                    $insurance = Insurance::where('name',$deal->getProperties()['aseguradora'])->first();
                    $branch = Branch::where('name',$deal->getProperties()['ramo'])->first();
                    $plan = Plan::where('name',$deal->getProperties()['plan'])->first();
                    $pay = Paymentform::where('name',$deal->getProperties()['forma_de_pago'])->first();
                    $owner = $token->crm()->owners()->ownersApi()->getById($deal->getProperties()['hubspot_owner_id']);
                    $email = $owner->getEmail();
                    $agent = User::where('email',$email)->first();

                    $hclient = $this->searchClient($data["objectId"]);
                    $fk_client = 0;

                    if($hclient != 0)
                    {
                        $client = Client::where("rfc",$hclient['rfc'])->first();
                        if($client == null)
                        {
                            $client = DB::select('call getClient(?,?)',[$hclient['name'],$hclient['lastname']]);
                            if($client != null)
                            {
                                Log::info('Cliente NOMBRE:', [$client[0]->id]);
                                $fk_client = $client[0]->id;
                            }
                            else
                            {
                                $client = new Client;
                                $client->name = $hclient['name'];
                                $client->firstname = $hclient['lastname'];
                                $client->birth_date = $hclient['birth_date'];
                                $client->rfc = $hclient['rfc'];
                                $client->curp = $hclient['curp'];
                                $client->gender = $hclient['gender'] == "Femenino" ? 2 : 1;
                                $client->marital_status = $maritalMap[$hclient['marital_status']] ?? null;
                                $client->street = $hclient['street'];
                                $client->e_num = $hclient['e_num'];
                                $client->i_num = $hclient['i_num'];
                                $client->pc = $hclient['pc'];
                                $client->suburb = $hclient['suburb'];
                                $client->country = $hclient['country'];
                                $client->state = $hclient['state'];
                                $client->city = $hclient['city'];
                                $client->cellphone = $hclient['cellphone'];
                                $client->email = $hclient['email'];
                                $client->status = $hclient['status'] == "Física" ? 0 : 1;
                                $client->save();
                                $fk_client = $client->id;
                                Log::info('Cliente creado:', [$client]);
                            }
                        }
                        else
                        {
                            Log::info('Cliente RFC:', [$client->id]);
                            $fk_client = $client->id;
                        }
                    }
                    else
                    {
                        $fk_client = 1;
                    }

                    $policy = new Policy;
                    $policy->fk_client = $fk_client;
                    $policy->policy = $deal->getProperties()['poliza'];
                    $policy->expended_exp = $deal->getProperties()['gastos_de_expedicion'];
                    $policy->exp_impute = $deal->getProperties()['gastos_expedicion___imputar'] == "Primero" ? 1 : 2;
                    $policy->financ_exp = $deal->getProperties()['gastos_financieros'];
                    $policy->financ_impute = $deal->getProperties()['imputar'] == "Primero" ? 1 : 2;
                    $policy->other_exp = $deal->getProperties()['otros_gastos'];
                    $policy->other_impute = $deal->getProperties()['otros_gastos___imputar'] == "Primero" ? 1 : 2;
                    $policy->iva = 0;
                    $policy->total = 0;
                    $policy->renovable = $deal->getProperties()['renovable'] == "true" ? 1 : 2;

                    $policy->reference = $deal->getProperties()['referencia'];
                    $policy->pna = $deal->getProperties()['pna_monto'];
                    $policy->fk_currency = $curr->id;
                    $policy->fk_insurance = $insurance->id;
                    $policy->fk_branch = $branch->id;
                    $policy->fk_plan = $plan->id;
                    $policy->fk_agent = $agent->id;
                    $policy->fk_charge = $charge->id;
                    $policy->fk_payment_form = $pay->id;
                    $policy->initial_date = $deal->getProperties()['inicio_de_vigencia'];
                    $policy->end_date = $deal->getProperties()['fin_de_vigencia'];
                    $policy->save();

                    Log::info('Póliza creada------------------------------------------------');
                    $this->updateReceipts($deal->getProperties()['poliza'],$deal->getProperties()['iva__']);
                }
            }
            else
            {
                $hclient = $this->searchClient($data["fromObjectId"]);
                Log::info('Contratante:', [$hclient]);
                $deal = $token->crm()->deals()->basicApi()->getById($data["fromObjectId"],['poliza','iva__']);
                Log::info('Datos del negocio:', $deal->getProperties());
                $fk_client = 0;

                if($hclient != 0 && $data["associationRemoved"] != true)
                {
                    $client = Client::where("rfc",$hclient['rfc'])->first();
                    if($client == null)
                    {
                        $client = DB::select('call getClient(?,?)',[$hclient['name'],$hclient['lastname']]);
                        if($client != null)
                        {
                            Log::info('Cliente NOMBRE:', [$client[0]->id]);
                            $fk_client = $client[0]->id;
                        }
                        else
                        {
                            $client = new Client;
                            $client->name = $hclient['name'];
                            $client->firstname = $hclient['lastname'];
                            $client->birth_date = $hclient['birth_date'];
                            $client->rfc = $hclient['rfc'];
                            $client->curp = $hclient['curp'];
                            $client->gender = $hclient['gender'] == "Femenino" ? 1 : 2;
                            $client->marital_status = $maritalMap[$hclient['marital_status']] ?? null;
                            $client->street = $hclient['street'];
                            $client->e_num = $hclient['e_num'];
                            $client->i_num = $hclient['i_num'];
                            $client->pc = $hclient['pc'];
                            $client->suburb = $hclient['suburb'];
                            $client->country = $hclient['country'];
                            $client->state = $hclient['state'];
                            $client->city = $hclient['city'];
                            $client->cellphone = $hclient['cellphone'];
                            $client->email = $hclient['email'];
                            $client->status = $hclient['status'] == "Física" ? 0 : 1;
                            $client->save();
                            $fk_client = $client->id;
                            Log::info('Cliente creado:', [$client]);
                        }
                    }
                    else
                    {
                        Log::info('Cliente RFC:', [$client->id]);
                        $fk_client = $client->id;
                    }
                }
                else
                {
                    $fk_client = 1;
                }
                $initial = Policy::where('policy',$deal->getProperties()['poliza'])->update(['fk_client' => $fk_client]);
            }

        }
        Log::info('Webhook procesado correctamente ------------------------------------------------------');
        return response()->json(['message' => 'Webhook procesado'], 200);
    }

    function updateReceipts($policy,$ivapor)
    {
        $policy = Policy::where('policy',$policy)->first();
        $temp = $policy->other_exp + $policy->financ_exp + $policy->pna + $policy->expended_exp;
        $ivaGral = $temp * $ivapor;
        $temp += $ivaGral;
        $policy->update(['iva' => $ivaGral, 'total' => $temp]);

        $receipts_edit = Receipts::where("fk_policy",$policy->id)->get();
        $branch = Branch::where('id',$policy->fk_branch)->first();
        $pay_frec = $policy->fk_payment_form;

        foreach($receipts_edit as $receipts)
        {
            $receipts->delete();
        }

        $pna = floatVal($policy->pna)/$pay_frec;
        $days = $branch->days;
        $day = new DateTime($policy->initial_date);
        for($x = 0 ; $x<$pay_frec ; $x++)
        {
            $values_total = 0;
            if($policy->exp_impute == 1 && $x == 0){
                $values_exp = $policy->expended_exp;
                $values_total +=  $policy->expended_exp;
            }
            else if($policy->exp_impute == 2){
                $values_exp = $policy->expended_exp/$pay_frec;
                $values_total +=  $policy->expended_exp/$pay_frec;
            }
            else{
                $values_exp = 0;
            }

            if($policy->financ_impute == 1 && $x == 0){
                $values_financ = $policy->financ_exp;
                $values_total +=  $policy->financ_exp;
            }
            else if($policy->financ_impute == 2){
                $values_financ = $policy->financ_exp/$pay_frec;
                $values_total += $policy->financ_exp/$pay_frec;
            }
            else{
                $values_financ = 0;
            }

            if($policy->other_impute == 1 && $x == 0){
                $values_other = $policy->other_exp;
                $values_total += $policy->other_exp;
            }
            else if($policy->other_impute == 2){
                $values_other = $policy->other_exp/$pay_frec;
                $values_total += $policy->other_exp/$pay_frec;
            }
            else{
                $values_other = 0;
            }

            $fechaBD = clone $day;
            $fechaFin = clone $day;
            $fechaFin->modify('+'.$days.' days');

            $day->modify('+'.(12/$pay_frec).' month');

            $values_total += $pna;
            $iva = $values_total * $ivapor;
            $values_total += $iva;

            $receipts = new Receipts;
            $receipts->fk_policy = $policy->id;
            $receipts->pna = $pna;
            $receipts->expedition = $values_exp;
            $receipts->financ_exp = $values_financ;
            $receipts->other_exp = $values_other;
            $receipts->iva = $iva;
            $receipts->pna_t = $values_total;
            $receipts->initial_date = $fechaBD;
            $receipts->end_date = $fechaFin;
            $receipts->save();
        }
        Log::info('Recibos actualizados------------------------------------------------');
    }

    function searchClient($dealId)
    {
        $token = Factory::createWithAccessToken(env('HUBSPOT_TOKEN'));

        $response = Http::withToken(env('HUBSPOT_TOKEN'))
            ->get("https://api.hubapi.com/crm/v4/objects/deals/{$dealId}/associations/contacts");

        if (!$response->successful()) {
            Log::error('Error al obtener asociaciones:', $response->json());
            return;
        }

        $asociaciones = $response->json()['results'] ?? [];

        foreach ($asociaciones as $asoc) {
            $contactId = $asoc['toObjectId'];
            $labels = collect($asoc['associationTypes'])->pluck('label')->implode(', ');

            $contact = $token
                ->crm()
                ->contacts()
                ->basicApi()
                ->getById($contactId, ['firstname', 'lastname', 'email','fecha_de_nacimiento','rfc__propiedad_unica_','curp','sexo','estado_civil',
                    'calle_o_avenida', 'numero_exterior', 'numero_interior','zip','colonia','municipio_alcaldia','estados_del_pais','country','phone','tipo_de_persona']);

            $props = $contact->getProperties();

            if (Str::contains(Str::lower($labels), 'contratante')) {
                return [
                    'id' => $contactId,
                    'name' => $props['firstname'],
                    'lastname' => $props['lastname'] ?? null,
                    'email' => $props['email'] ?? null,
                    'birth_date' => $props['fecha_de_nacimiento'] ?? null,
                    'rfc' => $props['rfc__propiedad_unica_'] ?? null,
                    'curp' => $props['curp'] ?? null,
                    'gender' => $props['sexo'] ?? null,
                    'marital_status' => $props['estado_civil'] ?? null,
                    'street' => $props['calle_o_avenida'] ?? null,
                    'e_num' => $props['numero_exterior'] ?? null,
                    'i_num' => $props['numero_interior'] ?? null,
                    'pc' => $props['zip'] ?? null,
                    'suburb' => $props['colonia'] ?? null,
                    'city' => $props['municipio_alcaldia'] ?? null,
                    'state' => $props['estados_del_pais'] ?? null,
                    'country' => $props['country'] ?? null,
                    'cellphone' => $props['phone'] ?? null,
                    'status' => $props['tipo_de_persona'] ?? null,
                ];
            }
        }
        return 0;
    }
}
