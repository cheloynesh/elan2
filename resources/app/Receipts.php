<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Receipts extends Model
{
    use SoftDeletes;
    
    protected $table = "Receipts";
    protected $fillable = ['fk_policy', 'pna', 'expedition', 'financ_exp', 'other_exp', 'iva',
                        'pna_t', 'initial_date', 'end_date', 'status'];
}
