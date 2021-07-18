<?php

namespace App\Http\Controllers;

use App\Models\admin;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        $admin = admin::all();
        return view('test',[
            'admin' => $admin
        ]);
    }
}
