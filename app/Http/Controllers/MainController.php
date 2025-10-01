<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditNoteRequest;
use App\Http\Requests\NewNoteRequest;
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
                    ->whereNull('deleted_at')
                    ->get();

        return view("home", compact('notes'));
    }

    public function newNote()
    {
        return view("new_note");
    }

    public function newNoteSubmit(NewNoteRequest $request)
    {
        $request->validated();

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
        if(!$id) {
            return redirect()->route("index");
        }

        $note = Note::find($id);

        return view("edit_note", compact("note"));
    }

    public function editNoteSubmit(EditNoteRequest $request)
    {
        $request->validated();

        if($request->note_id == null) {
            return redirect()->route("index");
        }

        $id = Opetations::decryptId($request->note_id);
        if(!$id) {
            return redirect()->route("index");
        }

        $note = Note::find($id);
        $note->title = $request->text_title;
        $note->text = $request->text_note;
        $note->save();

        return redirect()->route("index");
    }

    public function deleteNote($id)
    {
        $id = Opetations::decryptId($id);
        if(!$id) {
            return redirect()->route("index");
        }

        $note = Note::find($id);

        return view("delete_note", ['note' => $note]);
    }

    public function deleteNoteConfirm($id)
    {
        $id = Opetations::decryptId($id);
        if(!$id) {
            return redirect()->route("index");
        }

        $note = Note::find($id)->first();
        $note->delete();

        return redirect()->route("index");
    }
}
