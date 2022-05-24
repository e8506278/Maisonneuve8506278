@extends('layouts.app')
@section('content')
<div class="container px-4 mb-5">
    @if($msg_retour)
    <div class="alert alert-info alert-dismissible fade show">
        <strong>Info!</strong> {{ $msg_retour }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="row mt-5">
        <div class="col-12 pt-2 d-flex justify-content-between align-items-center">
            <h1 class="d-inline-block">@lang('lang.text_blog_title')</h1>
            <a href="{{ route('forum.create') }}" class="btn btn-primary ms-auto">@lang('lang.text_blog_add_new')</a>
        </div>
    </div>

    <div class="article-liens-container">
        <hr class="my-4">
        {!! $articles->links() !!}
    </div>

    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div>
            @forelse($articles as $article)
            <!-- L'article -->
            <div class="post-container">
                <div class="post-preview">
                    <h3 class="post-title">{{ $article->titre }}</h3>
                    <p class="post-body">{{ $article->contenu }}</p>
                </div>

                <div class="article-last-row">
                    <p class="post-meta">
                        @lang('lang.text_blog_publisher') <strong>{{ $article->articleHasUser->name }}</strong> @lang('lang.text_blog_published_date') {{ $article->updated_at }}
                    </p>
                    <a href="{{ route('forum.show', $article = $article->id) }}" class="btn btn-outline-primary ms-auto plein-centre">@lang('lang.text_post_create_btn_show')</a>
                </div>
            </div>

            <!-- Séparateur -->
            <hr class="my-4">

            @empty
            <div class="row">
                <div class="col-lg-12">
                    <div>Aucun article trouvé</div>
                </div>
            </div>
            @endforelse

            {!! $articles->links() !!}
        </div>
    </div>
</div>
@endsection