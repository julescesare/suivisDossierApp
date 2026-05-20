<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntiteRequest;
use App\Models\Entite;
use Illuminate\Http\Request;

class EntiteController extends Controller
{
    public $isAdd = true;
    public function index()
    {
        $entites = Entite::all();
        return view('pages.entite.entite_list', compact('entites'));
    }

    public function create()
    {
        $isAdd = true;
        return view('pages.entite.entite_edit', compact('isAdd'));
    }

    public function store(EntiteRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        // $data['created_by'] = Auth::check() ? Auth::id() : null;
        Entite::create($data);
        return redirect()->route('entites.index')->with('success', 'Entité créée avec succès.');
    }

    public function show(Entite $entite)
    {
        return view('pages.entite.entite_show', compact('entite'));
    }

    public function edit(Entite $entite)
    {
        $isAdd = false;
        return view('pages.entite.entite_edit', compact('entite', 'isAdd'));
    }

    public function update(EntiteRequest $request, Entite $entite)
    {
        $entite->update($request->validated());
        return redirect()->route('entites.index')->with('success', 'Entité mise à jour avec succès.');
    }

    public function destroy(Entite $entite)
    {
        $entite->delete();
        return redirect()->route('entites.index')->with('success', 'Entité supprimée avec succès.');
    }
}
