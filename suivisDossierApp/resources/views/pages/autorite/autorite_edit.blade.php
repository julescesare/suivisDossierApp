@extends('base')
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>
                {{ $isAdd ? 'Ajout des Autorités' : 'Modification de l\'Autorité' }}
            </h3>
            <p class="text-subtitle text-muted"> {{ $isAdd
                    ? 'Remplissez les informations suivantes pour ajouter une nouvelle autorité.'
                    : 'Modifiez les informations de l\'autorité.'
                }}</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('autorites.index') }}">Liste des Autorités</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $isAdd ? 'Ajout d\'une Autorité' : 'Modification de l\'Autorité' }}
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
                        <form class="form form-vertical" method="POST" action="{{ $isAdd ? route('autorites.store') : route('autorites.update', $autorite->id) }}">
                            @csrf
                            @if (!$isAdd)
                            @method('PUT')
                            @endif
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>
                                                Nom de l'autorité
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control @error('nom') is-invalid @enderror"
                                                name="nom"
                                                placeholder="Nom"
                                                value="{{ old('nom', $autorite->nom ?? '') }}">

                                            @error('nom')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>
                                                Telephone de l'autorité
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control @error('telephone') is-invalid @enderror"
                                                name="telephone"
                                                placeholder="Telephone"
                                                value="{{ old('telephone', $autorite->telephone ?? '') }}">

                                            @error('telephone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>
                                                Email de l'autorité
                                            </label>

                                            <input
                                                type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                name="email"
                                                placeholder="Email"
                                                value="{{ old('email', $autorite->email ?? '') }}">

                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-group mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Description de l'autorité</label>
                                                <textarea
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    name="description"
                                                    rows="4">{{ old('description', $autorite->description ?? '') }}</textarea>
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