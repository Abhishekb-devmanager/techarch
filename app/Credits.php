<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credits extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'credits';
    protected $primarykey = 'id';
    protected $fillable = array('movie_id', 'title', 'cast', 'crew');

    protected $hidden = array('created_at', 'updated_at');

}
