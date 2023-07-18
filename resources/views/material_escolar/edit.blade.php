<x-app-layout>
    {{-- Formulario de material_escolar --}}
    <div class="w-5/6 mx-auto">
        <section class="bg-blueGray-50 flex flex-row">
            <div class=" mb-12 xl:mb-0 px-4 mx-auto mt-10">
                <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded ">
                  <div class="rounded-t mb-0 px-4 py-3 border-0">
                    <div class="flex flex-wrap items-center">
                      <div class="relative w-full px-4 max-w-full flex-grow flex-1">
                        <h3 class="font-semibold text-base">Editar material</h3>
                     </div>
                    </div>
                  </div>
                  <div class="block w-full overflow-x-auto">
                      {{-- Formulario de Actualización de material_escolar --}}
                        <form action="{{ route('material_escolar.update',$material->material_id) }}" method="POST" class="m-auto">
                            @csrf
                            @method('PUT')
                            <div class="flex flex-wrap">
                            {{-- Nombre --}}
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase  font-bold mb-2" for="nombre">
                                        Nombre
                                    </label>
                                    <input type="text" name="nombre" id="nombre" value="{{ $material->nombre }}" placeholder="Nombre" class="border-0 px-3 py-3 bg-white rounded  shadow focus:outline-none focus:ring w-full ease-linear transition-all duration-150">
                                    @error('nombre')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Descripcion --}}
                            <div class="w-full lg:w-6/12 px-4">
                                <div class="relative w-full mb-3">
                                    <label class="block uppercase  text-xs font-bold mb-2" for="descripcion">
                                        Descripcion
                                    </label>
                                    <input type="text" name="descripcion" id="descripcion" value="{{ $material->descripcion }}" placeholder="Descripcion" class="border-0 px-3 py-3   bg-white rounded text-sm shadow focus
                                    :outline-none focus:ring w-full ease-linear transition-all duration-150 @error('descripcion') border-red-500 @enderror">
                                    @error('descripcion')
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            {{-- Boton --}}
                            <div class="w-full px-4 flex justify-start mt-5 ">
                                <div class="relative mb-3 mx-6">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        Guardar
                                    </button>
                                </div>
                                <div class="relative mb-3">
                                    <a href="{{ route('material_escolar.index') }}">
                                        <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Cancelar
                                        </button>
                                    </a>
                            </div>
                            </div> 
                        </form>
                  </div>
                  </div>
              </div>
        </section>
    </div>
</x-app-layout>