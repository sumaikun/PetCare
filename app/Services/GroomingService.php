<?php

namespace App\Services;

use App\Models\GroomingSession;

class GroomingService
{
    public function storeGroomingSession($petId, $groomingSessionsData)
    {
        $groomingSessions = [];
        foreach ($groomingSessionsData as $data) {
            $data['pet_id'] = $petId;
            $groomingSession = GroomingSession::updateOrCreate(['id' => $data['id'] ?? null], $data);
            $groomingSessions[] = $groomingSession;
        }

        return $groomingSessions;
    }

    public function fetchGroomingSessions($petId)
    {
        return GroomingSession::where('pet_id', $petId)->get();
    }

    public function destroyGroomingSession($petId, $groomingSessionId)
    {
        $groomingSession = GroomingSession::where('pet_id', $petId)->where('id', $groomingSessionId)->first();

        if ($groomingSession) {
            $groomingSession->delete();
            return ['message' => 'Grooming session deleted successfully', 'status' => 200];
        }

        return ['message' => 'Grooming session not found', 'status' => 404];
    }
}
