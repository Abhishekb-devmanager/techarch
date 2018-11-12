<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'movies';
    protected $primarykey = 'id';
    protected $fillable = array('movie_id', 
                                'tagline', 
                                'title', 
                                'original_title', 
                                'homepage',
                                'original_language',
                                'overview',
                                'runtime',
                                'status',
                                'release_date',
                                'popularity',
                                'budget',
                                'revenue',
                                'vote_average',
                                'vote_count',
                                'genres',
                                'keywords',
                                'production_companies',
                                'production_countries');

    protected $hidden = array('created_at', 'updated_at');
}
