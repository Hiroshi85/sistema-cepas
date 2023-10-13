<div class="relative m-2 inline-flex cursor-pointer h-10" data-te-dropdown-ref>
    <button 
      id="dropdownMenuButton1"
      data-te-dropdown-toggle-ref
      aria-expanded="false"
      data-te-ripple-init
      class="inline-flex items-center text-sm font-medium text-center text-gray-500 hover:text-gray-900  dark:hover:text-white dark:text-gray-400 focus:outline-none"
    > 
      <i class="fas fa-bell"></i>
      @if (Auth::user()->unreadNotifications()->count() > 0)
      <div class="relative flex">
        <div class="relative inline-flex w-3 h-3 bg-red-500 border-2 border-white rounded-full -top-2 right-2 dark:border-gray-900"></div>
      </div>
      @endif
    </button>

    {{-- Notifications --}}
    {{-- shon in front of every component --}}
    <div 
    aria-labelledby="dropdownMenuButton1"
    data-te-dropdown-menu-ref
    class="absolute hidden z-50 max-w-md w-[600px] bg-white divide-y divide-gray-100 rounded-lg shadow-md ring-1 ring-gray-300 dark:ring-gray-500 dark:bg-gray-800 dark:divide-gray-700 [&[data-te-dropdown-show]]:block" 
    >
      <div class="block px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
          Notificaciones
      </div>
      <div class="divide-y divide-gray-100 dark:divide-gray-700">
        {{-- Componente notificacion  --}}
        @if(Auth::user()->notifications->count() > 0)
          @foreach (Auth::user()->notifications as $notification)
            <x-notifications.notification :notification="$notification"/>
          @endforeach
        @else
          <div class="px-4 py-2 text-sm text-center text-gray-700 dark:text-gray-400">No hay notificaciones</div>
        @endif
        {{--  --}}
      </div>
      <a href="#" class="block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
        <div class="inline-flex items-center ">
          <svg class="w-4 h-4 mr-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
            <path d="M10 0C4.612 0 0 5.336 0 7c0 1.742 3.546 7 10 7 6.454 0 10-5.258 10-7 0-1.664-4.612-7-10-7Zm0 10a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z"/>
          </svg>
            View all
        </div>
      </a>
    </div>
</div>

