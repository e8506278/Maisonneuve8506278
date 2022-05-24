@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <div class="control-group col-12 d-flex my-2">
                <a href="{{ route('etudiant') }}" class="btn btn-outline-primary">
                    <img class="btn-arrow" src="{{ url('/images/left-arrow.svg') }}" />
                    @lang('lang.text_student_btn_back')
                </a>
            </div>

            @if($msg_retour)
            <div class="alert alert-info alert-dismissible fade show">
                <strong>Info!</strong> {{ $msg_retour }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="my-2 pt-2 pb-4">
                <div class="my-3 text-center">
                    <h1 class="display-one">{{ str_pad($etudiant->id,3,'0',STR_PAD_LEFT) }} - {{ ucfirst($etudiant->nom) }}</h1>
                </div>

                <div class="row">
                    <div class="control-group col-12 d-flex my-3">
                        <label class="col-2" for="adresse">@lang('lang.text_student_address_label'):</label><br>
                        <input type="text" name="adresse" id="adresse" class="form-control col-10" value="{{ $etudiant->adresse }}" readonly>
                    </div>

                    <div class="control-group col-12 d-flex my-3">
                        <label class="col-2" for="phone">@lang('lang.text_student_phone_label'):</label><br>
                        <input type="text" name="phone" id="phone" class="form-control col-10" value="{{ $etudiant->phone }}" readonly>
                    </div>

                    <div class="control-group col-12 d-flex my-3">
                        <label class="col-2" for="email">@lang('lang.text_student_email_label'):</label><br>
                        <input type="text" name="email" id="email" class="form-control col-10" value="{{ $etudiant->email }}" readonly>
                    </div>

                    <div class="control-group col-12 d-flex my-3">
                        <label class="col-2" for="date_naissance">@lang('lang.text_student_birthdate_label'):</label><br>
                        <input type="text" name="date_naissance" id="date_naissance" class="form-control col-10" value="{{ $etudiant->date_naissance }}" readonly>
                    </div>

                    <div class="control-group col-12 d-flex my-3">
                        <label class="col-2" for="ville">@lang('lang.text_student_city_label'):</label><br>
                        <input type="hidden" name="ville_id" id="ville_id" value="{{ $etudiant->ville_id }}" readonly>

                        <select class="ville-select disabled col-10" id="ville_id" name="ville_id" disabled>
                            <option value="0">@lang('lang.text_student_create_city_holder')</option>
                            @forelse($villes as $ville)
                            @if($etudiant->ville_id == $ville->id)
                            <option value="{{ $ville->id }}" selected>{{ $ville->nom }}</option>
                            @else
                            <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                            @endif
                            @empty
                            <option value="0">@lang('lang.text_student_create_no_city')</option>
                            @endforelse
                        </select>
                    </div>
                </div>

                <div class="control-group buttons col-12 my-2 d-flex justify-content-end">
                    <a href="/etudiant/{{ $etudiant->id }}/edit" class="btn btn-primary">@lang('lang.text_student_show_btn_update')</a>

                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        @lang('lang.text_student_show_btn_delete')
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
                <h5 class="modal-title" id="exampleModalLabel">@lang('lang.text_student_show_modal_title')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                @lang('lang.text_student_show_modal_text')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('lang.text_student_show_modal_btn_cancel')</button>
                <form method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">@lang('lang.text_student_show_modal_btn_delete')</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection