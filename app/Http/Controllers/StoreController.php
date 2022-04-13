<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;
use App\Models\Brand;


class StoreController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
