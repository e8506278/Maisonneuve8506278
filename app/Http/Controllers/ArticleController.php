<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::paginateArticles(3);
        $request->session()->put('referer', "");

        $msgRetour = $request->session()->get('msgRetour');
        $request->session()->put('msgRetour', '');

        return view(
            'forum.index',
            [
                'articles'   => $articles,
                'msg_retour' => $msgRetour
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $referer = request()->headers->get('referer');

        if ($referer) {
            $new_array = explode('/', $referer);
            $key = $new_array[array_key_last($new_array)];

            switch ($key) {
                case 'doc':
                case 'dashboard':
                    $request->session()->put('referer', $referer);
                    break;

                default:
                    // 'edit'
                    $referer = $request->session()->get('referer');
                    break;
            }
        } else {
            // Venu de l'extérieur
            $referer = "";
        }

        return view(
            'forum.create',
            [
                'referer' => $referer
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new Article;
        $article->fill($request->all());
        $article->user_id = Auth::user()->id;
        $article->save();

        return redirect('forum/' . $article->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Article $article)
    {
        $article = Article::find($article->id);
        $referer = request()->headers->get('referer');

        if ($referer) {
            $new_array = explode('/', $referer);
            $key = $new_array[array_key_last($new_array)];

            switch ($key) {
                case 'doc':
                case 'dashboard':
                    $request->session()->put('referer', $referer);
                    break;

                default:
                    // 'edit'
                    $referer = $request->session()->get('referer');
                    break;
            }
        } else {
            // Venu de l'extérieur
            $referer = "";
        }

        return  view(
            'forum.show',
            [
                'article' => $article,
                'referer' => $referer
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Article $article)
    {
        $msgRetour = $request->session()->get('msgRetour');
        $request->session()->put('msgRetour', '');

        return view(
            'forum.edit',
            [
                'article'    => $article,
                'msg_retour' => $msgRetour
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->update([
            'titre_en'   => $request->titre_en,
            'titre_fr'   => $request->titre_fr,
            'contenu_en' => $request->contenu_en,
            'contenu_fr' => $request->contenu_fr
        ]);

        $locale = session()->get('locale');

        if ($locale == 'fr') {
            $msgRetour = "L'article a bien été modifié";
        } else {
            $msgRetour = "Post has been updated";
        }

        return redirect()->back()->with(['msg_retour' => $msgRetour]);


        return redirect(route('forum.show', $article->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Article $article)
    {
        $article->delete();
        $referer = $request->session()->get('referer');
        $route = "forum";

        if ($referer) {
            $new_array = explode('/', $referer);
            $key = $new_array[array_key_last($new_array)];

            if ($key == 'dashboard') {
                $route = 'dashboard';
            }
        }

        return redirect(route($route));
    }
}
