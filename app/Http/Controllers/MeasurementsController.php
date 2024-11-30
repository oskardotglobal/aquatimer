<?php

namespace App\Http\Controllers;

use App\Models\Measurement;
use App\Models\Node;
use App\Models\PendingActions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MeasurementsController
{
    public function create(Request $request): JsonResponse
    {
        $ip = $request->getClientIp();
        assert($ip != null);

        $node = Node::where("ip_address", "=", $ip)->first();

        if ($node == null) {
            $node = Node::create([
                "ip_address" => $ip,
                "name" => "device_" . $ip
            ]);
        }

        $body = $request->json()->all();

        Measurement::create(array_merge(["node_id" => $node->id], $body));

        $pending = $node->pending()->latest()->first();
        PendingActions::where("node_id", "=", $node->id)->delete();

        if ($pending == null) {
            return response()->json(["should_water" => false]);
        }

        return response()->json(["should_water" => $pending->should_water]);
    }

    public function water(Request $request): void
    {
        $ip = $request->getClientIp();
        assert($ip != null);

        $node = Node::where("ip_address", "=", $ip)->first();

        if ($node == null) {
            $node = Node::create([
                "ip_address" => $ip,
                "name" => "device_" . $ip
            ]);
        }

        PendingActions::create(["node_id" => $node->id, "should_water" => true]);
    }
}
