<x-app-layout>   
    <x-slot name="header">
        <div class="w-full flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Mis postulantes') }}
            </h2>
            <h3 class="font-bold text-xl text-gray-800 dark:text-gray-200">
                @If(Auth::user()->hasRole('apoderado'))
                    {{ __('Sistema de apoderados') }}
                @endif 
            </h3>
        </div>
    </x-slot>
    <div class="flex flex-col md:flex-row"> 
        <div class="pb-4 md:py-12">
            <div class="mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class=" bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    <div class="w-full text-center block md:hidden">
                        <p class="text-center mt-2 text-gray-800 dark:text-gray-300">Postulante</p>
                    </div>
                    <ul class="mr-2 flex list-none flex-row md:flex-col flex-wrap pl-2" role="tablist" data-te-nav-ref>
                        <div class="px-1 hidden md:block">
                            <p class="text-center mt-2 text-gray-800 dark:text-gray-300">Postulante</p>
                        </div>
                        <li role="presentation" class="flex-grow text-center">
                            <a href="#tabs-home03"
                                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-gray-500 data-[te-nav-active]:text-gray-800 dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-cyan-100 dark:data-[te-nav-active]:text-cyan-100"
                                data-te-toggle="pill" data-te-target="#tabs-home03" data-te-nav-active role="tab"
                                aria-controls="tabs-home03" aria-selected="true">Datos generales</a>
                        </li>
                        <li role="presentation" class="flex-grow text-center">
                            <a href="#tabs-profile03"
                                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-gray-500 data-[te-nav-active]:text-gray-800 dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-cyan-100 dark:data-[te-nav-active]:text-cyan-100"
                                data-te-toggle="pill" data-te-target="#tabs-profile03" role="tab"
                                aria-controls="tabs-profile03" aria-selected="false">Documentos</a>
                        </li>
                        <li role="presentation" class="flex-grow text-center">
                            <a href="#tabs-messages03"
                                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-gray-500 data-[te-nav-active]:text-gray-800 dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-cyan-100 dark:data-[te-nav-active]:text-cyan-100"
                                data-te-toggle="pill" data-te-target="#tabs-messages03" role="tab"
                                aria-controls="tabs-messages03" aria-selected="false">Historial</a>
                        </li>
                        <li role="presentation" class="flex-grow text-center">
                            <a href="#tabs-apoderados"
                                class="my-2 block border-x-0 border-b-2 border-t-0 border-transparent px-7 pb-3.5 pt-4 text-xs font-medium uppercase leading-tight text-neutral-500 hover:isolate hover:border-transparent hover:bg-neutral-100 focus:isolate focus:border-transparent data-[te-nav-active]:border-gray-500 data-[te-nav-active]:text-gray-800 dark:text-neutral-400 dark:hover:bg-transparent dark:data-[te-nav-active]:border-cyan-100 dark:data-[te-nav-active]:text-cyan-100"
                                data-te-toggle="pill" data-te-target="#tabs-apoderados" role="tab"
                                aria-controls="tabs-apoderados" aria-selected="false">Apoderados</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
   
    <div class="md:py-12 w-full">
       <div class="mx-auto sm:px-6 lg:px-8 space-y-6 min-w-full">
           <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg min-w-full">
               <div class="hidden opacity-100 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                   id="tabs-home03" role="tabpanel" aria-labelledby="tabs-home-tab03" data-te-tab-active>
                   @include('admision-matriculas.postulante.partials.update-postulante')
               </div>
               <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                   id="tabs-profile03" role="tabpanel" aria-labelledby="tabs-profile-tab03">
                   @include('admision-matriculas.postulante.partials.docs')
               </div>
               <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                   id="tabs-messages03" role="tabpanel" aria-labelledby="tabs-profile-tab03">
                   @include('admision-matriculas.postulante.partials.history')
               </div>
               <div class="hidden opacity-0 transition-opacity duration-150 ease-linear data-[te-tab-active]:block"
                   id="tabs-apoderados" role="tabpanel" aria-labelledby="tabs-apoderados">
                   @include('admision-matriculas.parentesco.postulante-apoderados')
               </div>
             </div>
           </div>
       </div>
   
</div>

   </x-app-layout>
