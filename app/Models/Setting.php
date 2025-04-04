<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
    ];
    public $timestamps = true;
    protected $table = 'settings';

    public static function findByName($name)
    {
        $row = self::where('name', $name)->first();

        if (!$row)
            return '';

        return $row['value'];
    }

}
