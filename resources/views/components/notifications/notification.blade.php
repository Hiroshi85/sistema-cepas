@props(['notification', 'selected' => false])

<a href="{{ route('notificacion.leida', ['id'=>$notification->id]) }}" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 @if($notification->unread()) bg-slate-200 dark:bg-gray-600 @endif">
    @include('components.notifications.types.'.str_replace(' ','-',$notification->data['type']), ['notification' => $notification])
</a>            
