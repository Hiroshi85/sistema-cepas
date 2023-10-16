<section class="overflow-hidden overflow-x-auto">
    <div class="text-center w-full relative">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 uppercase">
                {{ __('Historial de matrículas') }}
            </h2>
        </header>
        <div class="hidden" id="myAlert">
            <x-alert></x-alert>
        </div>
    </div>

    {{-- TABLE --}}
    @if ($historial->count() > 0)
    <table class="min-w-full text-left text-sm font-light pb-16 text-center text-gray-900 dark:text-gray-100">
        <thead class="border-b font-medium dark:border-neutral-500 dark:bg-slate-900">
          <tr>
            <th scope="col" class="px-6 py-4">#</th>
            <th scope="col" class="px-6 py-4">Año</th>
            <th scope="col" class="px-6 py-4">Tarifa</th>
            <th scope="col" class="px-6 py-4">Aula</th>
            <th scope="col" class="px-6 py-4">Fecha de registro</th>
          </tr>
        </thead>
        <tbody>
            @php
                $i = 1
            @endphp
            @foreach ($historial as $item)
            <tr
            class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
                <td class="whitespace-nowrap px-6 py-4 font-medium">
                    {{$i++}}
                </td>
                <td class="whitespace-nowrap px-6 py-4">{{$item->año}}</td>
               
                <td class="whitespace-nowrap px-6 py-4">{{$item->tarifa}}</td>
                <td class="whitespace-nowrap px-6 py-4">{{$item->aula}}</td>
                <td class="whitespace-nowrap px-6 py-4">{{$item->fecha_registro}}</td>
            </tr> 
            @endforeach
        </tbody>
      </table>
    @else   
      <div class="m-2">
            <h2 class="text-xl dark:text-white">No hay registros de historial de matrículas</h2>
      </div>
    @endif
    
</section>