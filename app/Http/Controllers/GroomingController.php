<?php

namespace App\Http\Controllers;

use App\Http\Requests\Grooming\GroomingRequest;
use App\Services\GroomingService;
use Illuminate\Http\Request;

class GroomingController extends Controller
{

    protected $groomingService;

    public function __construct(GroomingService $groomingService)
    {
        $this->groomingService = $groomingService;
    }

    public function storeGroomingSession($petId, GroomingRequest $request)
    {
        $groomingSessions = $this->groomingService->storeGroomingSession($petId, $request->grooming_sessions);

        return response()->json([
            'message' => 'Grooming sessions successfully saved!',
            'grooming_sessions' => $groomingSessions
        ], 200);
    }

    public function fetchGroomingSessions($id)
    {
        $groomingSessions = $this->groomingService->fetchGroomingSessions($id);

        return response()->json($groomingSessions);
    }

    public function destroyGroomingSession($petId, $groomingSessionId)
    {
        $response = $this->groomingService->destroyGroomingSession($petId, $groomingSessionId);

        return response()->json([
            'message' => $response['message']
        ], $response['status']);
    }
}
