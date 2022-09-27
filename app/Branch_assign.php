<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch_assign extends Model
{
    use SoftDeletes;

    protected $table = "Branch_assign";
    protected $fillable =["fk_insurance","fk_branch"];
    protected $dates = ["deleted_at"];
}
