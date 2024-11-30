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
 * @property string $ip_address
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Measurement> $measurements
 * @property-read int|null $measurements_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Node whereIpAddress($value)
 * @mixin \Eloquent
 */
class Node extends Model
{
    protected $guarded = [];

    public function measurements(): HasMany
    {
        return $this->hasMany(Measurement::class);
    }

    public function pending(): HasMany
    {
        return $this->hasMany(PendingActions::class);
    }
}
