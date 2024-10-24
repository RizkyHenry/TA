<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
   
        $user = Auth::user(); // Mendapatkan user yang sedang login
        return view('dashboard', compact('user')); // Kirim variabel ke view
    }
}
