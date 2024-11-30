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
        assert($request->getClientIp() != null);

        $node = Node::where("ip_address", "=", $request->getClientIp())->get();

        if ($node == null) {
            $node = Node::create([
                "ip_address" => $request->getClientIp(),
                "name" => "device_" . $request->getClientIp()
            ]);
        }

        $body = $request->json()->all();

        Measurement::create(array_merge(["node_id" => $node->id], $body));

        $pending = $node->pending()->latest();
        PendingActions::where("node_id", "=", $node->id)->delete();

        if ($pending == null) {
            return response()->json(["should_water" => false]);
        }

        return response()->json(["should_water" => $pending->should_water]);
    }
}
