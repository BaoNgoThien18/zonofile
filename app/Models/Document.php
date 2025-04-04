<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'documents';

    protected $fillable = [
        'user_id',
        'folder_id',
        'title',
        'path',
        'type',
        'count_downloads',
        'shared_id',
        'is_deleted',
        'size',
    ];

  
}
