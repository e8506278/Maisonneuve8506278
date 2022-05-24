<?php

namespace App\Http\Controllers;

use App\Models\Doc as Doc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as File;


class DocController extends Controller
{
    public function listAllDocs()
    {
        $docs = Storage::disk('public-folder')->allFiles('docs');
        return $docs;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $docs = Doc::paginate(10);
        $request->session()->put('referer', "");

        $msgRetour = $request->session()->get('msgRetour');
        $request->session()->put('msgRetour', '');

        return view(
            'doc.index',
            [
                'docs'       => $docs,
                'msg_retour' => $msgRetour
            ]
        );
    }


    /**
     * Affiche le fichier spécifié.
     *
     * @param  \App\Models\Doc  $doc
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Doc $doc)
    {
        $msgRetour = $request->session()->get('msgRetour');
        $request->session()->put('msgRetour', '');

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
            'doc.show',
            [
                'doc'        => $doc,
                'msg_retour' => $msgRetour,
                'referer'    => $referer
            ]
        );
    }

    public function test()
    {
        return "test";
    }


    /**
     * Display a listing of the resource.
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
                    $referer = $request->session()->get('referer');
                    break;
            }
        } else {
            // Venu de l'extérieur
            $referer = "";
        }

        return view(
            'doc.create',
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
        try {
            $request->validate([
                'doc.*.docname' => 'required|mimes:doc,pdf,zip',
                'doc.*.titre_en' => 'required',
                'doc.*.titre_fr' => 'required'
            ]);
        } catch (\Illuminate\Validation\ValidationException $th) {
            $data = $th->validator->errors();
            return $data;
        }

        foreach ($request->doc as $key => $doc) {
            if (array_key_exists('docname', $doc)) {
                $docname = $doc['docname'];
                $titre_en = $doc['titre_en'];
                $titre_fr = $doc['titre_fr'];

                $id = Auth::user()->id;
                $docpath = public_path() . '/docs/';
                $path = '/docs/';

                $docname->move($docpath, $titre_en);
                File::copy(public_path($path . $titre_en), public_path($path . $titre_fr));

                $doc = new Doc();
                $doc->titre_en = $titre_en;
                $doc->titre_fr = $titre_fr;
                $doc->user_id = $id;
                $doc->save();
            }
        }

        // On retourne avec un message selon la langue en vigueur.
        $locale = session()->get('locale');

        if ($locale == 'fr') {
            $msgRetour = "Vos documents ont été ajoutés avec succès.";
        } else {
            $msgRetour = "Your documents has been successfully added.";
        }

        $data = array('success' => [$msgRetour]);
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doc  $doc
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Doc $doc)
    {
        $msgRetour = $request->session()->get('msgRetour');
        $request->session()->put('msgRetour', '');

        return view(
            'doc.edit',
            [
                'doc' => $doc,
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
    public function update(Request $request, Doc $doc)
    {
        $vieux_titre_en = $request['vieux_titre_en'];
        $vieux_titre_fr = $request['vieux_titre_fr'];

        $nouv_titre_en = $request['titre_en'];
        $nouv_titre_fr = $request['titre_fr'];

        $id = Auth::user()->id;
        $path = '/docs/';

        File::move(public_path($path . $vieux_titre_en), public_path($path . $nouv_titre_en));
        File::move(public_path($path . $vieux_titre_fr), public_path($path . $nouv_titre_fr));

        $doc->update([
            'titre_en'   => $request->titre_en,
            'titre_fr'   => $request->titre_fr
        ]);

        $locale = session()->get('locale');

        if ($locale == 'fr') {
            $msgRetour = "Les noms de fichier ont bien été modifiés";
        } else {
            $msgRetour = "File names have been updated";
        }

        return redirect()->back()->with(['msg_retour' => $msgRetour]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doc  $doc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Doc $doc)
    {
        $titre_en = $doc['titre_en'];
        $titre_fr = $doc['titre_fr'];

        $id = Auth::user()->id;
        $path = '/docs/';

        File::delete(public_path($path . $titre_en));
        File::delete(public_path($path . $titre_fr));

        $doc->delete();

        $referer = $request->session()->get('referer');
        $route = "doc";

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
