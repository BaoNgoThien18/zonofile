<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentPermission extends Model
{
    use HasFactory;
    protected $table = 'document_permissions';

    protected $fillable = [
        'document_id',
        'user_id',
        'rule',
    ];
}
