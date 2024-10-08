<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskContent extends Model
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

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function getwithTaskFolder(){
        return $this->hasMany(Task::class,'id','task_id');
    }

    public function getonlyOneTaskcontent(){
        return $this->belongsTo(Task::class,'task_id','id');
    }
}
