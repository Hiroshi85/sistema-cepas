@props(['notification', 'selected' => false])
<div class="relative">
    <a href="{{ route('notificacion.leida', ['id'=>$notification->id]) }}" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 @if($notification->unread()) bg-slate-200 dark:bg-gray-600 @endif">
        @include('components.notifications.types.'.str_replace(' ','-',$notification->data['type']), ['notification' => $notification])
    </a>
    @if($notification->unread())
    <span
    class="absolute top-0.5 right-0 whitespace-nowrap rounded-[0.27rem] bg-blue-200 px-[0.65em] pb-[0.25em] pt-[0.35em] text-center align-baseline text-[0.58em] font-bold leading-none text-blue-700">
    nuevo
  </span>
    @endif
</div>
            
