<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;
    
    protected $table = 'students';
    protected $primaryKey = 'nisn';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class');
    }

    public function parent()
    {
        return $this->belongsTo(Parents::class, 'parents');
    }
}
