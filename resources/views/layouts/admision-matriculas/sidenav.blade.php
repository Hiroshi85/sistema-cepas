<nav
  id="sidenav-2"
  class="fixed left-0 top-0 z-[1035] h-screen w-60 -translate-x-full overflow-hidden bg-white shadow-[0_4px_12px_0_rgba(0,0,0,0.07),_0_2px_4px_rgba(0,0,0,0.05)] data-[te-sidenav-hidden='false']:translate-x-0 dark:bg-gray-900"
  data-te-sidenav-init
  data-te-sidenav-hidden="true"
  data-te-sidenav-mode="side"
  ata-te-sidenav-accordion="true"
  data-te-sidenav-content="#content">
  <ul class="relative m-0 list-none " data-te-sidenav-menu-ref>
    <li class="relative">
        <a class="flex items-center" href="{{ route('dashboard') }}">
            <div class="flex items-center truncate text-[0.875rem]  outline-none transition duration-300 ease-linear hover:bg-gray-800 hover:outline-none focus:bg-slate-50 focus:outline-none active:bg-slate-50 active:text-white active:outline-none  data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-white dark:focus:bg-indigo-600 dark:active:bg-white/10">
                <x-application-logo-sm class="block h-9 w-auto fill-current" />
                <span
                class="group-[&[data-te-sidenav-slim-collapsed='true']]:data-[te-sidenav-slim='false']:hidden font-sans text-xl"
                data-te-sidenav-slim="false"
                >Colegio CEPAS</span
                >
            </div>
        </a>
    </li>
    <hr>
    {{-- MANTENEDORES --}}
    <li class="relative">
        <a
          class="flex data-[te-sidenav-state-active]:bg-indigo-600 h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-gray-100 hover:outline-none focus:bg-slate-50 focus:text-white  focus:outline-none active:bg-slate-50 active:text-white active:font-bold active:outline-none data-[te-sidenav-state-active]:text-white data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
          data-te-sidenav-link-ref>
          <span
            class="mr-4 [&>svg]:h-4 [&>svg]:w-4 [&>svg]:text-gray-400 dark:[&>svg]:text-gray-300">
            <i class="fa-solid fa-angle-down"></i>
          </span>
          <span class="text-lg">Mantenedores</span>
         
        </a>
        <ul
          class="flex flex-col !visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block text-center"
          data-te-sidenav-collapse-ref>
          <li class="relative">
            <a
              class="flex h-6 cursor-pointer items-center truncate rounded-[5px] py-4 pl-[3.4rem] pr-6 text-[1rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-gray-100 hover:outline-none focus:bg-slate-50 focus:text-white focus:outline-none active:bg-slate-50 active:text-white active:font-bold active:outline-none data-[te-sidenav-state-active]:text-white data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
              data-te-sidenav-link-ref
              href="{{ route('alumno.index') }}">
              
              <div class="flex gap-4">
                <i class="fa-solid fa-chalkboard-user"></i>
                {{ __('Alumnos') }}
              </div>
              </a
            >
          </li>
          <li class="relative">
            <a
              class="flex h-6 cursor-pointer items-center truncate rounded-[5px] py-4 pl-[3.4rem] pr-6 text-[1rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-gray-100 hover:outline-none focus:bg-slate-50 focus:text-white focus:outline-none active:bg-slate-50 active:text-white active:font-bold active:outline-none data-[te-sidenav-state-active]:text-white data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
              data-te-sidenav-link-ref
              href="{{ route('aula.index') }}">
              
              <div class="flex gap-4">
                <i class="fa-solid fa-door-open"></i>
                {{ __('Aulas') }}
              </div>
              </a
            >
          </li>
          <li class="relative">
            <a
              class="flex data-[te-sidenav-state-active]:bg-indigo-600 h-6 cursor-pointer items-center truncate rounded-[5px] py-4 pl-[3.4rem] pr-6 text-[1rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-gray-100 hover:outline-none focus:bg-slate-50 focus:text-white focus:outline-none active:bg-slate-50 active:text-white active:font-bold active:outline-none data-[te-sidenav-state-active]:text-white data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
              data-te-sidenav-link-ref
              href="{{ route('apoderado.index') }}">
              
              <div class="flex gap-4">
                <i class="fa-solid fa-people-roof"></i>
                {{ __('Apoderados') }}
              </div>
              </a
            >
          </li>
           {{-- ADMISIÓN --}}

        
            <li class="relative">
              <a
                class="flex h-6 cursor-pointer items-center truncate rounded-[5px] py-4 pl-[3.4rem] pr-6 text-[1rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-gray-100 hover:outline-none focus:bg-slate-50 focus:text-white focus:outline-none active:bg-slate-50 active:text-white active:font-bold active:outline-none data-[te-sidenav-state-active]:text-white data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
                data-te-sidenav-link-ref
                href="{{ route('postulante.index') }}">
                
                <div class="flex gap-4">
                  <i class="fa-solid fa-people-group"></i>
                  {{ __('Postulantes') }}
                </div>
                </a
              >
            </li>
           
            <li class="relative">
              <a
                class="flex h-6 cursor-pointer items-center truncate rounded-[5px] py-4 pl-[3.4rem] pr-6 text-[1rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-gray-100 hover:outline-none focus:bg-slate-50 focus:text-white focus:outline-none active:bg-slate-50 active:text-white active:font-bold active:outline-none data-[te-sidenav-state-active]:text-white data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
                data-te-sidenav-link-ref
                href="{{ route('entrevista.index') }}">
                
                <div class="flex gap-4">
                  <i class="fa-solid fa-clipboard-question mx-1"></i>
                  {{ __('Entrevistas') }}
                </div>
                </a
              >
            </li>
            {{-- ADMISIÓN LINKS END --}}
          </ul>
    </li>
 
      {{-- Reportes --}}
      <li class="relative">
        <a
          class="flex data-[te-sidenav-state-active]:bg-indigo-600 h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-gray-100 hover:outline-none focus:bg-slate-50 focus:text-white  focus:outline-none active:bg-slate-50 active:text-white active:font-bold active:outline-none data-[te-sidenav-state-active]:text-white data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
          data-te-sidenav-link-ref>
          <span
            class="mr-4 [&>svg]:h-4 [&>svg]:w-4 [&>svg]:text-gray-400 dark:[&>svg]:text-gray-300">
            <i class="fa-solid fa-angle-down"></i>
          </span>
          <span class="text-lg">Pagos</span>
         
        </a>
        <ul
          class="!visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block "
          data-te-sidenav-collapse-ref>
          <li class="relative">
            <a
              class=" flex h-6 cursor-pointer items-center truncate rounded-[5px] py-4 pl-[3.4rem] pr-6 text-[1rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-gray-100 hover:outline-none focus:bg-slate-50 focus:text-white focus:outline-none active:bg-slate-50 active:text-white active:font-bold active:outline-none data-[te-sidenav-state-active]:text-white data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
              data-te-sidenav-link-ref
              href="{{ route('pago.index') }}">
              
              <div class="flex gap-4">
                <i class="fa-solid fa-list-check mt-1"></i>
                <p>{{ __('Verificar') }}</p>
              </div>
              </a
            >
          </li>
        </ul>
      </li>
      {{-- Pefil --}}
      <li class="relative">
        <a
          class="flex data-[te-sidenav-state-active]:bg-indigo-600 h-12 cursor-pointer items-center truncate rounded-[5px] px-6 py-4 text-[0.875rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-gray-100 hover:outline-none focus:bg-slate-50 focus:text-white  focus:outline-none active:bg-slate-50 active:text-white active:font-bold active:outline-none data-[te-sidenav-state-active]:text-white data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
          data-te-sidenav-link-ref>
          <span
            class="mr-4 [&>svg]:h-4 [&>svg]:w-4 [&>svg]:text-gray-400 dark:[&>svg]:text-gray-300">
            <i class="fa-solid fa-angle-down"></i>
          </span>
          <span class="text-lg">Usuario</span>
         
        </a>
        <ul
          class="!visible relative m-0 hidden list-none p-0 data-[te-collapse-show]:block "
          data-te-sidenav-collapse-ref>
          <li class="relative">
            <a
              class=" flex h-6 cursor-pointer items-center truncate rounded-[5px] py-4 pl-[3.4rem] pr-6 text-[1rem] text-gray-600 outline-none transition duration-300 ease-linear hover:bg-slate-50 hover:text-gray-100 hover:outline-none focus:bg-slate-50 focus:text-white focus:outline-none active:bg-slate-50 active:text-white active:font-bold active:outline-none data-[te-sidenav-state-active]:text-white data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none dark:text-gray-300 dark:hover:bg-white/10 dark:focus:bg-white/10 dark:active:bg-white/10"
              data-te-sidenav-link-ref
              href="{{ route('profile.edit', ['id'=>Auth::user()->id]) }}">
              
              <div class="flex gap-4">
                <i class="fa-solid fa-user"></i>
                {{ __('Perfil') }}
              </div>
              </a
            >
          </li>

        </ul>
      </li>
</ul>
</nav>