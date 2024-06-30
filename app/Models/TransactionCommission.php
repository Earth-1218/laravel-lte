<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionCommission extends Model
{
    use HasFactory;

    protected $table = 'transaction_commissions';

    protected $fillable = ['transaction_id','commission_amount'];
}
