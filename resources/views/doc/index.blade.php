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
            <h1 class="d-inline-block">@lang('lang.text_doc_list_title')</h1>
            <a href="{{ route('doc.create') }}" class="btn btn-outline-primary btn-r75 ms-auto">@lang('lang.text_doc_list_btn_add')</a>
        </div>
    </div>

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

    {!! $docs->links() !!}
</div>
@endsection