@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <div class="btn-container btn-split">
                @if($referer)
                <a href="{{ $referer }}" class="btn btn-outline-primary btn-sm plein-centre">
                    <i class="fas fa-caret-left me-2"></i>
                    @lang('lang.text_student_btn_back')
                </a>
                @else
                <a href="{{ route('etudiant.show', $etudiant) }}" class="btn btn-outline-primary btn-sm plein-centre">
                    <i class="fas fa-caret-left me-2"></i>
                    @lang('lang.text_student_btn_back')
                </a>
                @endif
            </div>

            <div class="my-2 pt-2 pb-4">
                <div class="my-3 text-center">
                    <h1 class="display-4">@lang('lang.text_student_update_main_title')</h1>
                    <h2>@lang('lang.text_student_update_sub_title')</h2>
                </div>

                <form method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="id">@lang('lang.text_student_id_label'):</label><br>
                            <input type="text" name="" id="id" class="form-control col-10" placeholder="@lang('lang.text_student_id_holder')" value="{{ str_pad($etudiant->id,3,'0',STR_PAD_LEFT) }}" readonly>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="nom">@lang('lang.text_student_name_label'):</label><br>
                            <input type="text" name="nom" id="nom" class="form-control col-10" placeholder="@lang('lang.text_student_name_holder')" value="{{ $etudiant->nom }}" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="adresse">@lang('lang.text_student_address_label'):</label><br>
                            <input type="text" name="adresse" id="adresse" class="form-control col-10" placeholder="@lang('lang.text_student_address_holder')" value="{{ $etudiant->adresse }}" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="phone">@lang('lang.text_student_phone_label'):</label><br>
                            <input type="text" name="phone" id="phone" class="form-control col-10" placeholder="@lang('lang.text_student_phone_holder')" value="{{ $etudiant->phone }}" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="email">@lang('lang.text_student_email_label'):</label><br>
                            <input type="text" name="email" id="email" class="form-control col-10" placeholder="@lang('lang.text_student_email_holder')" value="{{ $etudiant->email }}" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="date_naissance">@lang('lang.text_student_birthdate_label'):</label><br>
                            <input type="text" name="date_naissance" id="date_naissance" class="form-control col-10" placeholder="@lang('lang.text_student_birthdate_holder')" value="{{ $etudiant->date_naissance }}" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="ville_id">@lang('lang.text_student_city_label'):</label><br>

                            <select class="form-select col-10" id="ville_id" name="ville_id">
                                <option value="0">@lang('lang.text_student_update_city_holder')</option>
                                @forelse($villes as $ville)
                                @if($etudiant->ville_id == $ville->id)
                                <option value="{{ $ville->id }}" selected>{{ $ville->nom }}</option>
                                @else
                                <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                                @endif
                                @empty
                                <option value="0">@lang('lang.text_student_update_no_city')</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="control-group buttons col-12 my-2 d-flex justify-content-end">
                        <button id="btn-submit" class="btn btn-primary">
                            @lang('lang.text_student_update_btn_update')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection