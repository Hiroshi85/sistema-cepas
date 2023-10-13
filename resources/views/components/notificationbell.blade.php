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
    <div 
    aria-labelledby="dropdownMenuButton1"
    data-te-dropdown-menu-ref
    class="absolute hidden z-50 max-w-md w-[600px] bg-white divide-y divide-gray-100 rounded-lg shadow-md ring-1 ring-gray-300 dark:ring-gray-500 dark:bg-gray-800 dark:divide-gray-700 [&[data-te-dropdown-show]]:block max-h-[90vh]  md:max-h-[80vh] overflow-hidden overflow-y-auto" 
    >
      <div class="sticky z-50 top-0 px-4 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50 dark:bg-gray-800 dark:text-white">
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
      <a href="#" class="sticky bottom-0 block py-2 text-sm font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white">
        <div class="inline-flex items-center gap-2">
          <i class="fa-solid fa-eye text-sm"></i>
          <span>ver todas</span>
        </div>
      </a>
    </div>
</div>

