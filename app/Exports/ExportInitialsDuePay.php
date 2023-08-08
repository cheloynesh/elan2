<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DateTime;
use Illuminate\Support\Collection;
use DB;

class ExportInitialsDuePay implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $mnth;
    protected $quart;
    protected $brnch;
    protected $insrnc;
    protected $year;

    public function __construct($mnth,$quart,$brnch,$insrnc)
    {
        $this->mnth = $mnth;
        if($quart == 'a') $this->quart = '%'; else $this->quart = $quart;
        if($brnch == 'a') $this->brnch = '%'; else $this->brnch = $brnch;
        if($insrnc == 'a') $this->insrnc = '%'; else $this->insrnc = $insrnc;
        date_default_timezone_set('America/Mexico_City');
        $date = new DateTime();
        $this->year = $date->format('Y');
    }
    public function collection()
    {
        $movimientos = DB::select('call exclDuePay(?,?,?,?,?)',[$this->brnch,$this->insrnc,$this->mnth,$this->quart,$this->year]);
        return new Collection($movimientos);
    }
    public function headings(): array
    {
        return ["ID","Agente", "Cliente", "RFC", "Asegurado", "Fecha de Promotoría", "Fecha de Sistema", "Folio", "Compañía", "Ramo", "Plans", "Tipo de Aplicación", "Estatus", "PNA", "Forma de Pago", "Moneda", "Conducto de Cobro"];
    }
}
