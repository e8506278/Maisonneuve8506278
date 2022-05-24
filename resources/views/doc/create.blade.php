@extends('layouts.app')
@section('content')
<div class="container">
    <div class="btn-container btn-split">
        @if($referer)
        <a href="{{ $referer }}" class="btn btn-outline-primary btn-sm plein-centre">
            <i class="fas fa-caret-left me-2"></i>
            @lang('lang.text_blog_btn_goback')
        </a>
        @else
        <a href="{{ route('doc') }}" class="btn btn-outline-primary btn-sm plein-centre">
            <i class="fas fa-caret-left me-2"></i>
            @lang('lang.text_blog_btn_goback')
        </a>
        @endif
    </div>

    <div class="row">
        <div class="my-5 p-4 stay-in-a-box">
            <ul class="consignes-fichier">
                <li>@lang('lang.text_doc_select_main_title')</li>
                <li>@lang('lang.text_doc_select_sub_title')</li>
                <li>@lang('lang.text_doc_select_main_info')</li>
            </ul>
        </div>
    </div>

    <div class="erreurs-container" data-js-err-container>
        @foreach($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endforeach
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="documents-container my-3 hide" data-js-langue-info>
        <span data-js-lang-label-en>@lang('lang.text_doc_select_label_en')</span>
        <span data-js-lang-label-fr>@lang('lang.text_doc_select_label_fr')</span>
        <span data-js-lang-btn-delete>@lang('lang.text_doc_select_btn_delete')</span>
    </div>

    <!-- <form method="post" action="{{route('doc.store')}}" enctype="multipart/form-data"> -->
    <form id="formElem">
        @csrf

        <div class="documents-group-btn mr-3">
            <div class="cacher-montrer">
                <p class="pas-la m-0">@lang('lang.text_doc_select_add_info')</p>
                <button type="submit" class="est-la btn btn-primary" data-js-btn-soumettre>@lang('lang.text_doc_select_btn_submit')</button>
            </div>

            <button class="btn btn-success btn-ajouter" data-js-btn-ajouter="ajouter">@lang('lang.text_doc_select_btn_add')</button>
        </div>

        <div class="documents-container my-3" data-js-container></div>
    </form>
</div>

<script type="text/javascript">
    // Ajout d'une section qui permet d'ajouter un fichier
    let pos = 0;

    $('.pas-la').show();
    $('.est-la').hide();

    $("[data-js-btn-ajouter]").click(function(e) {
        e.preventDefault();

        let newFileSelection = `
            <div class="document-select-container my-3 p-2">
                <div class="document-select-group">
                    <input type="file" name="doc[pos][docname]" class="form-control" accept="application/pdf, application/zip, application/msword">
                </div>

                <div class="document-select-group">
                    <div class="document-select-item">
                        <label for="titre_en">[label-en]</label>
                        <input type="text" name="doc[pos][titre_en]" id="titre_en" value="{{ old('doc[pos][titre_en]') }}">
                    </div>

                    <div class="document-select-item">
                        <label for="titre_fr">[label-fr]</label>
                        <input type="text" name="doc[pos][titre_fr]" id="titre_fr" value="{{ old('doc[pos][titre_fr]') }}">
                    </div>

                    <div class="input-group-btn">
                        <button id="supprimer_[pos]" class="btn btn-danger" data-js-btn-supprimer>[Supprimer]</button>
                    </div>
                </div>
            </div>
        `;

        const textToReplace = newFileSelection;
        ++pos;

        let newText = textToReplace.replace(/\[pos\]/g, "[" + pos + "]");
        newText = newText.replace(/\[label-en\]/g, $("[data-js-lang-label-en]").text());
        newText = newText.replace(/\[label-fr\]/g, $("[data-js-lang-label-fr]").text());
        newText = newText.replace(/\[Supprimer\]/g, $("[data-js-lang-btn-delete]").text());

        $('[data-js-container]').append(newText);
        $('.pas-la').hide();
        $('.est-la').show();
    });

    $('.documents-container').on('click', '[data-js-btn-supprimer]', function() {
        const parent = $(this).parents(".document-select-container");
        parent.remove();

        const nbFound = $(".document-select-container").length;

        if (nbFound == 0) {
            $('.pas-la').show();
            $('.est-la').hide();
        }
    });

    // Validation des données entrées
    const formElem = document.querySelector('#formElem');

    formElem.onsubmit = async (e) => {
        e.preventDefault();

        formData = new FormData(formElem);

        for (var value of formData.values()) {
            console.log(value);
        }

        let response = await fetch("{{ route('doc.store') }}", {
            method: 'POST',
            body: formData
        });

        let result = await response.json(),
            errContainer = document.querySelector('[data-js-err-container]');

        errContainer.innerHTML = "";

        for (var key in result) {
            let data = result[key][0];

            if (key == 'success') {
                data = `<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">` +
                    data + `
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            } else {
                data = `<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">` +
                    data + `
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            }

            errContainer.insertAdjacentHTML('beforeend', data);

        }
    };
</script>
@endsection