@extends('base')
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>
                {{ $isAdd ? 'Ajout d\'un type de version' : 'Modification du type de version' }}
            </h3>
            <p class="text-subtitle text-muted"> {{ $isAdd
                    ? 'Remplissez les informations suivantes pour ajouter un nouveau type de version.'
                    : 'Modifiez les informations du type de version.'
                }}</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('type_versions.index') }}">Liste des types de versions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $isAdd ? 'Ajout d\'un type de version' : 'Modification du type de version' }}
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
                        <form class="form form-vertical" method="POST" action="{{ $isAdd ? route('type_versions.store') : route('type_versions.update', $typeVersion->id) }}">
                            @csrf
                            @if (!$isAdd)
                            @method('PUT')
                            @endif
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>
                                                Libellé du type de version
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control @error('libelle') is-invalid @enderror"
                                                name="libelle"
                                                placeholder="Libellé"
                                                value="{{ old('libelle', $typeVersion->libelle ?? '') }}">

                                            @error('libelle')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-group mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Description du type de version</label>
                                                <textarea
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    name="description"
                                                    rows="4">{{ old('description', $typeVersion->description ?? '') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">{{ $isAdd? 'Enregistrer': 'Mettre à jour'}}</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Annuler</button>
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
@endsection