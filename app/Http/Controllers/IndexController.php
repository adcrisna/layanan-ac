<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class IndexController extends Controller
{
    public function index(){
        return view('index');
    }
}
