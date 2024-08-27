<?php

namespace App\Http\Controllers;

use App\Models\Classeur;
use App\Models\Document;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class Classeurs extends Controller
{
    public function create(Request $request)
    {
        $classeurs = Classeur::where('user_id', Auth::user()->id)->get();
        $lenClasseurs = count($classeurs) + 1;
        $defaultName = "classeur(" . $lenClasseurs . ")";
        Classeur::create([
            'nom' => $defaultName,
            'user_id' => Auth::user()->id
        ]);

        return Inertia::render('Documents', [
            'user' => Auth::user(),
            'documents' => Document::where(
                'user_id',
                '=',
                Auth::user()->id
            )
                ->where('classeur_id', '=', null)
                ->get(),
            'users' => User::all()
                ->where('role', '=', null)
                ->where('id', '!=', Auth::user()->id),
            'services' => Service::all(),
            'classeurs' => Classeur::where(
                'user_id',
                '=',
                Auth::user()->id
            )
                ->get()
        ]);
    }

    public function update(Request $request)
    {
        DB::table('classeurs')
            ->where('id', $request->id)
            ->update([
                'nom' => $request->nom,
                'description' => $request->description
            ]);

        $classeurs = Classeur::where('user_id', '=', Auth::user()->id);
        return Inertia::render('Documents', [
            'user' => Auth::user(),
            'documents' => Document::where(
                'user_id',
                '=',
                Auth::user()->id
            )
                ->where('classeur_id', '=', null)
                ->get(),
            'users' => User::all()
                ->where('role', '=', null)
                ->where('id', '!=', Auth::user()->id),
            'services' => Service::all(),
            'classeurs' => $classeurs
                ->get()
        ]);
    }

    public function delete(Request $request)
    {
        Classeur::findOrFail($request->id)->delete();
        $classeurs = Classeur::where('user_id', '=', Auth::user()->id);
        return Inertia::render('Documents', [
            'user' => Auth::user(),
            'documents' => Document::where(
                'user_id',
                '=',
                Auth::user()->id
            )
                ->where('classeur_id', '=', null)
                ->get(),
            'users' => User::all()
                ->where('role', '=', null)
                ->where('id', '!=', Auth::user()->id),
            'services' => Service::all(),
            'classeurs' => $classeurs
                ->get()
        ]);
    }
}
