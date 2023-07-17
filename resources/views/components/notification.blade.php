@props(['counter' => 0])
<div class="relative m-2 inline-flex w-fit cursor-pointer">
 
    @if ($counter > 0)
      <div
        class="absolute bottom-auto left-auto right-2.5 top-2 z-10 inline-block -translate-y-1/2 translate-x-2/4 rotate-0 skew-x-0 skew-y-0  scale-x-100 scale-y-100 rounded-full bg-red-500 p-1.5">
      </div>
    @endif

    <div
      class="flex items-center justify-center rounded-lg px-2 py-2 text-center dark:text-white shadow-lg dark:text-gray-200">
      <i class="fas fa-bell"></i>
    </div>
</div>
