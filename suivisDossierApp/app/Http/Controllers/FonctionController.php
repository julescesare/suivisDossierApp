<?php

namespace App\Http\Controllers;

use App\Http\Requests\fonctionRequest;
use App\Models\Fonction;
use Illuminate\Http\Request;

class FonctionController extends Controller
{
    public $isAdd = true;
    public function index()
    {
        $fonctions = Fonction::all();
        return view('pages.fonction.fonction_list', compact('fonctions'));
    }

    public function create()
    {
        $isAdd = true;
        return view('pages.fonction.fonction_edit', compact('isAdd'));
    }

    public function store(fonctionRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        // $data['created_by'] = Auth::check() ? Auth::id() : null;
        Fonction::create($data);
        return redirect()->route('fonctions.index')->with('success', 'Fonction créée avec succès.');
    }

    public function show(Fonction $fonction)
    {
        return view('pages.fonction.fonction_show', compact('fonction'));
    }

    public function edit(Fonction $fonction)
    {
        $isAdd = false;
        return view('pages.fonction.fonction_edit', compact('fonction', 'isAdd'));
    }

    public function update(fonctionRequest $request, Fonction $fonction)
    {
        $fonction->update($request->validated());
        return redirect()->route('fonctions.index')->with('success', 'Fonction mise à jour avec succès.');
    }

    public function destroy(Fonction $fonction)
    {
        $fonction->delete();
        return redirect()->route('fonctions.index')->with('success', 'Fonction supprimée avec succès.');
    }
}
