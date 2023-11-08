<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidates extends Model
{
    //
    use SoftDeletes;

    protected $table = "Candidates";
    protected $fillable =["name","fistname","lastname","mail","city","social","age","sholarity","sales_exp","cv","application_date","origin",
    "first_status","second_status","date_sec_int","charge","confirmed","documents","induction","sales_dates","sales","signed_cia","cia","initial_key",
    "initial_date","license_date","exam_date","exam","cnsf_date","license","metlife_sign","met_graduate"];
    protected $dates = ["deleted_at"];
}
