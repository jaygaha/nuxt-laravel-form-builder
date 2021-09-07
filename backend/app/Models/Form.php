<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'mapping_url', 'version'
    ];

    /**
     * A Form can have many form layout
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function layouts()
    {
        return $this->hasMany('App\Models\FormLayout');
    }
}
