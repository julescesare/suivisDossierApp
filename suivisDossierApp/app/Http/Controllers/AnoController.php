<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnoRequest;
use App\Models\Ano;

class AnoController extends Controller
{
    public $isAdd = true;
    public function index()
    {
        $anos = Ano::all();
        return view('pages.ano.ano_list', compact('anos'));
    }

    public function create()
    {
        $isAdd = true;
        return view('pages.ano.ano_edit', compact('isAdd'));
    }

    public function store(AnoRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        // $data['created_by'] = Auth::check() ? Auth::id() : null;
        Ano::create($data);
        return redirect()->route('anos.index')->with('success', 'Ano crée avec succès.');
    }

    public function show(Ano $ano)
    {
        return view('pages.ano.show', compact('ano'));
    }

    public function edit(Ano $ano)
    {
        $isAdd = false;
        return view('pages.ano.ano_edit', compact('ano', 'isAdd'));
    }

    public function update(AnoRequest $request, Ano $ano)
    {
        $ano->update($request->validated());
        return redirect()->route('anos.index')->with('success', 'Ano mis à jour avec succès.');
    }

    public function destroy(Ano $ano)
    {
        $ano->delete();
        return redirect()->route('anos.index')->with('success', 'Ano supprimé avec succès.');
    }
}
