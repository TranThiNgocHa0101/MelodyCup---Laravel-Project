<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'score']; // Cho phép các cột này được điền tự động

    // Quan hệ với bảng users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
