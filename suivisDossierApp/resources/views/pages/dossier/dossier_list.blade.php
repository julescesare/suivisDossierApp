@extends('base')

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>Liste des Dossiers</h3>
            <p class="text-subtitle text-muted">Gestion des dossiers</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dossiers.create') }}">Ajouter un Dossier</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Liste des Dossiers</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

{{-- Message flash --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<section class="section">
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>N° Réception</th>
                        <th>Bordereau</th>
                        <th>Objet</th>
                        <th>Autorité</th>
                        <th>Nature</th>
                        <th>Statut</th>
                        <th>Date réception</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dossiers as $dossier)
                    <tr>
                        <td>{{ $dossiers->firstItem() + $loop->index }}</td>
                        <td>{{ $dossier->numero_reception }}</td>
                        <td>{{ $dossier->numero_bordereau }}</td>
                        <td>{{ Str::limit($dossier->objet, 50) }}</td>
                        <td>{{ $dossier->autorite->nom ?? '—' }}</td>
                        <td>{{ $dossier->nature->libelle ?? '—' }}</td>
                        <td>
                            <span class="badge bg-primary">
                                {{ $dossier->statut->libelle ?? '—' }}
                            </span>
                        </td>
                        <td>{{ $dossier->date_reception?->format('d/m/Y') }}</td>
                        <td>
                            {{-- Voir le détail --}}
                            <a href="{{ route('dossiers.show', $dossier->id) }}"
                                class="btn btn-sm icon icon-left btn-info"
                                title="Voir">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                Détail
                            </a>

                            {{-- Modifier --}}
                            <a href="{{ route('dossiers.edit', $dossier->id) }}"
                                class="btn btn-sm icon icon-left btn-primary"
                                title="Modifier">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-edit">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Modifier
                            </a>

                            {{-- Supprimer → déclenche le modal avec l'ID du dossier --}}
                            <button
                                type="button"
                                class="btn btn-sm icon icon-left btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#modal-delete"
                                data-id="{{ $dossier->id }}"
                                data-label="{{ $dossier->numero_reception }}"
                                title="Supprimer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-trash">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                </svg>
                                Supprimer
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Aucun dossier enregistré.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-end mt-3">
                {{ $dossiers->links() }}
            </div>
        </div>
    </div>
</section>

{{-- ==============================
     MODAL SUPPRESSION (unique, hors du foreach)
============================== --}}
<div class="modal fade text-left" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Confirmation de suppression</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Voulez-vous vraiment supprimer le dossier <strong id="modal-label"></strong> ?
                <br>
                <small class="text-muted">Cette action est irréversible.</small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    Annuler
                </button>
                <form id="delete-form" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Injecter dynamiquement l'action du formulaire de suppression
    document.getElementById('modal-delete').addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const id = button.getAttribute('data-id');
        const label = button.getAttribute('data-label');

        document.getElementById('modal-label').textContent = label;
        document.getElementById('delete-form').action = `/dossiers/${id}`;
    });
</script>
@endpush