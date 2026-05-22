@extends('base')

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>{{ $isAdd ? 'Nouveau Dossier' : 'Modifier le Dossier' }}</h3>
            <p class="text-subtitle text-muted">
                {{ $isAdd ? 'Enregistrement d\'un nouveau dossier' : 'Modification du dossier #' . $dossier->numero_reception }}
            </p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dossiers.index') }}">Liste des Dossiers</a></li>
                    <li class="breadcrumb-item active">
                        {{ $isAdd ? 'Nouveau' : 'Modifier' }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section id="dossier-form">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">

                        <form
                            action="{{ $isAdd ? route('dossiers.store') : route('dossiers.update', $dossier) }}"
                            method="POST">
                            @csrf
                            @if(!$isAdd)
                            @method('PUT')
                            @endif

                            {{-- MESSAGES D'ERREURS GLOBAUX --}}
                            @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            {{-- ==============================
                                 SECTION 1 : INFORMATIONS GÉNÉRALES
                            ============================== --}}
                            <h6 class="text-muted mb-3 mt-2">
                                <i class="bi bi-info-circle"></i> Informations générales
                            </h6>
                            <div class="row">

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="numero_reception">Numéro de réception <span class="text-danger">*</span></label>
                                        <input
                                            type="text"
                                            id="numero_reception"
                                            name="numero_reception"
                                            class="form-control @error('numero_reception') is-invalid @enderror"
                                            value="{{ old('numero_reception', $dossier->numero_reception ?? '') }}"
                                            placeholder="Ex: DR-2024-001">
                                        @error('numero_reception')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="numero_bordereau">Numéro de bordereau</label>
                                        <input
                                            type="text"
                                            id="numero_bordereau"
                                            name="numero_bordereau"
                                            class="form-control @error('numero_bordereau') is-invalid @enderror"
                                            value="{{ old('numero_bordereau', $dossier->numero_bordereau ?? '') }}"
                                            placeholder="Ex: NB-2024-001">
                                        @error('numero_bordereau')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="reference_lettre_dnccp">Référence lettre DNCCP</label>
                                        <input
                                            type="text"
                                            id="reference_lettre_dnccp"
                                            name="reference_lettre_dnccp"
                                            class="form-control @error('reference_lettre_dnccp') is-invalid @enderror"
                                            value="{{ old('reference_lettre_dnccp', $dossier->reference_lettre_dnccp ?? '') }}">
                                        @error('reference_lettre_dnccp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="objet">Objet <span class="text-danger">*</span></label>
                                        <textarea
                                            id="objet"
                                            name="objet"
                                            rows="3"
                                            class="form-control @error('objet') is-invalid @enderror"
                                            placeholder="Décrivez l'objet du dossier...">{{ old('objet', $dossier->objet ?? '') }}</textarea>
                                        @error('objet')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            {{-- ==============================
                                 SECTION 2 : CLASSIFICATION
                            ============================== --}}
                            <h6 class="text-muted mb-3 mt-3">
                                <i class="bi bi-tag"></i> Classification
                            </h6>
                            <div class="row">

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="autorite_id">Autorité contractante <span class="text-danger">*</span></label>
                                        <select
                                            id="autorite_id"
                                            name="autorite_id"
                                            class="form-select @error('autorite_id') is-invalid @enderror">
                                            <option value="">-- Sélectionner --</option>
                                            @foreach($autorites as $autorite)
                                            <option
                                                value="{{ $autorite->id }}"
                                                {{ old('autorite_id', $dossier->autorite_id ?? '') == $autorite->id ? 'selected' : '' }}>
                                                {{ $autorite->nom }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('autorite_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="nature_id">Nature <span class="text-danger">*</span></label>
                                        <select
                                            id="nature_id"
                                            name="nature_id"
                                            class="form-select @error('nature_id') is-invalid @enderror">
                                            <option value="">-- Sélectionner --</option>
                                            @foreach($natures as $nature)
                                            <option
                                                value="{{ $nature->id }}"
                                                {{ old('nature_id', $dossier->nature_id ?? '') == $nature->id ? 'selected' : '' }}>
                                                {{ $nature->libelle }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('nature_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="statut_id">Statut <span class="text-danger">*</span></label>
                                        <select
                                            id="statut_id"
                                            name="statut_id"
                                            class="form-select @error('statut_id') is-invalid @enderror">
                                            <option value="">-- Sélectionner --</option>
                                            @foreach($statuts as $statut)
                                            <option
                                                value="{{ $statut->id }}"
                                                {{ old('statut_id', $dossier->statut_id ?? '') == $statut->id ? 'selected' : '' }}>
                                                {{ $statut->libelle }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('statut_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="ano_id">ANO</label>
                                        <select
                                            id="ano_id"
                                            name="ano_id"
                                            class="form-select @error('ano_id') is-invalid @enderror">
                                            <option value="">-- Sélectionner --</option>
                                            @foreach($anos as $ano)
                                            <option
                                                value="{{ $ano->id }}"
                                                {{ old('ano_id', $dossier->ano_id ?? '') == $ano->id ? 'selected' : '' }}>
                                                {{ $ano->avis }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('ano_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="type_version_id">Type de version</label>
                                        <select
                                            id="type_version_id"
                                            name="type_version_id"
                                            class="form-select @error('type_version_id') is-invalid @enderror">
                                            <option value="">-- Sélectionner --</option>
                                            @foreach($typeVersions as $tv)
                                            <option
                                                value="{{ $tv->id }}"
                                                {{ old('type_version_id', $dossier->type_version_id ?? '') == $tv->id ? 'selected' : '' }}>
                                                {{ $tv->libelle }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('type_version_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="dossier_parent_id">Dossier parent</label>
                                        <select
                                            id="dossier_parent_id"
                                            name="dossier_parent_id"
                                            class="form-select @error('dossier_parent_id') is-invalid @enderror">
                                            <option value="">-- Aucun --</option>
                                            @foreach(\App\Models\Dossier::orderBy('numero_reception')->get() as $d)
                                            @if(!isset($dossier) || $d->id !== $dossier->id)
                                            <option
                                                value="{{ $d->id }}"
                                                {{ old('dossier_parent_id', $dossier->dossier_parent_id ?? '') == $d->id ? 'selected' : '' }}>
                                                {{ $d->numero_reception }}
                                            </option>
                                            @endif
                                            @endforeach
                                        </select>
                                        @error('dossier_parent_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            {{-- ==============================
                                 SECTION 3 : DATES
                            ============================== --}}
                            <h6 class="text-muted mb-3 mt-3">
                                <i class="bi bi-calendar"></i> Dates
                            </h6>
                            <div class="row">

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="date_reception">Date de réception <span class="text-danger">*</span></label>
                                        <input
                                            type="date"
                                            id="date_reception"
                                            name="date_reception"
                                            class="form-control @error('date_reception') is-invalid @enderror"
                                            value="{{ old('date_reception', isset($dossier->date_reception) ? $dossier->date_reception->format('Y-m-d') : '') }}">
                                        @error('date_reception')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="date_prevision_ppm">Date prévision PPM</label>
                                        <input
                                            type="date"
                                            id="date_prevision_ppm"
                                            name="date_prevision_ppm"
                                            class="form-control @error('date_prevision_ppm') is-invalid @enderror"
                                            value="{{ old('date_prevision_ppm', isset($dossier->date_prevision_ppm) ? $dossier->date_prevision_ppm->format('Y-m-d') : '') }}">
                                        @error('date_prevision_ppm')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="date_limite_dn">Date limite DN</label>
                                        <input
                                            type="date"
                                            id="date_limite_dn"
                                            name="date_limite_dn"
                                            class="form-control @error('date_limite_dn') is-invalid @enderror"
                                            value="{{ old('date_limite_dn', isset($dossier->date_limite_dn) ? $dossier->date_limite_dn->format('Y-m-d') : '') }}">
                                        @error('date_limite_dn')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="date_probable_signature">Date probable de signature</label>
                                        <input
                                            type="date"
                                            id="date_probable_signature"
                                            name="date_probable_signature"
                                            class="form-control @error('date_probable_signature') is-invalid @enderror"
                                            value="{{ old('date_probable_signature', isset($dossier->date_probable_signature) ? $dossier->date_probable_signature->format('Y-m-d') : '') }}">
                                        @error('date_probable_signature')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="date_signature_reponse">Date signature réponse</label>
                                        <input
                                            type="date"
                                            id="date_signature_reponse"
                                            name="date_signature_reponse"
                                            class="form-control @error('date_signature_reponse') is-invalid @enderror"
                                            value="{{ old('date_signature_reponse', isset($dossier->date_signature_reponse) ? $dossier->date_signature_reponse->format('Y-m-d') : '') }}">
                                        @error('date_signature_reponse')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="date_ouverture_offres">Date d'ouverture des offres</label>
                                        <input
                                            type="date"
                                            id="date_ouverture_offres"
                                            name="date_ouverture_offres"
                                            class="form-control @error('date_ouverture_offres') is-invalid @enderror"
                                            value="{{ old('date_ouverture_offres', isset($dossier->date_ouverture_offres) ? $dossier->date_ouverture_offres->format('Y-m-d') : '') }}">
                                        @error('date_ouverture_offres')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            {{-- ==============================
                                 SECTION 4 : DÉLAIS & SUIVI
                            ============================== --}}
                            <h6 class="text-muted mb-3 mt-3">
                                <i class="bi bi-clock"></i> Délais & Suivi
                            </h6>
                            <div class="row">

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="delai_evaluation">Délai d'évaluation (jours)</label>
                                        <input
                                            type="number"
                                            id="delai_evaluation"
                                            name="delai_evaluation"
                                            min="0"
                                            class="form-control @error('delai_evaluation') is-invalid @enderror"
                                            value="{{ old('delai_evaluation', $dossier->delai_evaluation ?? '') }}">
                                        @error('delai_evaluation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="temps_traitement">Temps de traitement (jours)</label>
                                        <input
                                            type="number"
                                            id="temps_traitement"
                                            name="temps_traitement"
                                            min="0"
                                            class="form-control @error('temps_traitement') is-invalid @enderror"
                                            value="{{ old('temps_traitement', $dossier->temps_traitement ?? '') }}">
                                        @error('temps_traitement')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label>Respect PPM</label>
                                        <div class="form-check form-switch mt-2">
                                            <input
                                                type="checkbox"
                                                id="respect_ppm"
                                                name="respect_ppm"
                                                value="1"
                                                class="form-check-input"
                                                {{ old('respect_ppm', $dossier->respect_ppm ?? false) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="respect_ppm">Oui</label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            {{-- ==============================
                                 SECTION 5 : RELATIONS N:N
                            ============================== --}}
                            <h6 class="text-muted mb-3 mt-3">
                                <i class="bi bi-people"></i> Associations
                            </h6>
                            <div class="row">

                                {{-- INSTRUCTIONS --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="instructions">Instructions</label>
                                        <select
                                            id="instructions"
                                            name="instructions[]"
                                            class="choices form-select multiple-remove @error('instructions') is-invalid @enderror"
                                            multiple="multiple">
                                            @foreach($instructions as $instruction)
                                            <option
                                                value="{{ $instruction->id }}"
                                                {{
                                                        in_array(
                                                            $instruction->id,
                                                            old('instructions',
                                                                isset($dossier) ? $dossier->instructions->pluck('id')->toArray() : []
                                                            )
                                                        ) ? 'selected' : ''
                                                    }}>
                                                {{ $instruction->contenu }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('instructions')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- ENTITES --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="entites">Entités</label>
                                        <select
                                            id="entites"
                                            name="entites[]"
                                            class="choices form-select multiple-remove @error('entites') is-invalid @enderror"
                                            multiple="multiple">
                                            @foreach($entites as $entite)
                                            <option
                                                value="{{ $entite->id }}"
                                                {{
                                                        in_array(
                                                            $entite->id,
                                                            old('entites',
                                                                isset($dossier) ? $dossier->entites->pluck('id')->toArray() : []
                                                            )
                                                        ) ? 'selected' : ''
                                                    }}>
                                                {{ $entite->nom }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('entites')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            {{-- PERSONNELS avec role (tableau dynamique) --}}
                            <div class="row mt-2">
                                <div class="col-12">
                                    <label class="mb-2">Personnels & Rôles</label>
                                    <table class="table table-bordered" id="personnels-table">
                                        <thead>
                                            <tr>
                                                <th>Personnel</th>
                                                <th>Rôle dans le dossier</th>
                                                <th width="50"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="personnels-body">
                                            {{-- Lignes existantes en mode edit --}}
                                            @if(!$isAdd && isset($dossier))
                                            @foreach($dossier->personnels as $index => $personnel)
                                            <tr>
                                                <td>
                                                    <select name="personnels[{{ $index }}][id]" class="form-select">
                                                        @foreach($personnelsList as $p)
                                                        <option value="{{ $p->id }}" {{ $p->id == $personnel->id ? 'selected' : '' }}>
                                                            {{ $p->nom }} {{ $p->prenom }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input
                                                        type="text"
                                                        name="personnels[{{ $index }}][role_dans_dossier]"
                                                        class="form-control"
                                                        value="{{ $personnel->pivot->role_dans_dossier }}"
                                                        placeholder="Ex: Rapporteur, Chef de projet...">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-danger remove-row">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>

                                    <button type="button" class="btn btn-sm btn-secondary mt-1" id="add-personnel">
                                        <i class="bi bi-plus-circle"></i> Ajouter un personnel
                                    </button>

                                    @error('personnels')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                    @error('personnels.*.id')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- ==============================
                                 BOUTONS
                            ============================== --}}
                            <div class="col-12 d-flex justify-content-end mt-4">
                                <a href="{{ route('dossiers.index') }}" class="btn btn-light-secondary me-1 mb-1">
                                    Annuler
                                </a>
                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                    <i class="bi bi-save"></i>
                                    {{ $isAdd ? 'Enregistrer' : 'Mettre à jour' }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // -------------------------------------------------------
    // Tableau dynamique des personnels
    // -------------------------------------------------------
    let rowIndex = {
        {
            !$isAdd && isset($dossier) ? $dossier - > personnels - > count() : 0
        }
    };

    const personnelOptions = `
        @foreach($personnelsList as $p)
            <option value="{{ $p->id }}">{{ $p->nom }} {{ $p->prenom }}</option>
        @endforeach
    `;

    document.getElementById('add-personnel').addEventListener('click', function() {
        const tbody = document.getElementById('personnels-body');
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>
                <select name="personnels[${rowIndex}][id]" class="form-select">
                    ${personnelOptions}
                </select>
            </td>
            <td>
                <input
                    type="text"
                    name="personnels[${rowIndex}][role_dans_dossier]"
                    class="form-control"
                    placeholder="Ex: Rapporteur, Chef de projet..."
                >
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-danger remove-row">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
        rowIndex++;
    });

    // Suppression d'une ligne (délégation d'événement)
    document.getElementById('personnels-body').addEventListener('click', function(e) {
        if (e.target.closest('.remove-row')) {
            e.target.closest('tr').remove();
        }
    });
</script>
@endpush