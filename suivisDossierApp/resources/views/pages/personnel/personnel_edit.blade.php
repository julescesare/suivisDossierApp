@extends('base')
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>
                {{ $isAdd ? 'Ajout des personnels' : 'Modification du personnel' }}
            </h3>
            <p class="text-subtitle text-muted"> {{ $isAdd
                    ? 'Remplissez les informations suivantes pour ajouter un nouveau personnel.'
                    : 'Modifiez les informations du personnel.'
                }}</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('personnels.index') }}">Liste des Personnels</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $isAdd ? 'Ajout d\'un Personnel' : 'Modification du Personnel' }}
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
                        <form class="form form-vertical" method="POST" action="{{ $isAdd ? route('personnels.store') : route('personnels.update', $personnel->id) }}">
                            @csrf
                            @if (!$isAdd)
                            @method('PUT')
                            @endif
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>
                                                Nom du personnel
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control @error('nom') is-invalid @enderror"
                                                name="nom"
                                                placeholder="Nom"
                                                value="{{ old('nom', $personnel->nom ?? '') }}">

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
                                                Prénom du personnel
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control @error('prenom') is-invalid @enderror"
                                                name="prenom"
                                                placeholder="Prénom"
                                                value="{{ old('prenom', $personnel->prenom ?? '') }}">

                                            @error('prenom')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>
                                                Téléphone du personnel
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control @error('telephone') is-invalid @enderror"
                                                name="telephone"
                                                placeholder="Telephone"
                                                value="{{ old('telephone', $personnel->telephone ?? '') }}">

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
                                                Email du personnel
                                            </label>

                                            <input
                                                type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                name="email"
                                                placeholder="Email"
                                                value="{{ old('email', $personnel->email ?? '') }}">

                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">

                                            <label>
                                                Fonction du personnel
                                            </label>
                                            <div class="form-group">
                                                <select class="choices form-select" name="fonction_id"
                                                    class="choices form-select @error('fonction_id') is-invalid @enderror">

                                                    @foreach($fonctions as $fonction)
                                                    <option value="{{ $fonction->id }}" {{ old('fonction_id') == $fonction->id ? 'selected' : '' }}>
                                                        {{ $fonction->nom }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('fonction_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
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