<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $table = 'class';
    protected $primaryKey = 'name';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    public function teacher()
    {
        return $this->belongsTo(Teachers::class, 'name');
    }

    public function subject()
    {
        return $this->hasmany(Subjects::class, 'nip');
    }

    public function student()
    {
        return $this->hasmany(Students::class, 'nip');
    }
}
