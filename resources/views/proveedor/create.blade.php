<x-app-layout>
    {{-- Formulario de Proveedor --}}
    <div class="max-w-5xl mx-auto">
        <section class="bg-blueGray-50">
            <div class="w-full xl:w-8/12 mb-12 xl:mb-0 px-4 mx-auto mt-10">
              <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                <div class="rounded-t mb-0 px-4 py-3 border-0">
                  <div class="flex flex-wrap items-center">
                    <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                      <h3 class="font-semibold text-base text-blueGray-700">Nuevo Proveedor</h3>
                    </div>
                  </div>
                </div>
                <div class="block w-full overflow-x-auto">
                    <form action="{{ route('proveedor.store') }}" method="POST">
                        @csrf
                        <div class="flex flex-wrap">
                            {{-- DNI --}}
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase  text-xs font-bold mb-2" for="dni">
                                        DNI
                                    </label>
                                    <input type="text" name="dni" id="dni" value="{{ old('dni') }}" placeholder="DNI" class="border-0 px-3 py-3   bg-white rounded text-sm shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150 @error('dni') border-red-500 @enderror">
                                    @error('dni')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Nombre --}}
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase  text-xs font-bold mb-2" for="nombre">
                                        Nombre
                                    </label>
                                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" placeholder="Nombre" class="border-0 px-3 py-3   bg-white rounded text-sm shadow focus
                                    :outline-none focus:ring w-full ease-linear transition-all duration-150 @error('nombre') border-red-500 @enderror">
                                    @error('nombre')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Direccion --}}
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase  text-xs font-bold mb-2" for="direccion">
                                    Direccion
                                    </label>
                                    <input type="text" name="direccion" id="direccion" value="{{ old('direccion') }}" placeholder="Direccion" class="border-0 px-3 py-3   bg-white rounded text-sm shadow focus
                                    :outline-none focus:ring w-full ease-linear transition-all duration-150 @error('direccion') border-red-500 @enderror">
                                    @error('direccion')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        {{-- Telefono --}}
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="block uppercase  text-xs font-bold mb-2" for="telefono">
                                    Telefono
                                </label>
                                <input type="text" name="telefono" id="telefono" value="{{ old('telefono') }}" placeholder="Telefono" class="border-0 px-3 py-3  bg-white rounded text-sm shadow focus
                                :outline-none focus:ring w-full ease-linear transition-all duration-150 @error('telefono') border-red-500 @enderror">
                                @error('telefono')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- Correo --}}
                        <div class="w-full lg:w-6/12 px-4">
                            <div class="relative w-full mb-3">
                                <label class="block uppercase  text-xs font-bold mb-2" for="correo">
                                    Correo
                                </label>
                                <input type="text" name="correo" id="correo" value="{{ old('correo') }}" placeholder="Correo" class="border-0 px-3 py-3  bg-white rounded text-sm shadow focus
                                :outline-none focus:ring w-full ease-linear transition-all duration-150 @error('correo') border-red-500 @enderror">
                                @error('correo')
                                    <span class="text-xs text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        <div class="w-full px-4 flex justify-start mt-5 ">
                            <div class="relative mb-3 mx-6">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Guardar
                                </button>
                            </div>
                            <div class="relative mb-3">
                                <a href="{{ route('proveedor.index') }}">
                                    <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Cancelar
                                    </button>
                                </a>
                        </div>
                    </form>
                </div>
            </section>
        </div>
</x-app-layout>