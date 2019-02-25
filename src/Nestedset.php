<?php

namespace ZiffDavis\Nova\Nestedset;

use Laravel\Nova\Fields\BelongsTo;

class Nestedset extends BelongsTo
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-nestedset';
}
