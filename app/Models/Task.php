<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $quarded = ['id'];

    protected $fillable = [
        'user_id',
        'title'
    ];

    public function getwithuser()
    {
        return $this->hasMany(Auth::class);
    }
}
