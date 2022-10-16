<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PCAController extends Controller
{
    public function index(){
        return view('PCA_admin');
    }
}
