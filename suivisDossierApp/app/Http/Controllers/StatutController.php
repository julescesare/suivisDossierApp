<?php

namespace App\Http\Controllers;

use App\Enums\StatutColor;
use App\Models\Statut;
use App\Http\Requests\StatutRequest;

class StatutController extends Controller
{
    public function index()
    {
        $statuts = Statut::all();
        return view('pages.statut.statut_list', compact('statuts'));
    }

    public function create()
    {
        $isAdd    = true;
        $couleurs = StatutColor::cases();

        return view('pages.statut.statut_edit', compact('isAdd', 'couleurs'));
    }

    public function store(StatutRequest $request)
    {
        $data = $request->validated();

        // Si la couleur n'est pas custom, on écrase couleur_hex à null
        if ($data['couleur'] !== StatutColor::CUSTOM->value) {
            $data['couleur_hex'] = null;
        }

        Statut::create($data);

        return redirect()
            ->route('statuts.index')
            ->with('success', 'Statut créé avec succès.');
    }

    public function show(Statut $statut)
    {
        return view('pages.statut.statut_show', compact('statut'));
    }

    public function edit(Statut $statut)
    {
        $isAdd    = false;
        $couleurs = StatutColor::cases();

        return view('pages.statut.statut_edit', compact('statut', 'isAdd', 'couleurs'));
    }

    public function update(StatutRequest $request, Statut $statut)
    {
        $data = $request->validated();

        // Même logique : nettoyer couleur_hex si non custom
        if ($data['couleur'] !== StatutColor::CUSTOM->value) {
            $data['couleur_hex'] = null;
        }

        $statut->update($data);

        return redirect()
            ->route('statuts.index')
            ->with('success', 'Statut mis à jour avec succès.');
    }

    public function destroy(Statut $statut)
    {
        $statut->delete();

        return redirect()
            ->route('statuts.index')
            ->with('success', 'Statut supprimé avec succès.');
    }
}
