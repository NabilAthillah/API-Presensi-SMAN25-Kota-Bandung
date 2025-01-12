<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;

    protected $table = 'parents';
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    public function student()
    {
        return $this->hasMany(Students::class, 'email');
    }
}
