<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * An ESP32 sending data
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Node newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Node newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Node query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Node whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Node whereName($value)
 * @mixin \Eloquent
 */
class Node extends Model
{
    public function measurements(): HasMany
    {
        return $this->hasMany(Measurement::class);
    }
}
