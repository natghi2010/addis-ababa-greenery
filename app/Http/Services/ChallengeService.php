<?php

namespace App\Http\Services;

use App\Models\Challenge;

class ChallengeService
{
    public function getChallenges()
    {
        return Challenge::all();
    }

    public function getChallenge($id)
    {
        return Challenge::find($id);
    }

    public function createChallenge($data)
    {
        return Challenge::create($data);
    }

    public function updateChallenge($id, $data)
    {
        Challenge::find($id)->update($data);
    }

    public function deleteChallenge($id)
    {
        Challenge::find($id)->delete();
    }
}
