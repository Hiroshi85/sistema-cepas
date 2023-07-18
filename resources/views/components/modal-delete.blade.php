@props(['id','entity' => '', 'element', 'route'])
<div
  data-te-modal-init
  class="fixed left-0 top-0 z-[1055] hidden h-full w-full overflow-y-auto overflow-x-hidden outline-none text-center"
  id="exampleModalCenter-{{$entity}}{{$id}}"
  tabindex="-1"
  aria-labelledby="exampleModalCenterTitle"
  aria-modal="true"
  role="dialog">
  <div
    data-te-modal-dialog-ref
    class="pointer-events-none relative flex min-h-[calc(100%-1rem)] w-auto translate-y-[-50px] items-center opacity-0 transition-all duration-300 ease-in-out min-[576px]:mx-auto min-[576px]:mt-7 min-[576px]:min-h-[calc(100%-3.5rem)] min-[576px]:max-w-[500px]">
    <div
      class="pointer-events-auto relative flex w-full flex-col rounded-md border-none bg-white bg-clip-padding text-current shadow-lg outline-none dark:bg-gray-800">
      <div
        class="flex items-center justify-between  rounded-t-md border-b-2 border-gray-100 border-opacity-100 p-4 dark:border-opacity-50 dark:text-white">
        <!--Modal title-->
        <i class="fa-solid fa-circle-exclamation text-5xl mx-auto"></i>
        <!--Close button-->
        <button
          type="button"
          class="box-content rounded-none border-none hover:no-underline hover:opacity-75 focus:opacity-100 focus:shadow-none focus:outline-none"
          data-te-modal-dismiss
          aria-label="Close">
          <i class="fa-solid fa-x text-2xl self-end"></i>
        </button>
      </div>

      <!--Modal body-->
      <div class="relative p-4 flex dark:text-white">
        <p class="text-xl whitespace-normal">¿Seguro que quiere eliminar el registro "{{ $element}}"?</p>
      </div>

       <!--Modal footer-->
       <div
       class="gap-2 flex flex-shrink-0 flex-wrap items-center justify-end rounded-b-md p-4 dark:border-opacity-50">
       <x-secondary-button
         data-te-modal-dismiss
         data-te-ripple-init
         data-te-ripple-color="light">
         Cancelar
       </x-secondary-button>
       <form  method="POST" action="{{ route(''.$route.'',$id) }}">
        @method('delete')
        @csrf
        <x-danger-button
         data-te-ripple-init
         data-te-ripple-color="light">
         Sí, eliminar
       </x-danger-button>
       </form>
     </div>
    </div>
  </div>
</div> 