<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FromTo extends Model
{
    use HasFactory;
    protected $table = 'from_tos';
    protected $fillable = [
        'from_to',
    ];
}
