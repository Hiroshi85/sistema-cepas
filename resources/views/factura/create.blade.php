<x-app-layout>
    {{-- Formulario de factura --}}
    <div class="max-w-5xl mx-auto">
        <section class="">
            <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-10">
              <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                  <div class="flex flex-wrap items-center">
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                      <h3 class="font-semibold text-base text-blueGray-700">Nueva factura</h3>
                    </div>
                  </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <form action="{{ route('factura.store') }}" method="POST">
                        @csrf
                        <div class="flex flex-wrap">
                            {{-- Fecha --}}
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase  font-bold mb-2" for="fecha">
                                        Fecha
                                    </label>
                                    <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}" placeholder="Fecha" class="border-0 px-3 py-3 bg-white rounded  shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('fecha') border-red-500 @enderror">
                                    @error('fecha')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Proveedor --}}
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase  text-xs font-bold mb-2" for="proveedor">
                                        Proveedor
                                    </label>
                                    <select name="proveedor" id="proveedor" class="border-0 px-3 py-3 bg-white rounded  shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('proveedor') border-red-500 @enderror">
                                        <option value="">Seleccione un proveedor</option>
                                        @foreach ($proveedores as $proveedor)
                                            <option value="{{ $proveedor->proveedor_id }}">{{ $proveedor->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('proveedor')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
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
                                <a href="{{ route('factura.index') }}">
                                    <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Cancelar
                                    </button>
                                </a>
                        </div>
                    </form>
                </div>
                </div>
            </div>
                

            </section>
        </div>
</x-app-layout>