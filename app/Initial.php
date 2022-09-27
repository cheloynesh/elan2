<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Initial extends Model
{
    use SoftDeletes;

    protected $table = "Initials";
    protected $fillable =[
        'fk_agent','name','firstname','lastname','rfc','insured','type','promoter_date','system_date','folio','fk_insurance',
        'fk_branch','fk_plan','fk_application','pna','fk_payment_form','fk_currency','fk_charge'];
    protected $dates = ["deleted_at"];
}
