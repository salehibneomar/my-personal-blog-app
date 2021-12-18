<?php

use App\Models\Message;

function message_notification(){
    $unreadMessagesCount = Message::withoutTrashed()
                                  ->where('seen_status', 0)
                                  ->count();
                                  
    $messages = Message::withoutTrashed()
                       ->where('seen_status', 0)
                       ->latest()
                       ->limit(10)
                       ->get();
    
    $data = collect([
        'count'    => $unreadMessagesCount,
        'messages' => $messages
    ]);
    
    return $data;
}