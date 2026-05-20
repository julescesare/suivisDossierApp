@extends('base')
@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-12 col-md-6 order-md-1 order-last">
            <h3>
                {{ $isAdd ? 'Ajout des Instructions' : 'Modification de l\'Instruction' }}
            </h3>
            <p class="text-subtitle text-muted"> {{ $isAdd
                    ? 'Remplissez les informations suivantes pour ajouter une nouvelle instruction.'
                    : 'Modifiez les informations de l’instruction.'
                }}</p>
        </div>
        <div class="col-12 col-md-6 order-md-2 order-first">
            <nav aria-label="breadcrumb" class='breadcrumb-header'>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('instructions.index') }}">Liste des Instructions</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $isAdd ? 'Ajout d\'une Instruction' : 'Modification de l\'Instruction' }}
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
                        <form class="form form-vertical" method="POST" action="{{ $isAdd ? route('instructions.store') : route('instructions.update', $instruction->id) }}">
                            @csrf
                            @if (!$isAdd)
                            @method('PUT')
                            @endif
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>
                                                Titre de l'instruction
                                            </label>

                                            <input
                                                type="text"
                                                class="form-control @error('contenu') is-invalid @enderror"
                                                name="contenu"
                                                placeholder="Contenu"
                                                value="{{ old('contenu', $instruction->contenu ?? '') }}">

                                            @error('contenu')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror

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