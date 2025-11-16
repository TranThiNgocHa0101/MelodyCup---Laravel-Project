<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PianoVirtual extends Model
{
    

    protected $table = 'pianovitual';
    protected $fillable = ['id','level','song'];   
}
