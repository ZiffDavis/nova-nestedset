<?php

namespace ZiffDavis\Nova\Nestedset\Fields;

use Laravel\Nova\Fields\BelongsTo;

class NestedsetSelect extends BelongsTo
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-nestedset-select';
}
