<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportPolicy implements FromCollection, WithHeadings
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
                $movimientos = DB::table('Policy')->select(DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(Client.firstname, "")," ",IFNULL(Client.lastname, "")) AS clname'),
                // 'policy','initial_date','end_date','pna','Currency.name as currname','Insurance.name as iname','Branch.name as bname',
                'policy','initial_date','end_date','pna','Currency.name as currname','Insurance.name as iname','Branch.name as bname','Plans.name as plname',
                DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(users.firstname, "")," ",IFNULL(users.lastname, "")) AS agname'),'Charge.name as charname',
                'Payment_form.name as payname','expended_exp','financ_exp','other_exp','iva','total','Status.name as sname')
                    ->join('Client',"Client.id","=","fk_client")
                    ->join('Branch',"Branch.id","=","fk_branch")
                    ->join('Plans',"Plans.id","=","fk_plan")
                    ->join('Payment_form',"Payment_form.id","=","fk_payment_form")
                    ->join('Currency',"Currency.id","=","fk_currency")
                    ->join('Charge',"Charge.id","=","fk_charge")
                    ->join('Insurance',"Insurance.id","=","fk_insurance")
                    ->join('Status',"Status.id","=","fk_status")
                    ->join('users',"users.id","=","fk_agent")
                    ->whereNull("Policy.deleted_at")->get();
                // dd($movimientos);
            }
            else
            {
                $movimientos = DB::table('Policy')->select(DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(Client.firstname, "")," ",IFNULL(Client.lastname, "")) AS clname'),
                'policy','initial_date','end_date','pna','Currency.name as currname','Insurance.name as iname','Branch.name as bname','Plans.name as plname',
                DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(users.firstname, "")," ",IFNULL(users.lastname, "")) AS agname'),'Charge.name as charname',
                'Payment_form.name as payname','expended_exp','financ_exp','other_exp','iva','total','Status.name as sname')
                    ->join('Client',"Client.id","=","fk_client")
                    ->join('Branch',"Branch.id","=","fk_branch")
                    ->join('Plans',"Plans.id","=","fk_plan")
                    ->join('Payment_form',"Payment_form.id","=","fk_payment_form")
                    ->join('Currency',"Currency.id","=","fk_currency")
                    ->join('Charge',"Charge.id","=","fk_charge")
                    ->join('Insurance',"Insurance.id","=","fk_insurance")
                    ->join('Status',"Status.id","=","fk_status")
                    ->join('users',"users.id","=","fk_agent")
                    ->whereNull("Policy.deleted_at")
                    ->where('fk_branch',$this->branch)->get();
            }
        }
        else
        {
            if($this->branch == 0)
            {
                $movimientos = DB::table('Policy')->select(DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(Client.firstname, "")," ",IFNULL(Client.lastname, "")) AS clname'),
                'policy','initial_date','end_date','pna','Currency.name as currname','Insurance.name as iname','Branch.name as bname','Plans.name as plname',
                DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(users.firstname, "")," ",IFNULL(users.lastname, "")) AS agname'),'Charge.name as charname',
                'Payment_form.name as payname','expended_exp','financ_exp','other_exp','iva','total','Status.name as sname')
                    ->join('Client',"Client.id","=","fk_client")
                    ->join('Branch',"Branch.id","=","fk_branch")
                    ->join('Plans',"Plans.id","=","fk_plan")
                    ->join('Payment_form',"Payment_form.id","=","fk_payment_form")
                    ->join('Currency',"Currency.id","=","fk_currency")
                    ->join('Charge',"Charge.id","=","fk_charge")
                    ->join('Insurance',"Insurance.id","=","fk_insurance")
                    ->join('Status',"Status.id","=","fk_status")
                    ->join('users',"users.id","=","fk_agent")
                    ->whereNull("Policy.deleted_at")
                    ->where('fk_status',$this->status)->get();
            }
            else
            {
                $movimientos = DB::table('Policy')->select(DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(Client.firstname, "")," ",IFNULL(Client.lastname, "")) AS clname'),
                'policy','initial_date','end_date','pna','Currency.name as currname','Insurance.name as iname','Branch.name as bname','Plans.name as plname',
                DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(users.firstname, "")," ",IFNULL(users.lastname, "")) AS agname'),'Charge.name as charname',
                'Payment_form.name as payname','expended_exp','financ_exp','other_exp','iva','total','Status.name as sname')
                    ->join('Client',"Client.id","=","fk_client")
                    ->join('Branch',"Branch.id","=","fk_branch")
                    ->join('Plans',"Plans.id","=","fk_plan")
                    ->join('Payment_form',"Payment_form.id","=","fk_payment_form")
                    ->join('Currency',"Currency.id","=","fk_currency")
                    ->join('Charge',"Charge.id","=","fk_charge")
                    ->join('Insurance',"Insurance.id","=","fk_insurance")
                    ->join('Status',"Status.id","=","fk_status")
                    ->join('users',"users.id","=","fk_agent")
                    ->whereNull("Policy.deleted_at")
                    ->where('fk_branch',$this->branch)->where('fk_status',$this->status)->get();
            }
        }

        return $movimientos;
    }
    public function headings(): array
    {
        return ["Cliente","Póliza","Inicio de Vigencia","Fin de Vigencia","PNA","Moneda","Aseguradora","Ramo","Plan","Agente","Conducto de Cobro","Forma de Pago","Expedicion","Financiamiento","Otros","IVA","Total","Estatus"];
    }
}
