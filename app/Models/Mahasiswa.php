<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primarykey = 'nrp';
    protected $fillable = ['nrp', 'name', 'address', 'birthdate', 'email', 'phone', 'profilePicture', 'dosen_nik'];
    protected $keytype = 'string';
    public $incrementing = false;
    public function dosenWali() {
        return $this->belongsTo(Dosen::class, 'dosen_nik');
    }
}
