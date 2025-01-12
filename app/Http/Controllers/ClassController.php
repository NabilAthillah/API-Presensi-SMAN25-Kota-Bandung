<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function getClasses() {
        $classes = Classes::with('teachers')->all();
    }
}
