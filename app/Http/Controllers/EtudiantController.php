<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Ville;
use App\Models\Article;
use App\Models\Doc;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File as File;


class EtudiantController extends Controller
{
    /**
     * Affiche la liste des étudiants.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $etudiants = Etudiant::paginate(10);
        $request->session()->put('referer', "");

        $msgRetour = $request->session()->get('msgRetour');
        $request->session()->put('msgRetour', '');

        return view(
            'etudiant.index',
            [
                'etudiants'  => $etudiants,
                'msg_retour' => $msgRetour
            ]
        );
    }


    /**
     * Affiche le formulaire de création d'un nouvel étudiant.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $villes = Ville::all();

        return  view(
            'etudiant.create',
            [
                'villes' => $villes
            ]
        );
    }


    /**
     * Stocke un étudiant nouvellement créé dans la BD.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nouvelEtudiant = Etudiant::create([
            'nom'            => $request->nom,
            'adresse'        => $request->adresse,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'date_naissance' => $request->date_naissance,
            'ville_id'       => $request->ville_id
        ]);

        $nom = $request->nom;

        $request->session()->put('msgRetour', "Ajout de '" . $nom . "' effectué !");
        return redirect(route('etudiant.show', $nouvelEtudiant->id));
    }


    /**
     * Affiche l'étudiant spécifié.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Etudiant $etudiant)
    {
        $villes = Ville::all();

        $msgRetour = $request->session()->get('msgRetour');
        $request->session()->put('msgRetour', '');

        return  view(
            'etudiant.show',
            [
                'etudiant'   => $etudiant,
                'villes'     => $villes,
                'msg_retour' => $msgRetour
            ]
        );
    }


    /**
     * Affiche le formulaire de modification de l'étudiant spécifié.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Etudiant $etudiant)
    {
        $villes = Ville::all();
        $referer = request()->headers->get('referer');

        if ($referer) {
            $new_array = explode('/', $referer);
            $key = $new_array[array_key_last($new_array)];

            switch ($key) {
                case 'etudiant':
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
            'etudiant.edit',
            [
                'etudiant' => $etudiant,
                'villes'   => $villes,
                'referer'  => $referer
            ]
        );
    }


    /**
     * Met à jour l'étudiant spécifié dans la BD.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        $etudiant->update([
            'nom'            => $request->nom,
            'adresse'        => $request->adresse,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'date_naissance' => $request->date_naissance,
            'ville_id'       => $request->ville_id
        ]);

        $nom = $etudiant->nom;
        $request->session()->put('msgRetour', "Modification de '" .  $nom . "' effectuée !");
        $referer = $request->session()->get('referer');

        if ($referer) {
            $new_array = explode('/', $referer);
            $key = $new_array[array_key_last($new_array)];

            if ($key == 'dashboard') {
                return redirect(route('dashboard'));
            }
        }

        return redirect(route('etudiant.show', $etudiant->id));
    }


    /**
     * Supprime l'étudiant spécifié de la BD.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Etudiant $etudiant)
    {
        $id = $etudiant->id;

        // On supprime les fichiers créés par l'étudiant
        $path = '/docs/';

        $fichiers = DOC::select()
            ->where('user_id', $id)
            ->get();

        foreach ($fichiers as $doc) {
            $titre_en = $doc['titre_en'];
            $titre_fr = $doc['titre_fr'];

            File::delete(public_path($path . $titre_en));
            File::delete(public_path($path . $titre_fr));

            $doc->delete();
        }

        // On efface les articles rédigés par l'étudiant
        $articles = Article::get()->where('user_id', $id);

        foreach ($articles as $article) {
            $article->delete();
        }

        // On supprime l'étudiant
        $nom = $etudiant->nom;
        $etudiant->delete();

        // Finalement, on supprimer son compte
        $usagers = User::select()
            ->where('id', $id)
            ->get();

        foreach ($usagers as $usager) {
            $usager->delete();
        }

        $request->session()->put('msgRetour', "Destruction de '" . $nom . "' effectuée !");
        return redirect(route('etudiant'));
    }
}
