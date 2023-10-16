<section class="overflow-hidden overflow-x-auto">
    <div class="text-center w-full relative">
        <div class="hidden" id="myAlert">
            <x-alert></x-alert>
        </div>
    </div>

  

    {{-- TABLE --}}
    @if (count($alumnos) > 0)
    <table class="min-w-full text-left text-sm font-light pb-16 text-center text-gray-900 dark:text-gray-100">
        <thead class="border-b font-medium dark:border-neutral-500 dark:bg-slate-900">
          <tr>
            <th scope="col" class="px-6 py-4">#</th>
            <th scope="col" class="px-6 py-4">Aula</th>
            <th scope="col" class="px-6 py-4">Nombre</th>
            <th scope="col" class="px-6 py-4">Parentesco/Convive</th>
            <th scope="col" class="px-6 py-4">Estado</th>
            <th scope="col" class="px-6 py-4">Acciones</th>
          </tr>
        </thead>
        <tbody>
            @php
                $i = 1
            @endphp
            @foreach ($alumnos as $item)
            <tr
            class="border-b transition duration-300 ease-in-out hover:bg-neutral-100 dark:border-neutral-500 dark:hover:bg-neutral-600">
                <td class="whitespace-nowrap px-6 py-4 font-medium">
                    {{$i++}}
                </td>
                <td class="whitespace-nowrap px-6 py-4">{{$item->grado}} {{$item->seccion}}</td>
                <td class="whitespace-nowrap px-6 py-4">{{$item->nombre_apellidos}}</td>
                <td class="whitespace-nowrap px-6 py-4">{{$item->parentesco}} / {{$item->convivencia}}</td>
                <td class="whitespace-nowrap px-6 py-4">{{$item->estado}}</td>

                <td class="whitespace-nowrap px-6 py-4">
                    <x-secondary-button
                    data-te-toggle="modal"
                    data-te-target="#modalEdit-AA{{$item->idapoderado}}{{$item->idpostulante}}"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                    >
                    <i class="fas fa-edit"></i>
                </x-secondary-button>
                                                       
                    <x-danger-button
                        data-te-toggle="modal"
                        data-te-target="#exampleModalCenter-ParentA{{$item->idapoderado}}"
                        data-te-ripple-init
                        data-te-ripple-color="light"
                    >
                        <i class="fas fa-trash"></i>
                    </x-danger-button>
                </td>
            </tr> 
         
            <x-modal-delete :id="$item->idapoderado" :ids="$item->idpostulante" :entity="'ParentA'" :route="'parentesco.destroy'" :element="$item->nombre_apellidos"></x-modal-delete>
            @include('admision-matriculas.parentesco.partials.update', ['item' => $item, 'apoderado' => $apoderado, 'entity' => 'AA'])

            @endforeach
          
        </tbody>
      </table>
      @else
      <div class="relative">
        <h2 class="text-xs dark:text-white">Este apoderado no tiene alumnos asociados</h2>
      </div>
  @endif
</section>