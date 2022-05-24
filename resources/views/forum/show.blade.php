@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <div class="btn-container btn-split">
                @if($referer)
                <a href="{{ $referer }}" class="btn btn-outline-primary btn-sm plein-centre">
                    <i class="fas fa-caret-left me-2"></i>
                    @lang('lang.text_blog_btn_goback')
                </a>
                @else
                <a href="{{ route('forum') }}" class="btn btn-outline-primary btn-sm plein-centre">
                    <i class="fas fa-caret-left me-2"></i>
                    @lang('lang.text_blog_btn_goback')
                </a>
                @endif
            </div>

            <div class="post-dates-container stay-in-a-box mt-4 p-3">
                <p class="m-0">@lang('lang.text_post_show_created_at') <span>: {{ $article->created_at }}</span></p>
                <p class="m-0">@lang('lang.text_post_show_created_by') <span>: <strong>{{ $article->articleHasUser->name }}</strong></span></p>
                <p class="m-0">@lang('lang.text_post_show_updated_at') <span>: {{ $article->updated_at }}</span></p>
            </div>

            <div class="post-preview stay-in-a-box my-4 p-3">
                <h2 class="post-header">@lang('lang.text_post_show_english_title')</h2>
                <hr>
                <h3 class="post-title">{{ ucfirst($article->titre_en) }}</h3>
                <textarea id="body" class="form-control" name="contenu_en" placeholder="Enter message body" rows="" required>{!! $article->contenu_en !!}</textarea>
            </div>

            <div class="post-preview stay-in-a-box my-4 p-3">
                <h2 class="post-header">@lang('lang.text_post_show_french_title')</h2>
                <hr>
                <h3 class="post-title">{{ ucfirst($article->titre_fr) }}</h3>
                <textarea id="body" class="form-control" name="contenu_fr" placeholder="Enter message body" rows="" required>{!! $article->contenu_fr !!}</textarea>
            </div>

            @if(auth()->user()->id == $article->articleHasUser->id)
            <div class="control-group buttons col-12 my-2 d-flex justify-content-end">
                <a href="{{ route('forum.edit', $article) }}" class="btn btn-outline-primary">@lang('lang.text_post_show_btn_update')</a>

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    @lang('lang.text_post_show_btn_delete')
                </button>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title" id="exampleModalLabel">@lang('lang.text_post_show_modal_title')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @lang('lang.text_post_show_modal_text')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('lang.text_post_show_modal_btn_cancel')</button>
                <form method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">@lang('lang.text_post_show_btn_delete')</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection