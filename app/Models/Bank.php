<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = array('Nama_Bank', 'Nama', 'Saldo');
    public $timestamps = true; 
}