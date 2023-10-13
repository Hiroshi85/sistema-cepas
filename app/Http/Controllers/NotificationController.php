<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;

class NotificationController extends Controller
{
    public function marcarLeida($id){
        $notification = DatabaseNotification::find($id);
        $notification->markAsRead();
        // extract the notification class
        if (class_basename($notification->type) == "PagoNotification")
            return redirect()->route('pago.edit', $notification->data['voucher']['idpago']);
        else
            return redirect()->back();
    }
}
