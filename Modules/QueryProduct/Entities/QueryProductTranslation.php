<?php

namespace Modules\QueryProduct\Entities;

use Modules\Support\Eloquent\TranslationModel;

class QueryProductTranslation extends TranslationModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['campaign_name'];
}
