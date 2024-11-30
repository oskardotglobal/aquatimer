<?php

namespace App\Http\Controllers;

use App\Models\Measurement;
use App\Models\Node;
use Inertia\Inertia;
use Inertia\Response;

class AppController
{
    public function index(): Response
    {
        $node = Node::all()->first();
        $measurements = $node->measurements()->limit(300)->get();

        return Inertia::render('Index', ["node" => $node, "measurements" => $measurements]);
    }
}
