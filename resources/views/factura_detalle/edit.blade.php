<x-app-layout>
    {{-- Formulario de factura_detalle --}}
    <div class="w-5/6 mx-auto">
        <section class="flex flex-row">
            
            <div class="w-1/4 mb-12 xl:mb-0 px-4 mx-auto mt-10">
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
              <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-10">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                  <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                      <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-base text-blueGray-700">Nuevo Detalle de Factura</h3>
                      </div>
                    </div>
                  </div>
                  <div class="block w-full overflow-x-auto">
                      <form action="{{url('materiales-escolares/factura/'.$factura->factura_id.'/detalles/'.$factura_detalle->factura_detalle_id)}}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="flex flex-wrap">
                              {{-- Material --}}
                              <div class="w-full px-4">
                                  <div class="relative w-full mb-3">
                                      <label class="block uppercase  text-xs font-bold mb-2" for="grid-password">Material</label>
                                      <select name="material_id" id="material_id" class="border-0 px-3 py-3 bg-gray-100  rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                          @foreach ($materiales as $material)
                                              <option value="{{$material->material_id}}">{{$material->nombre}}</option>
                                          @endforeach
                                      </select>
                                      @error('material_id')
                                          <p class="text-red-500 text-xs italic">{{$message}}</p>
                                      @enderror
                                  </div>
                              </div>
                              {{-- Cantidad --}}
                              <div class="w-full px-4">
                                  <div class="relative w-full mb-3">
                                      <label class="block uppercase  text-xs font-bold mb-2" for="grid-password">Cantidad</label>
                                      <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad" value="{{$factura_detalle->cantidad}}" class="border-0 px-3 py-3 bg-gray-100  rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                      @error('cantidad')
                                          <p class="text-red-500 text-xs italic">{{$message}}</p>
                                      @enderror
                                  </div>
                              </div>
                              {{-- Precio --}}
                              <div class="w-full px-4">
                                  <div class="relative w-full mb-3">
                                      <label class="block uppercase  text-xs font-bold mb-2" for="grid-password">Precio Unitario</label>
                                      <input type="number" name="precio" id="precio" placeholder="Precio" value="{{$factura_detalle->precio_unitario}}" class="border-0 px-3 py-3 bg-gray-100  rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                      @error('precio')
                                          <p class="text-red-500 text-xs italic">{{$message}}</p>
                                      @enderror
                                  </div>
                              </div>
  
                              
                          <div class="w-full px-4 flex justify-start mt-5 ">
                              <div class="relative mb-3 mx-6">
                                  <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                      Guardar
                                  </button>
                              </div>
                              <div class="relative mb-3">
                                  <a href="{{ route('factura_detalle.index', $factura->factura_id) }}">
                                      <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                          Cancelar
                                      </button>
                                  </a>
                          </div>
                          </div>
                          </div>
                      </form>
                  </div>
                  </div>
              </div>
                  

        </section>
    </div>
</x-app-layout>