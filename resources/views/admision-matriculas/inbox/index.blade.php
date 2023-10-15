<x-app-layout>
    <div class="flex flex-row md:flex-col flex-wrap w-full h-screen overflow-hidden">
        <div class="max-h-[50px] md:h-full w-[90%] md:w-[40%]">
            <button type="button" onclick="setSideBarVisibility()" class="z-50 inline-flex items-center p-2 my-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                <span class="sr-only">Open sidebar</span>
                <i class="fa-solid fa-bars-staggered"></i>
             </button>
         
            <aside id="default-sidebar" class="flex h-screen transition-transform -translate-x-full md:translate-x-0" aria-label="Sidebar"
            >
                <div class="w-[50%] min-w-[140px] z-50 h-full px-3 py-4 overflow-y-auto bg-gray-100 dark:bg-gray-800">
                   <ul class="font-medium">
                      <li>
                         <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                               <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="flex-1 ml-3 whitespace-nowrap">Inbox</span>
                            <span class="inline-flex items-center justify-center w-3 h-3 p-3 ml-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">{{Auth::user()->unreadNotifications->count()}}</span>
                         </a>
                      </li>
                   </ul>
                   <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                    <form action="" class="flex flex-col gap-4">
                        {{-- group of checkbox for filters --}}
                        <div class="flex items-center">
                            <input type="checkbox" id="filter" name="filter" value="1" checked>
                            <label for="filter" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Filter</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="filter" name="filter" value="1" checked>
                            <label for="filter" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Filter</label>
                        </div>
                        <div>
                            <x-primary-button class="bg-gray-800 dark:bg-gray-900 dark:hover:bg-gray-700">
                                <i class="fas fa-check"></i>
                            </x-primary-button>
                            <x-secondary-button type="reset" class="mx-2"><i class="fa-solid fa-rotate"></i></x-secondary-button>
                        </div>
                       
                    </form>
                   </ul>
                </div>
                <div class="h-full z-50 px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-900">
                    <ul class="space-y-2 font-medium">
                        @foreach (Auth::user()->notifications as $notification)
                        <li>
                            <x-notifications.notification :notification="$notification"/>
                        </li>
                        @endforeach
                    </ul>
                 </div>
             </aside>
        </div>
        
        <div class="overflow-y-auto w-full md:w-[60%] z-1 overflow-hidden">
            @if(isset($selectedNotification))
                @include('admision-matriculas.inbox.details', ['selectedNotification' => $selectedNotification])
            @else
                @include('admision-matriculas.inbox.isempty')
            @endif
        </div>
    </div>
    @push('scripts')
        <script>
            function setSideBarVisibility() {
                const sidebar = document.getElementById('default-sidebar');
                if(sidebar.classList.contains('-translate-x-full')) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                } else {
                    sidebar.classList.remove('translate-x-0');
                    sidebar.classList.add('-translate-x-full');
                }
            }
        </script>
    @endpush
</x-app-layout>
