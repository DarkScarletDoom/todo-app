<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Task;

class HomeController extends Controller
{
    public function index() {
        return view('home', ['tasks' =>Task::where('user_id', '=', session('user_id'))->get()]);
    }
}
