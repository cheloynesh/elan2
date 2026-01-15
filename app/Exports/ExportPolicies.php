<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ExportPolicies implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }
    public function collection()
    {
        $movimientos = DB::table('Policy')->select('Policy.id',DB::raw('CONCAT(IFNULL(Client.name, "")," ",IFNULL(Client.firstname, "")," ",IFNULL(Client.lastname, "")) AS clname'),
        'rfc','policy','reference','initial_date','end_date',DB::raw('if(type = 1, "Inicial","Renovación") as potype'),'pna','Currency.name as currname','Insurance.name as iname',
        'Branch.name as bname','Plans.name as plname',DB::raw('CONCAT(IFNULL(users.name, "")," ",IFNULL(users.firstname, "")," ",IFNULL(users.lastname, "")) AS agname'),
        'Charge.name as charname','Payment_form.name as payname','expended_exp','financ_exp','other_exp','iva','total','Status.name as sname',"commentary",DB::raw('if(renovable = 1, "Si","No") as renovable'))
            ->join('Client',"Client.id","=","fk_client")
            ->join('Branch',"Branch.id","=","fk_branch")
            ->leftJoin('Plans',"Plans.id","=","fk_plan")

            ->join('Payment_form',"Payment_form.id","=","fk_payment_form")
            ->join('Currency',"Currency.id","=","fk_currency")
            ->join('Charge',"Charge.id","=","fk_charge")
            ->join('Insurance',"Insurance.id","=","fk_insurance")
            ->join('Status',"Status.id","=","fk_status")
            ->join('users',"users.id","=","fk_agent")
            ->whereNull("Policy.deleted_at");
        // dd($this->filters['agents']);

        if (!empty($this->filters['agents'])) {
            // dd("entre1");
            $movimientos->whereIn('fk_agent', $this->filters['agents']);
        }
        if (!empty($this->filters['types'])) {
            // dd("entre2");
            $movimientos->whereIn('type', $this->filters['types']);
        }
        if (!empty($this->filters['insurances'])) {
            // dd("entre3");
            $movimientos->whereIn('fk_insurance', $this->filters['insurances']);
        }
        if (!empty($this->filters['branches'])) {
            // dd($this->filters['branches']);
            $movimientos->whereIn('fk_branch', $this->filters['branches']);
        }
        if (!empty($this->filters['plans'])) {
            // dd("entre5");
            $movimientos->whereIn('fk_plan', $this->filters['plans']);
        }
        if (!empty($this->filters['status'])) {
            // dd("entre6");
            $movimientos->whereIn('fk_status', $this->filters['status']);
        }
        if (!empty($this->filters['vigencia_inicio_desde'])) {
            // dd("entre7");
            $movimientos->where('initial_date', '>=', $this->filters['vigencia_inicio_desde']);
        }
        if (!empty($this->filters['vigencia_inicio_hasta'])) {
            // dd("entre8");
            $movimientos->where('initial_date', '<=', $this->filters['vigencia_inicio_hasta']);
        }
        if (!empty($this->filters['vigencia_fin_desde'])) {
            // dd("entre9");
            $movimientos->where('end_date', '>=', $this->filters['vigencia_fin_desde']);
        }
        if (!empty($this->filters['vigencia_fin_hasta'])) {
            // dd("entre10");
            $movimientos->where('end_date', '<=', $this->filters['vigencia_fin_hasta']);
        }

        return $movimientos->get();
    }
    public function headings(): array
    {
        return ["ID","Cliente","RFC","Póliza","Referencia","Inicio de Vigencia","Fin de Vigencia","Tipo","PNA","Moneda","Aseguradora","Ramo","Plan","Agente","Conducto de Cobro","Forma de Pago","Expedicion","Financiamiento","Otros","IVA","Total","Estatus","Comentario","Renovable"];
    }
}
