<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status_History extends Model
{
    use SoftDeletes;

    protected $table = "Status_History";
    protected $fillable =['fk_user','fk_status','change_date'];
    protected $dates = ["deleted_at"];
}
