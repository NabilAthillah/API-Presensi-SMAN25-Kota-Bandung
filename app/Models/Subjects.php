<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    use HasFactory;
    
    protected $table = 'subjects';
    protected $primaryKey = 'uuid_subject';
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $guarded = [];

    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'teacher');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class');
    }

    public function presence()
    {
        return $this->hasMany(Presences::class, 'uuid_subject');
    }
}
