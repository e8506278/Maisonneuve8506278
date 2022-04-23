@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <div class="control-group col-12 d-flex my-5">
                <a href="/etudiant/{{ $etudiant->id }}" class="btn btn-outline-primary">
                    <img class="btn-arrow" src="{{ url('/images/left-arrow.svg') }}" />
                    Retour à l'étudiant
                </a>
            </div>

            <div class="my-5 pl-4 pr-4 pt-4 pb-4">
                <div class="my-3 text-center">
                    <h1 class="display-4">Modifier un étudiant existant</h1>
                    <h2>Modifiez les informations voulues et cliquez sur Mettre à jour.</h2>
                </div>

                <form method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="id">Identifiant:</label><br>
                            <input type="text" name="" id="id" class="form-control col-10" placeholder="Identifiant de l'étudiant" value="{{ str_pad($etudiant->id,3,'0',STR_PAD_LEFT) }}" readonly>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="nom">Nom:</label><br>
                            <input type="text" name="nom" id="nom" class="form-control col-10" placeholder="Entrer le nom de l'étudiant" value="{{ $etudiant->nom }}" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="adresse">Adresse:</label><br>
                            <input type="text" name="adresse" id="adresse" class="form-control col-10" placeholder="Entrer l'adresse" value="{{ $etudiant->adresse }}" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="phone">Téléphone:</label><br>
                            <input type="text" name="phone" id="phone" class="form-control col-10" placeholder="Entrer le numéro de téléphone" value="{{ $etudiant->phone }}" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="email">Courriel:</label><br>
                            <input type="text" name="email" id="email" class="form-control col-10" placeholder="Entrer le courriel" value="{{ $etudiant->email }}" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="date_naissance">Date de naissance:</label><br>
                            <input type="text" name="date_naissance" id="date_naissance" class="form-control col-10" placeholder="Entrer la date de naissance" value="{{ $etudiant->date_naissance }}" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="ville_id">Ville:</label><br>

                            <select class="form-select col-10" id="ville_id" name="ville_id">
                                <option value="0">Sélectionner la ville</option>
                                @forelse($villes as $ville)
                                @if($etudiant->ville_id == $ville->id)
                                <option value="{{ $ville->id }}" selected>{{ $ville->nom }}</option>
                                @else
                                <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                                @endif
                                @empty
                                <option value="0">Aucune ville trouvée</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="control-group buttons col-12 d-flex my-5">
                        <button id="btn-submit" class="btn btn-primary">
                            Mette à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection