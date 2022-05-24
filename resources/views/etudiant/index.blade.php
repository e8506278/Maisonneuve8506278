@extends('layouts.app')
@section('content')
<div class="container my-3">
    @if($msg_retour)
    <div class="alert alert-info alert-dismissible fade show">
        <strong>Info!</strong> {{ $msg_retour }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    <div class="row my-2">
        <div class="col-12 pt-2 d-flex justify-content-between align-items-center">
            <h1 class="d-inline-block">@lang('lang.text_student_list_title')</h1>
            <a href="{{ route('etudiant.create') }}" class="btn btn-outline-primary ms-auto">@lang('lang.text_student_list_btn_add')</a>
        </div>
    </div>

    @forelse($etudiants as $etudiant)
    <div class="row etudiant py-2 d-flex align-items-center">
        <div class="col-lg-12 d-flex justify-content-between">
            <div class="col-lg-10 d-flex">
                <div class="col-lg-4">
                    <div class=" bg-alt">{{ str_pad($etudiant->id,3,'0',STR_PAD_LEFT) }} - {{ ucfirst($etudiant->nom) }}</div>
                </div>

                <div class="col-lg-4">
                    <div>@lang('lang.text_student_email_label'): {{ $etudiant->email }}</div>
                </div>

                <div class="col-lg-4">
                    <div>@lang('lang.text_student_birthdate_label'): {{ $etudiant->date_naissance }}</div>
                </div>
            </div>

            <div class="col-lg-2 d-flex justify-content-end">
                <a href="{{ route('etudiant.show', $etudiant) }}" class="btn btn-outline-primary ms-auto">@lang('lang.text_student_list_btn_more')</a>
            </div>
        </div>
    </div>
    @empty
    <div class="row">
        <div class="col-lg-12">
            <div>@lang('lang.text_student_list_no_student')</div>
        </div>
    </div>
    @endforelse

    {!! $etudiants->links() !!}
</div>
@endsection