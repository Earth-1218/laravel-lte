<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['uid', 'user_platform_id', 'amount', 'status', 'date'];

    public function user_platform()
    {
        return $this->belongsTo(UserPlatform::class);
    }
}
