<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use SoftDeletes;

    protected $table = "Initials";
    protected $fillable =[
        'fk_client','policy','initial_date','end_date','expended_exp','exp_impute','financ_exp','financ_impute','other_exp','other_impute',
        'renovable','pay_frec','iva','total'];
    protected $dates = ["deleted_at"];
}
