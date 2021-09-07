<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormLayout extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'form_id', 'version', 'form_layout'
    ];

    /**
     * A layouts belongs to a form
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function form()
    {
        return $this->belongsTo('App\Models\Form');
    }
}