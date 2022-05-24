@extends('layouts.app')
@section('content')
<div class="container mb-5">
    <div class="row">
        <div class="col-12 pt-2">
            @if($msg_retour)
            <div class="alert alert-info alert-dismissible fade show">
                <strong>Info!</strong> {{ $msg_retour }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="my-3 p-4 stay-in-a-box">
                <div class="my-3 title">
                    <h1 class="display-one">@lang('lang.text_dashboard_user_info')</h1>

                    <div class="control-group buttons d-flex mt-3">
                        <a href="/etudiant/{{ $etudiant->id }}/edit" class="btn btn-primary">@lang('lang.text_dashboard_post_btn_update')</a>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="control-group col-12 d-flex my-3">
                        <label class="col-2" for="adresse">@lang('lang.text_dashboard_user_address'):</label><br>
                        <input type="text" name="adresse" id="adresse" class="form-control col-10" value="{{ $etudiant->adresse }}" readonly>
                    </div>

                    <div class="control-group col-12 d-flex my-3">
                        <label class="col-2" for="phone">@lang('lang.text_dashboard_user_phone'):</label><br>
                        <input type="text" name="phone" id="phone" class="form-control col-10" value="{{ $etudiant->phone }}" readonly>
                    </div>

                    <div class="control-group col-12 d-flex my-3">
                        <label class="col-2" for="email">@lang('lang.text_dashboard_user_email'):</label><br>
                        <input type="text" name="email" id="email" class="form-control col-10" value="{{ $etudiant->email }}" readonly>
                    </div>

                    <div class="control-group col-12 d-flex my-3">
                        <label class="col-2" for="date_naissance">@lang('lang.text_dashboard_user_birthdate'):</label><br>
                        <input type="text" name="date_naissance" id="date_naissance" class="form-control col-10" value="{{ $etudiant->date_naissance }}" readonly>
                    </div>

                    <div class="control-group col-12 d-flex my-3">
                        <label class="col-2" for="ville">@lang('lang.text_dashboard_user_city'):</label><br>
                        <input type="hidden" name="ville_id" id="ville_id" value="{{ $etudiant->ville_id }}" readonly>

                        <select class="ville-select disabled col-10" id="ville_id" name="ville_id" disabled>
                            <option value="0">@lang('lang.text_dashboard_user_city_holder')</option>
                            @forelse($villes as $ville)
                            @if($etudiant->ville_id == $ville->id)
                            <option value="{{ $ville->id }}" selected>{{ $ville->nom }}</option>
                            @else
                            <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                            @endif
                            @empty
                            <option value="0">@lang('lang.text_dashboard_user_no_city')</option>
                            @endforelse
                        </select>
                    </div>
                </div>
            </div>

            <div class="my-3 p-4 stay-in-a-box">
                <div class="my-3 title">
                    <h1 class="display-one">@lang('lang.text_dashboard_user_posts')</h1>

                    <div class="control-group buttons d-flex mt-3">
                        <a href="{{ route('forum.create') }}" class="btn btn-primary">@lang('lang.text_blog_add_new')</a>
                    </div>
                </div>

                <hr>

                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div>
                        @forelse($articles as $article)
                        <!-- L'article -->
                        <div class="my-2 p-2 stay-in-a-box">
                            <div class="items-1-row">
                                <div class="post-mini-preview post-dates-container">
                                    <p>@lang('lang.text_dashboard_post_created_at') :</p>
                                    <p class="post-title">{{ $article->created_at }}</p>
                                </div>

                                <div class="article-date-btn">
                                    <div class="post-mini-preview post-dates-container">
                                        <p>@lang('lang.text_dashboard_post_updated_at') :</p>
                                        <p class="post-title">{{ $article->updated_at }}</p>
                                    </div>

                                    <div class="btn-container">
                                        <a href="{{ route('forum.show', $article_id = $article->id) }}" class="btn btn-outline-primary plein-centre">@lang('lang.text_post_create_btn_show')</a>
                                    </div>
                                </div>
                            </div>
                            <div class="post-one-line">
                                <div class="post-mini-preview">
                                    <p>@lang('lang.text_dashboard_post_english_title') :</p>
                                    <p class="post-title"><strong>{{ $article->titre_en }}</strong></p>
                                </div>
                                <div class="post-mini-preview">
                                    <p>@lang('lang.text_dashboard_post_french_title') :</p>
                                    <p class="post-title"><strong>{{ $article->titre_fr }}</strong></p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="row">
                            <div class="col-lg-12">
                                <div>@lang('lang.text_dashboard_user_no_post')</div>
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="my-3 p-4 stay-in-a-box">
                <div class="my-3 title">
                    <h1 class="d-inline-block">@lang('lang.text_dashboard_user_docs')</h1>

                    <div class="control-group buttons d-flex mt-3">
                        <a href="{{ route('doc.create') }}" class="btn btn-primary">@lang('lang.text_doc_list_btn_add')</a>
                    </div>
                </div>

                <hr>

                <div class="my-2 p-2 stay-in-a-box">
                    @forelse($docs as $doc)
                    <div class="row fichier py-2 mt-2 d-flex align-items-center">
                        <div>
                            <div class="items-1-row">
                                <div class="post-mini-preview post-dates-container">
                                    <p class="document-info">@lang('lang.text_dashboard_post_english_title') :</p>
                                    <p><strong>{{ $doc->titre_en }}</strong></p>
                                </div>

                                <div class="article-date-btn">
                                    <div class="post-mini-preview post-dates-container">
                                        <p class="document-info">@lang('lang.text_dashboard_post_french_title') :</p>
                                        <p><strong>{{ $doc->titre_fr }}</strong></p>
                                    </div>

                                    <div class="btn-container">
                                        <a href="{{ route('doc.show', $doc->id) }}" class="btn btn-outline-primary ms-auto">@lang('lang.text_doc_list_btn_more')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="row">
                        <div class="col-lg-12">
                            <div>@lang('lang.text_doc_list_no_doc')</div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection