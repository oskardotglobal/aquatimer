<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PendingActions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PendingActions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PendingActions query()
 * @mixin \Eloquent
 */
class PendingActions extends Model
{
    protected $guarded = [];
    protected $table = "pending_actions";

    public function node(): BelongsTo
    {
        return $this->belongsTo(Node::class);
    }
}
