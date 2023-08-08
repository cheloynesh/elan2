<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportInitial implements FromCollection, WithHeadings
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
        $movimientos = DB::table('Initials')->select('Initials.id',DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(users.firstname, "")," ",IFNULL(users.lastname, "")) AS agname'),
        DB::raw('CONCAT(IFNULL(Initials.name, "")," ",IFNULL(Initials.firstname, "")," ",IFNULL(Initials.lastname, "")) AS initname'),'rfc','insured','promoter_date',
        'system_date','folio','Insurance.name as iname','Branch.name as bname','Plans.name as plname','Applications.name as apname','Status.name as sname','pna','Payment_form.name as payname',
        'Currency.name as currname','Charge.name as charname','Initials.initial_comm')
            ->join('Branch',"Branch.id","=","fk_branch")
            ->join('Plans',"Plans.id","=","fk_plan")
            ->join('Applications',"Applications.id","=","fk_application")
            ->join('Payment_form',"Payment_form.id","=","fk_payment_form")
            ->join('Currency',"Currency.id","=","fk_currency")
            ->join('Charge',"Charge.id","=","fk_charge")
            ->join('Insurance',"Insurance.id","=","fk_insurance")
            ->join('Status',"Status.id","=","fk_status")
            ->join('users',"users.id","=","fk_agent");
        if($this->status == 0)
        {
            if($this->branch == 0)
            {

                $movimientos = $movimientos->whereNull("Initials.deleted_at")->get();
                // dd($movimientos);
            }
            else
            {
                $movimientos = $movimientos->whereNull("Initials.deleted_at")
                    ->where('fk_branch',$this->branch)->get();
            }
        }
        else
        {
            if($this->branch == 0)
            {
                $movimientos = $movimientos->whereNull("Initials.deleted_at")
                    ->where('fk_status',$this->status)->get();
            }
            else
            {
                $movimientos = $movimientos->whereNull("Initials.deleted_at")
                    ->where('fk_branch',$this->branch)->where('fk_status',$this->status)->get();
            }
        }

                // dd($movimientos);
        return $movimientos;
    }
    public function headings(): array
    {
        return ["ID","Agente", "Cliente", "RFC", "Asegurado", "Fecha de Promotoría", "Fecha de Sistema", "Folio", "Compañía", "Ramo", "Plans", "Tipo de Aplicación", "Estatus", "PNA", "Forma de Pago", "Moneda", "Conducto de Cobro", "Comentario"];
    }
}
