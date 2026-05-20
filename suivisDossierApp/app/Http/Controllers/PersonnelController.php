<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonnelRequest;
use App\Models\Fonction;
use App\Models\Personnel;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public $isAdd = true;
    public function index()
    {
        $personnels = Personnel::all();
        return view('pages.personnel.personnel_list', compact('personnels'));
    }

    public function create()
    {
        $isAdd = true;
        $fonctions = Fonction::all();
        return view('pages.personnel.personnel_edit', compact('isAdd', 'fonctions'));
    }

    public function store(PersonnelRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        // $data['created_by'] = Auth::check() ? Auth::id() : null;
        Personnel::create($data);
        return redirect()->route('personnels.index')->with('success', 'Personnel crée avec succès.');
    }

    public function show(Personnel $personnel)
    {
        return view('pages.personnel.show', compact('personnel'));
    }

    public function edit(Personnel $personnel)
    {
        $isAdd = false;
        $fonctions = Fonction::all();
        return view('pages.personnel.personnel_edit', compact('personnel', 'isAdd', 'fonctions'));
    }

    public function update(PersonnelRequest $request, Personnel $personnel)
    {
        $personnel->update($request->validated());
        return redirect()->route('personnels.index')->with('success', 'Personnel mis à jour avec succès.');
    }

    public function destroy(Personnel $personnel)
    {
        $personnel->delete();
        return redirect()->route('personnels.index')->with('success', 'Personnel supprimé avec succès.');
    }
}
