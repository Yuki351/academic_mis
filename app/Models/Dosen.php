<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = 'dosen';
    protected $primarykey = 'nik';
    protected $fillable = ['nik', 'name', 'birthdate', 'email'];
    protected $keytype = 'string';
    public $incrementing = false;
}
