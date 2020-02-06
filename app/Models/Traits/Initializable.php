<?php

namespace App\Models\Traits;

trait Initializable
{
    /**
     * Override constructor to fire initializing event
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->bootIfNotBooted();
        $this->syncOriginal();
        $this->fill($attributes);

        $this->addObservableEvents('initializing');
        $this->fireModelEvent('initializing');
    }

    /**
     * Fire a callback whenever an instance is constructed
     * @param  callable $callback
     * @return void
     */
    public static function initializing($callback)
    {
        static::registerModelEvent('initializing', $callback);
    }
}
