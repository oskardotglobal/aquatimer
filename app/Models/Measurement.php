<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * A single piece of timestamped measured data
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property float $moisture
 * @property int $node_id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Measurement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Measurement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Measurement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Measurement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Measurement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Measurement whereMoisture($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Measurement whereNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Measurement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Measurement extends Model
{
    public function node(): BelongsTo
    {
        return $this->belongsTo(Node::class);
    }
}
