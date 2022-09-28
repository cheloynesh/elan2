<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Policy extends Model
{
    use SoftDeletes;

    protected $table = "Policy";
    protected $fillable =[
        'fk_client','policy','initial_date','end_date','expended_exp','exp_impute','financ_exp','financ_impute','other_exp','other_impute',
        'renovable','iva','total'];
    protected $dates = ["deleted_at"];
}
