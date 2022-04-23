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

            @if($msg_retour)
            <div class="alert alert-info alert-dismissible fade show">
                <strong>Info!</strong> {{ $msg_retour }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="my-5 pl-4 pr-4 pt-4 pb-4">
                <div class="my-3 text-center">
                    <h1 class="display-one">{{ str_pad($etudiant->id,3,'0',STR_PAD_LEFT) }} - {{ ucfirst($etudiant->nom) }}</h1>
                </div>

                <div class="row">
                    <div class="control-group col-12 d-flex my-3">
                        <label class="col-2" for="adresse">Adresse:</label><br>
                        <input type="text" name="adresse" id="adresse" class="form-control col-10" value="{{ $etudiant->adresse }}" readonly>
                    </div>

                    <div class="control-group col-12 d-flex my-3">
                        <label class="col-2" for="phone">Téléphone:</label><br>
                        <input type="text" name="phone" id="phone" class="form-control col-10" value="{{ $etudiant->phone }}" readonly>
                    </div>

                    <div class="control-group col-12 d-flex my-3">
                        <label class="col-2" for="email">Courriel:</label><br>
                        <input type="text" name="email" id="email" class="form-control col-10" value="{{ $etudiant->email }}" readonly>
                    </div>

                    <div class="control-group col-12 d-flex my-3">
                        <label class="col-2" for="date_naissance">Date de naissance:</label><br>
                        <input type="text" name="date_naissance" id="date_naissance" class="form-control col-10" value="{{ $etudiant->date_naissance }}" readonly>
                    </div>

                    <div class="control-group col-12 d-flex my-3">
                        <label class="col-2" for="ville">Ville:</label><br>
                        <input type="hidden" name="ville_id" id="ville_id" value="{{ $etudiant->ville_id }}" readonly>

                        <select class="ville-select disabled col-10" id="ville_id" name="ville_id" disabled>
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
                    <a href="/etudiant/{{ $etudiant->id }}/edit" class="btn btn-primary">Modifier l'étudiant</a>

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Supprimer l'étudiant
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                Êtes-vous certain de vouloir supprimer cet étudiant?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <form method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection