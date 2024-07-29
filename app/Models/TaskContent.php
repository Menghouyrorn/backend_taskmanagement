<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task_content extends Model
{
    use HasFactory;

    protected $table = 'task_content';
    protected $quarded = ['id'];

    protected $fillable = [
        'task_id',
        'title',
        'issuccess',
        'start_on',
        'end_on'
    ];
}
