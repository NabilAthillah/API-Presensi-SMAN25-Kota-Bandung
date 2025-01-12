<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;

    protected $table = 'teacher_employees';
    protected $primaryKey = 'nip';
    public $incrementing = false;
    protected $keyType = 'integer';
    protected $guarded = [];

    public function subject()
    {
        return $this->hasMany(Subjects::class, 'nip');
    }

    public function class()
    {
        return $this->hasMany(Classes::class, 'nip');
    }
}
