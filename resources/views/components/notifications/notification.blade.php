@props(['notification'])

@switch($notification->data['type'])
    @case("voucher observado")
        <a href="{{ route('pago.edit', $notification->data['voucher']['idpago']) }}" class="flex px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700">
            <div class="flex-shrink-0">
            <img class="rounded-full w-11 h-11" src="{{asset('assets/postulante.png')}}" alt="Jese image">
            <div class="absolute flex items-center justify-center w-5 h-5 ml-6 -mt-5 bg-blue-600 border border-white rounded-full dark:border-gray-800">
                <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                <path d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z"/>
                <path d="M4.439 9a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239Z"/>
                </svg> 
                
            </div>
            </div>
            <div class="w-full pl-3">
                <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400">New message from <span class="font-semibold text-gray-900 dark:text-white">{{ $notification->data['from']['email'] }}</span>: "Hey, what's up? All set for the presentation?"</div>
                <div class="text-xs text-blue-600 dark:text-blue-500">a few moments ago</div>
            </div>
        </a>            
    @break
@endswitch
