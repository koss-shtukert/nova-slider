<?php

namespace RP\Filters;

use Laravel\Nova\Filters\Filter;
use Illuminate\Container\Container;
use Illuminate\Http\Request;

abstract class NovaSlider extends Filter
{
   /**
     * Prepare the filter for JSON serialization.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $container = Container::getInstance();

        return [
            'class' => get_class($this),
            'name' => $this->name(),
            'options' => collect($this->options($container->make(Request::class)))->map(function ($value, $key) {
                return ['name' => $key, 'value' => $value];
            })->values()->all(),
            'currentValue' => [],
            'isRangeFilter' => true,
        ];
    }
}
