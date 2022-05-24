@extends('layouts.app')
@section('content') <div class="container">
    <div class="row">
        <div class="col-12 pt-2">
            <div class="row">
                <div class="col-8">
                    <h1 class="display-one">@lang('lang.text_city_list_title')</h1>
                </div>
            </div>

            @forelse($villes as $ville)
            <ul>
                <li><a href="./ville/{{ $ville->id }}">{{ ucfirst($ville->nom) }}</a></li>
            </ul>
            @empty
            <p class="text-warning">@lang('lang.text_city_no_city')</p>
            @endforelse
        </div>
    </div>
</div>
@endsection