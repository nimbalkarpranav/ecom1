<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Http;

class MessageController extends Controller
{
//     public function sendToAll(Request $request)


//  {




//         event(new \App\Events\MessageSent([
//     'message' => 'Hello from Laravel!',
//     'user' => 'Admin'
// ]));

//         // $users = users::whereNotNull('onesignal_player_id')->get(); // Assuming 'player_id' is the OneSignal player ID

//         // foreach ($users as $user) {
//         //     Http::withHeaders([
//         //         'Authorization' => 'd6gu6whk4ej35ffzfyembpsvz', // Replace with your REST API key
//         //         'Content-Type' => 'application/json',
//         //     ])->post('https://onesignal.com/api/v1/notifications', [
//         //         'app_id' => '441ba24e-72a3-4130-a746-2e9c8950a011',
//         //         'include_player_ids' => [$user->onesignal_player_id],
//         //         'contents' => ['en' => $request->message],
//         //         'headings' => ['en' => 'New Order Notification'],
//         //     ]);
//         // }

//         return redirect()->back()->with('success', '✅ Message sent to all users!');
//     }




public function sendToAll(Request $request)
{
    $request->validate([
        'message' => 'required|string',
        'photo' => 'nullable|image|max:2048',
    ]);

    $photoPath = null;

    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('uploads', 'public');
    }

    event(new \App\Events\MessageSent([
        'message' => $request->message,
        'user' => 'Admin',
        'photo' => $photoPath ? asset('storage/'. $photoPath) : null,
    ]));

    return response()->json(['success' => true]);
}


}
