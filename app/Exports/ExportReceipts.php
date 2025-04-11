<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DateTime;
use Illuminate\Support\Collection;
use App\User;
use DB;

class ExportReceipts implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct()
    {
    }
    public function collection()
    {
        $polizas = DB::select('call exportReceipts()');

        return new Collection($polizas);
    }
    public function headings(): array
    {
        return ["ID","Cliente","RFC","Póliza","Inicio de Vigencia","Fin de Vigencia","Tipo","PNA","Moneda","Aseguradora","Ramo","Plan","Agente","Conducto de Cobro","Forma de Pago","PN Recibo","Expedicion","Financiamiento","Otros","IVA","Total","Inicio Recibo","Fin Recibo","Pago Recibo","Estatus","Comentario"];
    }
}
