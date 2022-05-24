@extends('layouts.app')
@section('content') <div class="container">
    <div class="row">
        <div class="col-12 text-center pt-5">
            <h1 class="display-one mt-5">{{ config('app.name') }}</h1>
            <h2>@lang('lang.text_home_main_title')</h2>

            <div class="mt-5">
                @guest
                <h3>@lang('lang.text_home_sub_title')</h3>
                @else
                <a href="{{ route('forum') }}" class="btn btn-outline-primary">@lang('lang.text_home_btn_go')</a>
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection