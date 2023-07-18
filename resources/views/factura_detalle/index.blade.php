<x-app-layout>
    <div class="mx-auto">
        <section class="px-2 mx-auto flex">
          <div class="w-5/12 mb-12 xl:mb-0 px-4 mx-auto mt-10">
            <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
              <div class="rounded-t mb-0 px-4 py-3 border-0">
                <div class="flex flex-wrap items-center">
                  <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                    <h3 class="font-bold text-xl">Datos de la Factura</h3>
                    <p>ID: {{$factura->factura_id}}</p>
                    <p>Fecha: {{$factura->fecha}}</p>
                    <p>Proveedor: {{$factura->proveedor->nombre}}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <div class="w-7/12 mb-12 xl:mb-0 px-4 mx-auto mt-10">
              <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                  <div class="flex flex-wrap items-center">
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                      <h3 class=" text-base">Factura</h3>
                    </div>
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1 text-right">
                        <a href="{{ route('factura_detalle.create',$factura->factura_id) }}" class="bg-green-500 text-white active:bg-green-600 font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150">
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
                        <th class="px-6 align-middle border border-solid py-3 border-l-0 border-r-0 whitespace-nowrap text-center">Material</th>
                        <th class="px-6 align-middle border border-solid py-3 border-l-0 border-r-0 whitespace-nowrap text-center">Cantidad</th>
                        <th class="px-6 align-middle border border-solid py-3 border-l-0 border-r-0 whitespace-nowrap text-center">Precio Unitario</th>
                        <th class="px-6 align-middle border border-solid py-3 border-l-0 border-r-0 whitespace-nowrap text-center">Acciones</th>

                    </tr>
                    </thead>
                    <tbody>
                      <p class="hidden">{{$i=1}}</p>
                        @foreach ($factura_detalles as $detalle)
                        <tr>
                            <th class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4 text-left text-sky-800">
                              {{ $i++ }}</th>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                              {{ $detalle->material_escolar->nombre }}</td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                              {{ $detalle->cantidad}} </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                                {{ $detalle->precio_unitario}} </td>
                            <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                              <form action="{{url('materiales-escolares/factura/'.$detalle->factura_id.'/detalles/'.$detalle->factura_detalle_id)}}" method="POST">
                                 
                                @csrf
                                @method('DELETE')
                                <a href="{{ url('materiales-escolares/factura/'.$detalle->factura_id.'/detalles/'.$detalle->factura_detalle_id.'/editar') }}" class="bg-blue-500 text-white p-2 rounded-full">
                                  Editar
                                </a>
                                <button type="submit" class="bg-red-500 text-white p-2 rounded-full">
                                  Eliminar
                                </button>
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

