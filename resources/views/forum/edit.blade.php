@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <a href="{{ route('forum.show', $article) }}" class="btn btn-outline-primary btn-sm mb-3">

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
                <h1 class="display-4">@lang('lang.text_post_edit_main_title') </h1>
                <p>@lang('lang.text_post_edit_main_desc')</p>

                <hr>

                <form method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <ul class="nav nav-tabs my-4" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#english" type="button" role="tab" aria-controls="home" aria-selected="true">@lang('lang.text_post_message_tab_en')</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#french" type="button" role="tab" aria-controls="profile" aria-selected="false">@lang('lang.text_post_message_tab_fr')</button>
                            </li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="english" role="tabpanel" aria-labelledby="home-tab">
                                <div class="control-group col-12 mb-4">
                                    <label for="title">@lang('lang.text_post_message_title_label')</label>
                                    <input type="text" id="title" class="form-control" name="titre_en" placeholder="@lang('lang.text_post_message_title_holder')" value="{{ $article->titre_en }}" required>
                                </div>

                                <div class="control-group col-12 mb-4">
                                    <label for="body">@lang('lang.text_post_message_body_label')</label>
                                    <textarea id="body" class="form-control" name="contenu_en" placeholder="@lang('lang.text_post_message_body_holder')" rows="" required>{{ $article->contenu_en }}</textarea>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="french" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="control-group col-12 mb-4">
                                    <label for="titre_fr">@lang('lang.text_post_message_title_label')</label>
                                    <input type="text" id="titre_fr" class="form-control" name="titre_fr" placeholder="@lang('lang.text_post_message_title_holder')" value="{{ $article->titre_fr }}" required>
                                </div>

                                <div class="control-group col-12 mb-4">
                                    <label for="contenu_fr">@lang('lang.text_post_message_body_label')</label>
                                    <textarea id="contenu_fr" class="form-control" name="contenu_fr" placeholder="@lang('lang.text_post_message_body_holder')" required>{{ $article->contenu_fr }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="control-group buttons col-12 my-2 d-flex justify-content-end">
                        <button id="btn-submit" class="btn btn-primary">
                            @lang('lang.text_post_edit_btn_update')
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection