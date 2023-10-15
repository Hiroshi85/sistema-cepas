<div class="flex-shrink-0">
    <img class="rounded-full w-11 h-11" src="{{asset('assets/postulante.png')}}" alt="Jese image">
    <div class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 rounded-full text-green-500">
        <i class="fa-solid fa-receipt"></i>
    </div>
</div>
<div class="w-full pl-3 overflwow-hidden">
    <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400 overflwow-hidden">
        <span class="font-semibold text-gray-900 dark:text-white">{{ $notification->data['from']['name'] }} ha registrado </span> un nuevo voucher para su validación
    </div>
    <div class="text-xs text-blue-600 dark:text-blue-500">{{ $notification->created_at->diffForHumans() }}</div>
</div>