<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Opetations;
use Illuminate\Http\Request;

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
        $id = Opetations::decryptId($id);
        echo "I'm editing note with id = $id";
    }

    public function deleteNote($id)
    {
        $id = Opetations::decryptId($id);
        echo "I'm deleting note with id = $id";
    }
}
