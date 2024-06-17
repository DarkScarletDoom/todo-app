<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Store
     * 
     * @param Request $request
     */
    public function store(Request $request)
    {
        $validatedFields = $request->validate([
           'content' => 'required'
        ]);
        $validatedFields['user_id'] = session('user_id');
        //dd($validatedFields);
        $task = Task::create($validatedFields);
        // dd($request);
        if(Auth::check()) {
            return redirect('/home');
        }
    }

     /**
     * Get list
     */
    public function getList()
    {
        return Task::all();
    }

    /**
     * Delete object.
     */
    public function delete(string $id)
    {
        Task::findOrFail($id)->delete();
        if(Auth::check()) {
            return redirect('/home');
        }
    }
}
