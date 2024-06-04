<?php
namespace App\Traits;

use Ramsey\Uuid\Exception\UuidExceptionInterface;
use Ramsey\Uuid\Uuid as Generator;

trait UUID{
    protected static function boot(){
        // Boot other traits on the Model
        parent::boot();

        /**
         * Listen for the creating event on the user model.
         * Sets the 'id' to a UUID using Str::uuid() on the instance being created
         */
        static::creating(function ($model) {
            if ($model->getKey() === null) {
                try {
                    $model->setAttribute($model->getKeyName(), Generator::uuid4()->toString());
                } catch (UuidExceptionInterface $e) {
                    abort(500, $e->getMessage());
                }
            }
        });
    }

    // Tells the database not to auto-increment this field
    public function getIncrementing ()
    {
        return false;
    }

    // Helps the application specify the field type in the database
    public function getKeyType ()
    {
        return 'string';
    }
}
