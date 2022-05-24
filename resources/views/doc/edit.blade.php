@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <a href="{{ route('doc.show', $doc) }}" class="btn btn-outline-primary btn-sm mb-3">
                <i class="fas fa-caret-left me-2"></i>
                @lang('lang.text_blog_btn_goback')
            </a>

            @if(Session::get('msg_retour'))
            <div class="alert alert-info alert-dismissible fade show">
                <strong>Info!</strong> {{ Session::get('msg_retour') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="mt-3 pt-2 pb-4">
                <h1 class="display-4">@lang('lang.text_doc_edit_main_title') </h1>
                <p>@lang('lang.text_doc_edit_main_desc')</p>

                <hr>

                <form method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="vieux_titre_en" value="{{ $doc->titre_en }}">
                    <input type="hidden" name="vieux_titre_fr" value="{{ $doc->titre_fr }}">

                    <div class="row">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="english" role="tabpanel" aria-labelledby="home-tab">
                                <div class="control-group col-12 mb-4">
                                    <label for="title">@lang('lang.text_doc_edit_english_title_label')</label>
                                    <input type="text" id="title" class="form-control" name="titre_en" placeholder="@lang('lang.text_doc_edit_english_title_holder')" value="{{ $doc->titre_en }}" required>
                                </div>

                                <div class="control-group col-12 mb-4">
                                    <label for="titre_fr">@lang('lang.text_doc_edit_french_title_label')</label>
                                    <input type="text" id="titre_fr" class="form-control" name="titre_fr" placeholder="@lang('lang.text_doc_edit_french_title_holder')" value="{{ $doc->titre_fr }}" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="control-group buttons col-12 my-2 d-flex justify-content-end">
                        <button id="btn-submit" class="btn btn-primary">
                            @lang('lang.text_doc_edit_btn_update')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection