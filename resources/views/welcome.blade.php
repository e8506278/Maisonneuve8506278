@extends('layouts.app')
@section('content') <div class="container">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <h1 class="display-one mt-5">{{ config('app.name') }}</h1>
            <h2>Le réseau social des étudiants du Collège Maisonneuve</h2>
            <br>
            <a href="/etudiant" class="btn btn-outline-primary">Afficher la liste des étudiants</a>
        </div>
    </div>
</div>
@endsection