<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportService implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $status;
    protected $branch;

    public function __construct($status, $branch)
    {
        $this->status = $status;
        $this->branch = $branch;
    }
    public function collection()
    {
        // dd($this->id);
        if($this->status == 0)
        {
            if($this->branch == 0)
            {
                $movimientos = DB::table('Services')->select(DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(firstname, "")," ",IFNULL(lastname, "")) AS agname'),'entry_date','policy','response_date',DB::raw('IF(download = 0, "no","si")'),'type','folio','Services.name','record','Branch.name as bname','Insurance.name as iname','Status.name as sname','guide')
                ->join('Branch',"Branch.id","=","fk_branch")
                ->join('Insurance',"Insurance.id","=","fk_insurance")
                ->join('Status',"Status.id","=","fk_status")
                ->join('users',"users.id","=","fk_agent")->get();
                // dd($movimientos);
            }
            else
            {
                $movimientos = DB::table('Services')->select(DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(firstname, "")," ",IFNULL(lastname, "")) AS agname'),'entry_date','policy','response_date',DB::raw('IF(download = 0, "no","si")'),'type','folio','Services.name','record','Branch.name as bname','Insurance.name as iname','Status.name as sname','guide')
                ->join('Branch',"Branch.id","=","fk_branch")
                ->join('Insurance',"Insurance.id","=","fk_insurance")
                ->join('Status',"Status.id","=","fk_status")
                ->join('users',"users.id","=","fk_agent")
                ->where('fk_branch',$this->branch)->get();
            }
        }
        else
        {
            if($this->branch == 0)
            {
                $movimientos = DB::table('Services')->select(DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(firstname, "")," ",IFNULL(lastname, "")) AS agname'),'entry_date','policy','response_date',DB::raw('IF(download = 0, "no","si")'),'type','folio','Services.name','record','Branch.name as bname','Insurance.name as iname','Status.name as sname','guide')
                ->join('Branch',"Branch.id","=","fk_branch")
                ->join('Insurance',"Insurance.id","=","fk_insurance")
                ->join('Status',"Status.id","=","fk_status")
                ->join('users',"users.id","=","fk_agent")
                ->where('fk_status',$this->status)->get();
            }
            else
            {
                $movimientos = DB::table('Services')->select(DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(firstname, "")," ",IFNULL(lastname, "")) AS agname'),'entry_date','policy','response_date',DB::raw('IF(download = 0, "no","si")'),'type','folio','Services.name','record','Branch.name as bname','Insurance.name as iname','Status.name as sname','guide')
                ->join('Branch',"Branch.id","=","fk_branch")
                ->join('Insurance',"Insurance.id","=","fk_insurance")
                ->join('Status',"Status.id","=","fk_status")
                ->join('users',"users.id","=","fk_agent")
                ->where('fk_branch',$this->branch)->where('fk_status',$this->status)->get();
            }
        }

        return $movimientos;
    }
    public function headings(): array
    {
        return ["Agente", "Fecha de ingreso", "Póliza", "Fecha de Respuesta", "Descargado", "Tipo de Servicio", "Folio", "Nombre del Contratante", "Record", "Ramo", "Compañia", "Estatus", "Número de Guía"];
    }
}
