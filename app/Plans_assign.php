<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Plans_assign extends Model
{
    use SoftDeletes;

    protected $table = "Plans_assign";
    protected $fillable =["fk_brnchass","fk_plans"];
    protected $dates = ["deleted_at"];
}
