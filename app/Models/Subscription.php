<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'user_id',
        'start_date',
        'end_date',
        'total_capacity',
        'used_capacity',
        'status',
    ];

    protected $table = 'subscriptions';

}