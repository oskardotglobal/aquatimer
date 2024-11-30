<?php

namespace App\Tasks;

use App\Models\Measurement;
use App\Models\Node;
use App\Models\PendingActions;

class CalculateWateringTask
{
    public function __invoke(): void
    {
        Node::all()->map(function ($node) {
            $avg = Measurement::where("node_id", "=", $node->id)
                ->limit(300)
                ->get()
                ->map(fn($measurement) => $measurement->moisture)
                ->avg();

            if ($avg < 600) {
                PendingActions::create(["node_id" => $node->id, "should_water" => true]);
            }
        });
    }
}
