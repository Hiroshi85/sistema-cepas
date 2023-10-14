<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;

class NotificationController extends Controller
{
    public function marcarLeida($id){
        $selectedNotification = DatabaseNotification::find($id);
        $selectedNotification->markAsRead();
        // extract the notification class
        if (class_basename($selectedNotification->type) == "PagoNotification")
            return redirect()->route('inbox.show', ['id' => $id]);
        else
            return redirect()->back();
    }
}
