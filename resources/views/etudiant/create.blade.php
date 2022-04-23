@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <div class="control-group col-12 d-flex my-5">
                <a href="/etudiant" class="btn btn-outline-primary">
                    <img class="btn-arrow" src="{{ url('/images/left-arrow.svg') }}" />
                    Retour à la liste des étudiants inscrits
                </a>
            </div>

            <div class="my-5 pl-4 pr-4 pt-4 pb-4">
                <div class="my-3 text-center">
                    <h1 class="display-4">Créer un nouvel étudiant</h1>
                    <h2>Remplissez tous les champs et cliquez sur Créer l'étudiant</h2>
                </div>

                <form class="form-horizontal" method="POST">
                    @csrf

                    <div class="row">
                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="nom">Nom:</label><br>
                            <input type="text" name="nom" id="nom" class="form-control col-10" placeholder="Entrer le nom de l'étudiant" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="adresse">Adresse:</label><br>
                            <input type="text" name="adresse" id="adresse" class="form-control col-10" placeholder="Entrer l'adresse" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="phone">Téléphone:</label><br>
                            <input type="text" name="phone" id="phone" class="form-control col-10" placeholder="Entrer le numéro de téléphone" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="email">Courriel:</label><br>
                            <input type="text" name="email" id="email" class="form-control col-10" placeholder="Entrer le courriel" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="date_naissance">Date de naissance:</label><br>
                            <input type="text" name="date_naissance" id="date_naissance" class="form-control col-10" placeholder="Entrer la date de naissance" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="ville_id">Ville:</label><br>

                            <select class="form-select col-10" id="ville_id" name="ville_id">
                                <option value="0">Sélectionner la ville</option>
                                @forelse($villes as $ville)
                                <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                                @empty
                                <option value="0">Aucune ville trouvée</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="control-group buttons col-12 d-flex my-5">
                        <button id="btn-submit" class="btn btn-primary">
                            Créer l'étudiant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection