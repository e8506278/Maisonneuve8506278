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

            <div class="my-2 pt-2 pb-4">
                <div class="my-3 text-center">
                    <h1 class="display-4">@lang('lang.text_student_create_main_title')</h1>
                    <h2>@lang('lang.text_student_create_sub_title')</h2>
                </div>

                <form class="form-horizontal" method="POST">
                    @csrf

                    <div class="row">
                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="nom">@lang('lang.text_student_name_label'):</label><br>
                            <input type="text" name="nom" id="nom" class="form-control col-10" placeholder="@lang('lang.text_student_name_holder')" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="adresse">@lang('lang.text_student_address_label'):</label><br>
                            <input type="text" name="adresse" id="adresse" class="form-control col-10" placeholder="@lang('lang.text_student_address_holder')" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="phone">@lang('lang.text_student_phone_label'):</label><br>
                            <input type="text" name="phone" id="phone" class="form-control col-10" placeholder="@lang('lang.text_student_phone_holder')" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="email">@lang('lang.text_student_email_label'):</label><br>
                            <input type="text" name="email" id="email" class="form-control col-10" placeholder="@lang('lang.text_student_email_holder')" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="date_naissance">@lang('lang.text_student_birthdate_label'):</label><br>
                            <input type="text" name="date_naissance" id="date_naissance" class="form-control col-10" placeholder="@lang('lang.text_student_birthdate_holder')" required>
                        </div>

                        <div class="control-group col-12 d-flex my-3">
                            <label class="col-2" for="ville_id">@lang('lang.text_student_city_label'):</label><br>

                            <select class="form-select col-10" id="ville_id" name="ville_id">
                                <option value="0">@lang('lang.text_student_create_city_holder')</option>
                                @forelse($villes as $ville)
                                <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                                @empty
                                <option value="0">@lang('lang.text_student_create_no_city')</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <div class="control-group buttons col-12 my-2 d-flex flex-row-reverse">
                        <button id="btn-submit" class="btn btn-primary">
                            @lang('lang.text_student_create_btn_create')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection