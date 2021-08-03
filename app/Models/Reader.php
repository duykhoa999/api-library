<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reader extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'readers';

    protected $fillable = [
        'name',
        'address',
        'resDate',
    ];
}
