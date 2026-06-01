<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            // Admin — lahat ng stats
            $usersCount = User::count();
            $notesCount = Note::count();
        } else {
            // Regular user — sarili lang
            $usersCount = null;
            $notesCount = Note::where('user_id', $user->id)->count();
        }

        return view('dashboard', compact('usersCount', 'notesCount'));
    }
}