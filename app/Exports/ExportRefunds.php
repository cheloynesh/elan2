<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportRefunds implements FromCollection, WithHeadings
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
                $movimientos = DB::table('Refunds')->select(DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(users.firstname, "")," ",IFNULL(users.lastname, "")) AS agname'),
                'folio','contractor','Insurance.name as iname','Branch.name as bname','entry_date','policy','Status.name as sname','insured','sinister',
                'amount','payment_form','guide')
                    ->join('Branch',"Branch.id","=","fk_branch")
                    ->join('Insurance',"Insurance.id","=","fk_insurance")
                    ->join('Status',"Status.id","=","fk_status")
                    ->join('users',"users.id","=","fk_agent")
                    ->whereNull("Refunds.deleted_at")->get();
                // dd($movimientos);
            }
            else
            {
                $movimientos = DB::table('Refunds')->select(DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(users.firstname, "")," ",IFNULL(users.lastname, "")) AS agname'),
                'folio','contractor','Insurance.name as iname','Branch.name as bname','entry_date','policy','Status.name as sname','insured','sinister',
                'amount','payment_form','guide')
                    ->join('Branch',"Branch.id","=","fk_branch")
                    ->join('Insurance',"Insurance.id","=","fk_insurance")
                    ->join('Status',"Status.id","=","fk_status")
                    ->join('users',"users.id","=","fk_agent")
                    ->whereNull("Refunds.deleted_at")
                    ->where('fk_branch',$this->branch)->get();
            }
        }
        else
        {
            if($this->branch == 0)
            {
                $movimientos = DB::table('Refunds')->select(DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(users.firstname, "")," ",IFNULL(users.lastname, "")) AS agname'),
                'folio','contractor','Insurance.name as iname','Branch.name as bname','entry_date','policy','Status.name as sname','insured','sinister',
                'amount','payment_form','guide')
                    ->join('Branch',"Branch.id","=","fk_branch")
                    ->join('Insurance',"Insurance.id","=","fk_insurance")
                    ->join('Status',"Status.id","=","fk_status")
                    ->join('users',"users.id","=","fk_agent")
                    ->whereNull("Refunds.deleted_at")
                    ->where('fk_status',$this->status)->get();
            }
            else
            {
                $movimientos = DB::table('Refunds')->select(DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(users.firstname, "")," ",IFNULL(users.lastname, "")) AS agname'),
                'folio','contractor','Insurance.name as iname','Branch.name as bname','entry_date','policy','Status.name as sname','insured','sinister',
                'amount','payment_form','guide')
                    ->join('Branch',"Branch.id","=","fk_branch")
                    ->join('Insurance',"Insurance.id","=","fk_insurance")
                    ->join('Status',"Status.id","=","fk_status")
                    ->join('users',"users.id","=","fk_agent")
                    ->whereNull("Refunds.deleted_at")
                    ->where('fk_branch',$this->branch)->where('fk_status',$this->status)->get();
            }
        }

        return $movimientos;
    }
    public function headings(): array
    {
        return ["Agente", "Folio", "Contratante", "Compañía", "Ramo", "Fecha de Ingreso", "Póliza", "Estatus", "Asegurado Afectado", "Número de Siniestro", "Monto a Reembolsar", "Forma de Pago", "Número de Guía"];
    }
}
