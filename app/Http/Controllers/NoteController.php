<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Admin — makikita lahat ng notes
        // Regular user — sarili lang
        if ($user->isAdmin()) {
            $notes = Note::with('user')->latest()->get();
        } else {
            $notes = Note::where('user_id', $user->id)->latest()->get();
        }

        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        Note::create([
            'title'   => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(), // ← ito ang kulang dati
        ]);

        return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }

    public function edit(Note $note)
    {
        // Regular user — hindi pwedeng i-edit ang notes ng iba
        if (!Auth::user()->isAdmin() && $note->user_id !== Auth::id()) {
            abort(403, 'Unauthorized.');
        }

        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        // Regular user — hindi pwedeng i-update ang notes ng iba
        if (!Auth::user()->isAdmin() && $note->user_id !== Auth::id()) {
            abort(403, 'Unauthorized.');
        }

        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $note->update($request->only(['title', 'content']));

        return redirect()->route('notes.index')->with('success', 'Note updated successfully.');
    }

    public function destroy(Note $note)
    {
        // Regular user — hindi pwedeng i-delete ang notes ng iba
        if (!Auth::user()->isAdmin() && $note->user_id !== Auth::id()) {
            abort(403, 'Unauthorized.');
        }

        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
    }
}