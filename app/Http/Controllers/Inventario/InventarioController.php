<?php

namespace App\Http\Controllers\Inventario;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    public function index()
    {
        $students= Student::all();
        return view('inventory.index', compact('students'));
    }
    public function add_product()
    {
        return view('inventory.create');
    }

}
