@extends('base')
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>
                {{ $isAdd ? 'Ajout des Avis' : 'Modification de l\'Avis' }}
            </h3>
            <p class="text-subtitle text-muted"> {{ $isAdd
                    ? 'Remplissez les informations suivantes pour ajouter un nouvel avis.'
                    : 'Modifiez les informations de l’avis.'
                }}</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('anos.index') }}">Liste des Avis</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $isAdd ? 'Ajout un Avis' : 'Modification de l\'Avis' }}
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
                        <form class="form form-vertical" method="POST" action="{{ $isAdd ? route('anos.store') : route('anos.update', $ano->id) }}">
                            @csrf
                            @if (!$isAdd)
                            @method('PUT')
                            @endif
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>
                                                Titre de l'avis
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control @error('avis') is-invalid @enderror"
                                                name="avis"
                                                placeholder="Avis"
                                                value="{{ old('avis', $ano->avis ?? '') }}">

                                            @error('avis')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="form-group mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label">Description de l'avis</label>
                                                <textarea
                                                    class="form-control @error('description') is-invalid @enderror"
                                                    name="description"
                                                    rows="4">{{ old('description', $ano->description ?? '') }}</textarea>
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