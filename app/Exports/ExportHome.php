<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DateTime;
use Illuminate\Support\Collection;
use App\User;
use DB;

class ExportHome implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $today;
    protected $type;
    protected $ag;
    protected $prof;

    public function __construct($type)
    {
        $this->type = $type;
        date_default_timezone_set('America/Mexico_City');
        $today = new DateTime();
        $this->today = $today;

        $profile = User::findProfile();
        $user = User::user_id();
        $this->prof = $profile;
        $this->ag = $user;
    }
    public function collection()
    {
        if($this->prof != 12)
            switch($this->type)
            {
                case 1: $polizas = DB::select('call exclHomeEmit(?,?)',[intval($this->today->format('m')),$this->today->format('Y')]); break;
                case 2: $polizas = DB::select('call exclHomeRenov(?,?)',[intval($this->today->format('m')),$this->today->format('Y')]); break;
                case 3: $polizas = DB::select('call exclHomePCob(?)',[$this->today->format('Y-m-d')]); break;
                case 4: $polizas = DB::select('call exclHomeCancl(?,?)',[intval($this->today->format('m')),$this->today->format('Y')]); break;
                case 5: $polizas = DB::select('call exclHomeTram(?,?)',[intval($this->today->format('m')),$this->today->format('Y')]); break;
                case 6: $polizas = DB::select('call exclHomeIniPay(?,?)',[intval($this->today->format('m')),$this->today->format('Y')]); break;
                case 7: $polizas = DB::select('call exclHomeRenPay(?,?)',[intval($this->today->format('m')),$this->today->format('Y')]); break;
            }
        else
            switch($this->type)
            {
                case 1: $polizas = DB::select('call exclHomeEmitAg(?,?,?)',[intval($this->today->format('m')),$this->today->format('Y'),$this->ag]); break;
                case 2: $polizas = DB::select('call exclHomeRenovAg(?,?,?)',[intval($this->today->format('m')),$this->today->format('Y'),$this->ag]); break;
                case 3: $polizas = DB::select('call exclHomePCobAg(?,?)',[$this->today->format('Y-m-d'),$this->ag]); break;
                case 4: $polizas = DB::select('call exclHomeCanclAg(?,?,?)',[intval($this->today->format('m')),$this->today->format('Y'),$this->ag]); break;
                case 5: $polizas = DB::select('call exclHomeTramAg(?,?,?)',[intval($this->today->format('m')),$this->today->format('Y'),$this->ag]); break;
                case 6: $polizas = DB::select('call exclHomeIniPayAg(?,?,?)',[intval($this->today->format('m')),$this->today->format('Y'),$this->ag]); break;
                case 7: $polizas = DB::select('call exclHomeRenPayAg(?,?,?)',[intval($this->today->format('m')),$this->today->format('Y'),$this->ag]); break;
            }
        return new Collection($polizas);
    }
    public function headings(): array
    {
        if($this->type != 5)
            return ["ID","Cliente","RFC","Póliza","Inicio de Vigencia","Fin de Vigencia","Tipo","PNA","Moneda","Aseguradora","Ramo","Plan","Agente","Conducto de Cobro","Forma de Pago","Expedicion","Financiamiento","Otros","IVA","Total","Estatus","Comentario"];
        else
            return ["ID","Agente", "Fecha de ingreso", "Póliza", "Fecha de Respuesta", "Descargado", "Tipo de Servicio", "Folio", "Nombre del Contratante", "Record", "Ramo", "Compañia", "Estatus", "Número de Guía","Comentario"];
    }
}
