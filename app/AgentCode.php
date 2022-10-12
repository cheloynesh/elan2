<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgentCode extends Model
{
    use SoftDeletes;

    protected $table = "Agent";
    protected $dates = ["deleted_at"];
}
