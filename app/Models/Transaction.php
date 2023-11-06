<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    use HasFactory;

    // protected $attributes = [
    //     "date" => DB::raw('CURRENT_TIMESTAMP'),
    // ];

    protected $fillable = ['date', 'amount', 'category_id', 'description', 'wallet_id', 'user_id'];
}
