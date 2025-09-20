<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OneSignalController extends Controller
{
    /**
     * Store the OneSignal player ID for the authenticated user.
     */
    public function storePlayerId(Request $request)
    {
        $request->validate([
            'player_id' => 'required|string',
        ]);

        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user->onesignal_player_id = $request->player_id;
        $user->save();

        return response()->json(['message' => '✅ Player ID stored successfully']);
    }
}
