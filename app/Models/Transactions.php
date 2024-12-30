<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    protected $table = 'transactions';

    protected $fillable=['transaction_type', 'bank_name', 'transaction_date', 'transaction_number', 'transaction_amount','user_id'];

    public $timestamps = true;
}
