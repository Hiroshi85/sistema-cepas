<x-app-layout>
    <div class="mx-auto">
        <section class="px-2 mx-auto">
            <div class="w-full mb-12 xl:mb-0 px-4 mx-auto mt-10">
              <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                  <div class="flex flex-wrap items-center">
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                      <h3 class=" text-base">Proveedores</h3>
                    </div>
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                        <a href="{{ route('proveedor.create') }}" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
                            Nuevo
                        </a>
                    </div>
                  </div>
                </div>
            
                <div class="block w-full overflow-x-auto">
                  <table class="items-center bg-transparent w-full border-collapse ">
                    <thead>
                      <tr>
                        <th class="px-6 align-middle border border-solid py-3 border-l-0 border-r-0 whitespace-nowrap text-center">#</th>
                        <th class="px-6 align-middle border border-solid py-3 border-l-0 border-r-0 whitespace-nowrap text-center">DNI</th>
                        <th class="px-6 align-middle border border-solid py-3 border-l-0 border-r-0 whitespace-nowrap text-center">Nombre</th>
                        <th class="px-6 align-middle border border-solid py-3 border-l-0 border-r-0 whitespace-nowrap text-center">Correo</th>
                        <th class="px-6 align-middle border border-solid py-3 border-l-0 border-r-0 whitespace-nowrap text-center">Teléfono</th>
                        <th class="px-6 align-middle border border-solid py-3 border-l-0 border-r-0 whitespace-nowrap text-center">Dirección</th>
                        <th class="px-6 align-middle border border-solid py-3 border-l-0 border-r-0 whitespace-nowrap text-center">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($proveedores as $proveedor)
                        <tr>
                            <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4 text-left text-sky-800">
                              {{ $proveedor->proveedor_id }}</th>
                              <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                                {{ $proveedor->dni }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                              {{ $proveedor->nombre }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                              {{ $proveedor->correo }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                              {{ $proveedor->telefono }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                              {{ $proveedor->direccion }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                              <a href="{{ route('proveedor.edit',$proveedor->proveedor_id) }}" class="bg-blue-500 text-white p-2 rounded-full">
                                Editar</a>
                              {{-- Formulario Eliminar --}}
                               <form action="{{  route('proveedor.destroy',$proveedor) }}" method="POST" class="inline-block m-auto">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white p-2 rounded-full">
                                  Eliminar</button>
                              </form> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            
                  </table>
                </div>
              </div>
            </div>
        </section>
    </div>
</x-app-layout>

