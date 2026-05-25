@extends('base')
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>
                {{ $isAdd ? 'Ajout d\'un statut' : 'Modification du statut' }}
            </h3>
            <p class="text-subtitle text-muted">
                {{ $isAdd
                    ? 'Remplissez les informations suivantes pour ajouter un nouveau statut.'
                    : 'Modifiez les informations du statut.'
                }}
            </p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class="breadcrumb-header">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('statuts.index') }}">Liste des statuts</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $isAdd ? 'Ajout d\'un statut' : 'Modification du statut' }}
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<section id="basic-vertical-layouts">
    <div class="row match-height justify-content-center">
        <div class="col-md-10 col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form
                            class="form form-vertical"
                            method="POST"
                            action="{{ $isAdd ? route('statuts.store') : route('statuts.update', $statut->id) }}">
                            @csrf
                            @if(!$isAdd)
                            @method('PUT')
                            @endif

                            <div class="form-body">
                                <div class="row">

                                    {{-- LIBELLÉ --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Libellé du statut</label>
                                            <input
                                                type="text"
                                                class="form-control @error('libelle') is-invalid @enderror"
                                                name="libelle"
                                                placeholder="Libellé"
                                                value="{{ old('libelle', $statut->libelle ?? '') }}">
                                            @error('libelle')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- DESCRIPTION --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Description du statut</label>
                                            <textarea
                                                class="form-control @error('description') is-invalid @enderror"
                                                name="description"
                                                rows="4">{{ old('description', $statut->description ?? '') }}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- SÉLECTEUR COULEUR --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Couleur du statut</label>

                                            @error('couleur')
                                            <div class="alert alert-danger py-1 px-2 mb-2">{{ $message }}</div>
                                            @enderror

                                            <input
                                                type="hidden"
                                                name="couleur"
                                                id="couleur-input"
                                                value="{{ old('couleur', $statut->couleur->value ?? '') }}">

                                            <div class="d-flex flex-wrap gap-2 mb-3">
                                                @foreach($couleurs as $couleur)
                                                @if($couleur->value !== 'custom')
                                                <div
                                                    class="couleur-option rounded"
                                                    data-value="{{ $couleur->value }}"
                                                    title="{{ $couleur->label() }}"
                                                    style="width:40px; height:40px; background-color:{{ $couleur->hex() }}; cursor:pointer; border:3px solid transparent; transition:border 0.2s;">
                                                </div>
                                                @endif
                                                @endforeach

                                                <div
                                                    class="couleur-option rounded"
                                                    data-value="custom"
                                                    title="Couleur personnalisée"
                                                    style="width:40px; height:40px; cursor:pointer; border:3px solid transparent; background:linear-gradient(135deg,#f00,#0f0,#00f); transition:border 0.2s;">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <small class="text-muted d-block mb-1">Aperçu :</small>
                                                <span id="badge-preview" class="badge fs-6" style="min-width:80px;">
                                                    {{ old('libelle', $statut->libelle ?? 'Statut') }}
                                                </span>
                                            </div>

                                            <div id="custom-color-wrapper" style="display:none;">
                                                <label>Code couleur personnalisé</label>
                                                <div class="d-flex align-items-center gap-2">
                                                    <input
                                                        type="color"
                                                        id="color-picker"
                                                        class="form-control form-control-color"
                                                        value="{{ old('couleur_hex', $statut->couleur_hex ?? '#000000') }}"
                                                        style="width:60px; height:40px; padding:2px;">
                                                    <input
                                                        type="text"
                                                        name="couleur_hex"
                                                        id="couleur-hex-input"
                                                        class="form-control @error('couleur_hex') is-invalid @enderror"
                                                        placeholder="#000000"
                                                        value="{{ old('couleur_hex', $statut->couleur_hex ?? '') }}"
                                                        maxlength="7"
                                                        style="width:120px;">
                                                    @error('couleur_hex')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- BOUTONS --}}
                                    <div class="col-12 d-flex justify-content-end mt-2">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">
                                            {{ $isAdd ? 'Enregistrer' : 'Mettre à jour' }}
                                        </button>
                                        <a href="{{ route('statuts.index') }}" class="btn btn-light-secondary me-1 mb-1">
                                            Annuler
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection {{-- ← ICI, avant @push --}}

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const couleurHexMap = {
            @foreach($couleurs as $couleur)
            '{{ $couleur->value }}': '{{ $couleur->hex() }}',
            @endforeach
        };

        const options = document.querySelectorAll('.couleur-option');
        const input = document.getElementById('couleur-input');
        const hexInput = document.getElementById('couleur-hex-input');
        const colorPicker = document.getElementById('color-picker');
        const preview = document.getElementById('badge-preview');
        const customWrapper = document.getElementById('custom-color-wrapper');
        const libelleInput = document.querySelector('input[name="libelle"]');

        console.log('options trouvées :', options.length);

        function isLightColor(hex) {
            if (!hex || hex.length < 7) return false;
            const r = parseInt(hex.slice(1, 3), 16);
            const g = parseInt(hex.slice(3, 5), 16);
            const b = parseInt(hex.slice(5, 7), 16);
            return (r * 299 + g * 587 + b * 114) / 1000 > 128;
        }

        function updatePreviewWithHex(hex) {
            preview.className = 'badge fs-6';
            preview.style.cssText = '';
            preview.style.backgroundColor = hex;
            preview.style.color = isLightColor(hex) ? '#000' : '#fff';
            preview.style.minWidth = '80px';
        }

        function selectCouleur(value) {
            if (!value) return;

            input.value = value;
            console.log('couleur sélectionnée :', value);

            options.forEach(opt => {
                opt.style.border = opt.dataset.value === value ?
                    '3px solid #000' :
                    '3px solid transparent';
            });

            if (value === 'custom') {
                customWrapper.style.display = 'block';
                updatePreviewWithHex(hexInput.value || '#000000');
            } else {
                customWrapper.style.display = 'none';
                preview.style.cssText = '';
                preview.className = `badge fs-6 bg-${value}`;
                preview.style.minWidth = '80px';
            }
        }

        options.forEach(function(opt) {
            opt.addEventListener('click', function() {
                selectCouleur(this.dataset.value);
            });
        });

        colorPicker.addEventListener('input', function() {
            hexInput.value = this.value;
            updatePreviewWithHex(this.value);
        });

        hexInput.addEventListener('input', function() {
            if (/^#[0-9A-Fa-f]{6}$/.test(this.value)) {
                colorPicker.value = this.value;
                updatePreviewWithHex(this.value);
            }
        });

        if (libelleInput) {
            libelleInput.addEventListener('input', function() {
                preview.textContent = this.value || 'Statut';
            });
        }

        // Initialisation
        const initialValue = input.value;
        if (initialValue) {
            selectCouleur(initialValue);
        }
    });
</script>
@endpush