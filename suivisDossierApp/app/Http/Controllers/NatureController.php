<?php

namespace App\Http\Controllers;

use App\Http\Requests\NatureRequest;
use App\Models\Nature;


class NatureController extends Controller
{
    public $isAdd = true;
    public function index()
    {
        $natures = Nature::all();
        return view('pages.nature.nature_list', compact('natures'));
    }

    public function create()
    {
        $isAdd = true;
        return view('pages.nature.nature_edit', compact('isAdd'));
    }

    public function store(NatureRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        // $data['created_by'] = Auth::check() ? Auth::id() : null;
        Nature::create($data);
        return redirect()->route('natures.index')->with('success', 'Nature creer avec succès.');
    }

    public function show(Nature $nature)
    {
        return view('pages.nature.nature_show', compact('nature'));
    }

    public function edit(Nature $nature)
    {
        $isAdd = false;
        return view('pages.nature.nature_edit', compact('nature', 'isAdd'));
    }

    public function update(NatureRequest $request, Nature $nature)
    {
        $nature->update($request->validated());
        return redirect()->route('natures.index')->with('success', 'Nature mise à jour avec succès.');
    }

    public function destroy(Nature $nature)
    {
        $nature->delete();
        return redirect()->route('natures.index')->with('success', 'Nature supprimée avec succès.');
    }
}
