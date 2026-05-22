@extends('base')

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Détail du Dossier</h3>
            <p class="text-subtitle text-muted">{{ $dossier->numero_reception }}</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dossiers.index') }}">Liste des Dossiers</a>
                    </li>
                    <li class="breadcrumb-item active">Détail</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

{{-- Message flash --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<section class="section">
    <div class="row">

        {{-- ==============================
             COLONNE GAUCHE
        ============================== --}}
        <div class="col-md-8 col-12">

            {{-- INFORMATIONS GÉNÉRALES --}}
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-info-circle me-1"></i> Informations générales
                    </h5>
                    <div>
                        <a href="{{ route('dossiers.edit', $dossier->id) }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil"></i> Modifier
                        </a>
                        <button
                            type="button"
                            class="btn btn-sm btn-danger ms-1"
                            data-bs-toggle="modal"
                            data-bs-target="#modal-delete">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">N° Réception</small>
                            <strong>{{ $dossier->numero_reception }}</strong>
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">N° Bordereau</small>
                            <strong>{{ $dossier->numero_bordereau ?? '—' }}</strong>
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">Référence lettre DNCCP</small>
                            <strong>{{ $dossier->reference_lettre_dnccp ?? '—' }}</strong>
                        </div>

                        <div class="col-12 mb-3">
                            <small class="text-muted d-block">Objet</small>
                            <strong>{{ $dossier->objet }}</strong>
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">Autorité contractante</small>
                            <strong>{{ $dossier->autorite->nom ?? '—' }}</strong>
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">Nature</small>
                            <strong>{{ $dossier->nature->libelle ?? '—' }}</strong>
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">Statut</small>
                            <span class="badge bg-primary fs-6">
                                {{ $dossier->statut->libelle ?? '—' }}
                            </span>
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">ANO</small>
                            <strong>{{ $dossier->ano->avis ?? '—' }}</strong>
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">Type de version</small>
                            <strong>{{ $dossier->typeversion->libelle ?? '—' }}</strong>
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">Dossier parent</small>
                            @if($dossier->dossier_parent_id)
                            <a href="{{ route('dossiers.show', $dossier->dossier_parent_id) }}">
                                {{ $dossier->dossier_parent_id }}
                            </a>
                            @else
                            <strong>—</strong>
                            @endif
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">Respect PPM</small>
                            @if($dossier->respect_ppm)
                            <span class="badge bg-success">Oui</span>
                            @else
                            <span class="badge bg-secondary">Non</span>
                            @endif
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">Délai d'évaluation</small>
                            <strong>{{ $dossier->delai_evaluation ? $dossier->delai_evaluation . ' jours' : '—' }}</strong>
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">Temps de traitement</small>
                            <strong>{{ $dossier->temps_traitement ? $dossier->temps_traitement . ' jours' : '—' }}</strong>
                        </div>

                    </div>
                </div>
            </div>

            {{-- DATES --}}
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-calendar me-1"></i> Dates
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">Date de réception</small>
                            <strong>{{ $dossier->date_reception?->format('d/m/Y') ?? '—' }}</strong>
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">Date prévision PPM</small>
                            <strong>{{ $dossier->date_prevision_ppm?->format('d/m/Y') ?? '—' }}</strong>
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">Date limite DN</small>
                            <strong>{{ $dossier->date_limite_dn?->format('d/m/Y') ?? '—' }}</strong>
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">Date probable de signature</small>
                            <strong>{{ $dossier->date_probable_signature?->format('d/m/Y') ?? '—' }}</strong>
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">Date signature réponse</small>
                            <strong>{{ $dossier->date_signature_reponse?->format('d/m/Y') ?? '—' }}</strong>
                        </div>

                        <div class="col-md-4 col-12 mb-3">
                            <small class="text-muted d-block">Date ouverture des offres</small>
                            <strong>{{ $dossier->date_ouverture_offres?->format('d/m/Y') ?? '—' }}</strong>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        {{-- ==============================
             COLONNE DROITE
        ============================== --}}
        <div class="col-md-4 col-12">

            {{-- PERSONNELS --}}
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-people me-1"></i> Personnels
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($dossier->personnels->isEmpty())
                    <p class="text-muted text-center p-3 mb-0">Aucun personnel associé.</p>
                    @else
                    <ul class="list-group list-group-flush">
                        @foreach($dossier->personnels as $personnel)
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div>
                                <strong>{{ $personnel->nom }} {{ $personnel->prenom }}</strong>
                                <br>
                                <small class="text-muted">{{ $personnel->pivot->role_dans_dossier }}</small>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>

            {{-- ENTITES --}}
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-building me-1"></i> Entités
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($dossier->entites->isEmpty())
                    <p class="text-muted text-center p-3 mb-0">Aucune entité associée.</p>
                    @else
                    <ul class="list-group list-group-flush">
                        @foreach($dossier->entites as $entite)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $entite->nom }}
                            <span class="badge bg-secondary">{{ $entite->pivot->type }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>

            {{-- INSTRUCTIONS --}}
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-file-text me-1"></i> Instructions
                    </h5>
                </div>
                <div class="card-body p-0">
                    @if($dossier->instructions->isEmpty())
                    <p class="text-muted text-center p-3 mb-0">Aucune instruction associée.</p>
                    @else
                    <ul class="list-group list-group-flush">
                        @foreach($dossier->instructions as $instruction)
                        <li class="list-group-item">
                            {{ $instruction->libelle }}
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ==============================
     MODAL SUPPRESSION
============================== --}}
<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Confirmation de suppression</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Voulez-vous vraiment supprimer le dossier
                <strong>{{ $dossier->numero_reception }}</strong> ?
                <br>
                <small class="text-muted">Cette action est irréversible.</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    Annuler
                </button>
                <form action="{{ route('dossiers.destroy', $dossier->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection