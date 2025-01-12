<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presences extends Model
{
    use HasFactory;
        
    protected $table = 'presences';
    protected $primaryKey = 'uuid_presence';
    public $incrementing = false;
    protected $keyType = 'uuid';
    protected $guarded = [];

    public function subject()
    {
        return $this->belongsTo(Subjects::class, 'subject');
    }

    public function student()
    {
        return $this->belongsTo(Students::class, 'student');
    }
}
