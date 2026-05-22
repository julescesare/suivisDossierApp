<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use App\Models\Autorite;
use App\Models\Nature;
use App\Models\Ano;
use App\Models\TypeVersion;
use App\Models\Statut;
use App\Http\Requests\DossierRequest;
use App\Models\Entite;
use App\Models\Instruction;
use App\Models\Personnel;

class DossierController extends Controller
{
    public $isAdd = true;
    public function index()
    {
        $dossiers = Dossier::with(['autorite', 'nature', 'statut', 'ano', 'typeversion'])
            ->latest()
            ->paginate(20);

        return view('pages.dossier.dossier_list', compact('dossiers'));
    }

    public function create()
    {
        $isAdd = true;
        $autorites    = Autorite::orderBy('nom')->get();
        $natures      = Nature::orderBy('libelle')->get();
        $anos         = Ano::orderBy('avis')->get();
        $typeVersions = TypeVersion::orderBy('libelle')->get();
        $statuts      = Statut::orderBy('libelle')->get();
        $instructions = Instruction::orderBy('contenu')->get();
        $entites      = Entite::orderBy('nom')->get();
        $personnelsList = Personnel::orderBy('nom')->get();

        return view('pages.dossier.dossier_edit', compact(
            'autorites',
            'natures',
            'anos',
            'typeVersions',
            'statuts',
            'instructions',
            'entites',
            'personnelsList',
            'isAdd'
        ));
    }

    public function store(DossierRequest $request)
    {
        $dossier = Dossier::create(array_merge(
            $request->validated(),
            // ['created_by' => auth()->id()]
        ));

        $this->syncRelations($dossier, $request);

        return redirect()
            ->route('dossiers.show', $dossier)
            ->with('success', 'Dossier créé avec succès.');
    }

    public function show(Dossier $dossier)
    {
        $dossier->load([
            'autorite',
            'nature',
            'ano',
            'typeversion',
            'statut',
            'personnels',
            'entites',
            'instructions'
        ]);

        return view('pages.dossier.dossier_show', compact('dossier'));
    }

    public function edit(Dossier $dossier)
    {
        $isAdd = false;
        $dossier->load(['personnels', 'entites', 'instructions']);

        $autorites    = Autorite::orderBy('nom')->get();
        $natures      = Nature::orderBy('nom')->get();
        $anos         = Ano::orderBy('nom')->get();
        $typeVersions = TypeVersion::orderBy('nom')->get();
        $statuts      = Statut::orderBy('nom')->get();
        $instructions = Instruction::orderBy('contenu')->get();
        $entites      = Entite::orderBy('nom')->get();
        $personnelsList = Personnel::orderBy('nom')->get();

        return view('pages.dossier.dossier_edit', compact(
            'dossier',
            'autorites',
            'natures',
            'anos',
            'typeVersions',
            'statuts',
            'instructions',
            'entites',
            'personnelsList',
            'isAdd'
        ));
    }

    public function update(DossierRequest $request, Dossier $dossier)
    {
        $dossier->update($request->validated());

        $this->syncRelations($dossier, $request, detachIfMissing: true);

        return redirect()
            ->route('dossiers.show', $dossier)
            ->with('success', 'Dossier mis à jour avec succès.');
    }

    public function destroy(Dossier $dossier)
    {
        // Détacher toutes les relations pivot avant suppression
        $dossier->personnels()->detach();
        $dossier->entites()->detach();
        $dossier->instructions()->detach();

        $dossier->delete();

        return redirect()
            ->route('dossiers.index')
            ->with('success', 'Dossier supprimé avec succès.');
    }

    // -------------------------------------------------------
    //  Méthode privée mutualisée pour store() et update()
    // -------------------------------------------------------
    private function syncRelations(Dossier $dossier, $request, bool $detachIfMissing = false): void
    {
        // --- PERSONNELS (pivot : role_dans_dossier) ---
        if ($request->filled('personnels')) {
            $personnels = collect($request->personnels)
                ->mapWithKeys(fn($item) => [
                    $item['id'] => ['role_dans_dossier' => $item['role_dans_dossier']]
                ])
                ->toArray();

            $dossier->personnels()->sync($personnels);
        } elseif ($detachIfMissing) {
            $dossier->personnels()->detach();
        }

        // --- ENTITES (pivot : type) ---
        if ($request->filled('entites')) {
            $entites = collect($request->entites)
                ->mapWithKeys(fn($item) => [
                    $item['id'] => ['type' => $item['type']]
                ])
                ->toArray();

            $dossier->entites()->sync($entites);
        } elseif ($detachIfMissing) {
            $dossier->entites()->detach();
        }

        // --- INSTRUCTIONS (pas de pivot custom) ---
        if ($request->filled('instructions')) {
            $dossier->instructions()->sync($request->instructions);
        } elseif ($detachIfMissing) {
            $dossier->instructions()->detach();
        }
    }
}
