<?php

namespace App\Http\Controllers;

use App\Http\Requests\AutoriteRequest;
use App\Models\Autorite;

class AutoriteController extends Controller
{
    public $isAdd = true;
    public function index()
    {
        $autorites = Autorite::all();
        return view('pages.autorite.autorite_list', compact('autorites'));
    }

    public function create()
    {
        $isAdd = true;
        return view('pages.autorite.autorite_edit', compact('isAdd'));
    }

    public function store(AutoriteRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        // $data['created_by'] = Auth::check() ? Auth::id() : null;
        Autorite::create($data);
        return redirect()->route('autorites.index')->with('success', 'Autorité crée avec succès.');
    }

    public function show(Autorite $autorite)
    {
        return view('pages.autorite.show', compact('autorite'));
    }

    public function edit(Autorite $autorite)
    {
        $isAdd = false;
        return view('pages.autorite.autorite_edit', compact('autorite', 'isAdd'));
    }

    public function update(AutoriteRequest $request, Autorite $autorite)
    {
        $autorite->update($request->validated());
        return redirect()->route('autorites.index')->with('success', 'Autorité mise à jour avec succès.');
    }

    public function destroy(Autorite $autorite)
    {
        $autorite->delete();
        return redirect()->route('autorites.index')->with('success', 'Autorité supprimée avec succès.');
    }
}
