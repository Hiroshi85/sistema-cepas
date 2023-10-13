@props(['notification'])

@switch($notification->data['type'])
    @case("voucher observado")
        <a href="{{ route('notificacion.leida', ['id'=>$notification->id]) }}" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 @if($notification->unread()) bg-slate-200 dark:bg-gray-600 @endif">
            <div class="flex-shrink-0">
                <img class="rounded-full w-11 h-11" src="{{asset('assets/postulante.png')}}" alt="Jese image">
                <div class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 bg-red-500 border rounded-full border-red-500">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
            </div>
            <div class="w-full pl-3 overflwow-hidden">
                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400 overflwow-hidden">
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $notification->data['from']['name'] }}</span> ha registrado una observación sobre su voucher con código de operación 
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $notification->data['voucher']['codigo_operacion'] }}</span></span>
                </div>
                <div class="text-xs text-blue-600 dark:text-blue-500">{{ $notification->created_at->diffForHumans() }}</div>
            </div>
        </a>            
    @break
    @case("voucher verificado")
    <a href="{{ route('notificacion.leida', ['id'=>$notification->id]) }}" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 @if($notification->unread()) bg-slate-200 dark:bg-gray-600 @endif">
        <div class="flex-shrink-0">
            <img class="rounded-full w-11 h-11" src="{{asset('assets/postulante.png')}}" alt="Jese image">
            <div class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 border rounded-full border-green-500 text-green-500">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>
        <div class="w-full pl-3 overflwow-hidden">
            <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400 overflwow-hidden">
                <span class="font-semibold text-gray-900 dark:text-white">{{ $notification->data['from']['name'] }}</span> ha verificado la validez de su voucher con código de operación 
                <span class="font-semibold text-gray-900 dark:text-white">{{ $notification->data['voucher']['codigo_operacion'] }}</span>
            </div>
            <div class="text-xs text-blue-600 dark:text-blue-500">{{ $notification->created_at->diffForHumans() }}</div>
        </div>
    </a>  
    @break
    @case("voucher registrado")
    <a href="{{ route('notificacion.leida', ['id'=>$notification->id]) }}" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 @if($notification->unread()) bg-slate-200 dark:bg-gray-600 @endif">
        <div class="flex-shrink-0">
            <img class="rounded-full w-11 h-11" src="{{asset('assets/postulante.png')}}" alt="Jese image">
            <div class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 rounded-full text-yellow-500">
                <i class="fa-solid fa-receipt"></i>
            </div>
        </div>
        <div class="w-full pl-3 overflwow-hidden">
            <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400 overflwow-hidden">
                <span class="font-semibold text-gray-900 dark:text-white">{{ $notification->data['from']['name'] }}</span> ha registrado un nuevo voucher para su validación
            </div>
            <div class="text-xs text-blue-600 dark:text-blue-500">{{ $notification->created_at->diffForHumans() }}</div>
        </div>
    </a> 
    @break
@endswitch
