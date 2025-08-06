<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index()
    {
        $id = session('user.id');

        $notes = User::find($id)
                    ->notes()
                    ->get();

        return view("home", compact('notes'));
    }

    public function newNote()
    {
        echo "I'm creating a new note";
    }

    public function editNote($id)
    {
        echo "Editing a note: ". Crypt::decrypt($id);
    }

    public function deleteNote($id)
    {
        echo "Deleting a note: ". Crypt::decrypt($id);
    }
}
