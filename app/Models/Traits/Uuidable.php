<?php

namespace App\Models\Traits;

use Ramsey\Uuid\Uuid;

/**
 * Automatically inject UUID primary key when creating new models.
 *
 * you must set the `$incrementing` property to false for this to work properly
 */
trait Uuidable
{
    /**
     * Boot trait.
     */
    public static function bootUuidable()
    {
        self::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Uuid::uuid4();
            }
        });
        self::initializing(function ($model) {
            $model->setIncrementing(false);
        });
    }
}
