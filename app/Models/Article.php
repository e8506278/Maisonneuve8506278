<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre_en',
        'titre_fr',
        'contenu_en',
        'contenu_fr',
        'user_id'
    ];

    public function articleHasUser()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    static public function paginateArticles($nb_per_page)
    {
        $lg = "_en"; // la langue par défaut

        if (session()->has('locale') &&  session()->get('locale') == 'fr') {
            $lg = "_fr";
        }

        $query = Article::Select('id', 'user_id', 'created_at', 'updated_at', DB::raw('(case when titre' . $lg . ' is null then titre_en else titre' . $lg . ' end) as titre, (case when contenu' . $lg . ' is null then contenu_en else contenu' . $lg . ' end) as contenu'))
            ->orderby('updated_at', 'desc')
            ->paginate($nb_per_page);

        return $query;
    }

    static public function selectArticles($id = null)
    {
        $lg = "_en"; // la langue par défaut

        if (session()->has('locale') &&  session()->get('locale') == 'fr') {
            $lg = "_fr";
        }

        $query = Article::Select('id', 'user_id', 'created_at', 'updated_at', DB::raw('(case when titre' . $lg . ' is null then titre_en else titre' . $lg . ' end) as titre, (case when contenu' . $lg . ' is null then contenu_en else contenu' . $lg . ' end) as contenu'))
            ->where('id', $id)
            ->OrderBy('titre')
            ->get();

        return $query[0];
    }
}
