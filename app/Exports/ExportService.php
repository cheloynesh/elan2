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
        $movimientos = DB::table('Services')->select('Services.id',DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(firstname, "")," ",IFNULL(lastname, "")) AS agname'),'entry_date',
        'policy','response_date',DB::raw('IF(download = 0, "no","si")'),'type','folio','Services.name','record','Branch.name as bname','Insurance.name as iname','Status.name as sname',
        'guide','service_comm')
            ->join('Branch',"Branch.id","=","fk_branch")
            ->join('Insurance',"Insurance.id","=","fk_insurance")
            ->join('Status',"Status.id","=","fk_status")
            ->join('users',"users.id","=","fk_agent");
        // dd($this->id);
        if($this->status == 0)
        {
            if($this->branch == 0)
            {
                $movimientos = $movimientos->whereNull("Services.deleted_at")->get();
                // dd($movimientos);
            }
            else
            {
                $movimientos = $movimientos->where('fk_branch',$this->branch)
                    ->whereNull("Services.deleted_at")->get();
            }
        }
        else
        {
            if($this->branch == 0)
            {
                $movimientos = $movimientos->where('fk_status',$this->status)
                    ->whereNull("Services.deleted_at")->get();
            }
            else
            {
                $movimientos = $movimientos->where('fk_branch',$this->branch)->where('fk_status',$this->status)
                    ->whereNull("Services.deleted_at")->get();
            }
        }

        return $movimientos;
    }
    public function headings(): array
    {
        return ["ID","Agente", "Fecha de ingreso", "Póliza", "Fecha de Respuesta", "Descargado", "Tipo de Servicio", "Folio", "Nombre del Contratante", "Record", "Ramo", "Compañia", "Estatus", "Número de Guía","Comentario"];
    }
}
