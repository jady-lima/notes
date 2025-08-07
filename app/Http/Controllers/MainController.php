<?php

namespace App\Http\Controllers;

use App\Models\Note;
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
        return view("new_note");
    }

    public function newNoteSubmit(Request $request)
    {
        $request->validate(
            [
                'text_title' => 'required|min:3|max:200',
                'text_note' => 'required|min:3|max:3000'
            ],
            [
                'text_title.required' => 'Oops! Title is required. Please enter a valid title address.',
                'text_title.min' => '"Oops! Title can have a minimum of :min characters',
                'text_title.max' => '"Oops! Title can have a maximum of :max  characters',
                'text_note.required' => 'Oops! Note is required.',
                'text_note.min' => '"Oops! Note can have a minimum of :min characters',
                'text_note.max' => '"Oops! Note can have a maximum of :max  characters',
            ]
        );

        $id = session("user.id");

        $note = new Note();
        $note->user_id = $id;
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        return redirect()->route("index");
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
