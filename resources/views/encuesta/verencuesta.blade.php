
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Realizar encuesta') }}
        </h2>
    </x-slot>
    @if (session('mensaje'))
        <div class="bg-green-200 text-green-800 p-4 mb-4 flash-message">
            {{ session('mensaje') }}
        </div>
        <script>
            setTimeout(function() {
                document.querySelector('.flash-message').remove();
            }, 3000);
        </script>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">  
                <div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto p-6">           
                    <h4 class="text-3xl font-bold dark:text-white">Informacion</h4>         
                    <p class="font-normal text-gray-700 dark:text-white">Encuesta: N°{{$e->idencuesta}}</p>
                    <p class="font-normal text-gray-700 dark:text-white">Aula: {{$e->cursoasignado->aula->grado}} {{$e->cursoasignado->aula->seccion}}</p>
                    <p class="font-normal text-gray-700 dark:text-white">Docente: {{$e->cursoasignado->docente->nombre}}</p>
                </div>              
            </div>
            <br>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">  
                <form action="{{route('registrarEncuesta',$e->idencuesta)}}" method="POST">                                
                    @csrf
                    @method('put')
                    <!-- Pregunta 1 -->
                    <div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto p-6">           
                        <h4 class="text-3xl font-bold dark:text-white">Pregunta 1
                        </h4>         
                        <p class="font-normal text-gray-700 dark:text-white">¿Cómo calificarías la claridad y organización de las explicaciones del docente durante las clases?</p>
                        <br>                
                        <div class="flex items-center space-x-8 w-full">
                            <div class="flex-1">
                                <input type="radio" id="opcion1" name="p1" class="form-radio text-blue-500" value="1" required>
                                <label for="opcion1" class="text-white">Pesimo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion2" name="p1" class="form-radio text-blue-500" value="2" required>
                                <label for="opcion2" class="text-white">Malo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion3" name="p1" class="form-radio text-blue-500" value="3" required>
                                <label for="opcion3" class="text-white">Regular</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion4" name="p1" class="form-radio text-blue-500" value="4" required>
                                <label for="opcion4" class="text-white">Bueno</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion5" name="p1" class="form-radio text-blue-500" value="5" required>
                                <label for="opcion5" class="text-white">Muy bueno</label>
                            </div>
                        </div>

                       
                    </div>  
                    <!-- Pregunta 2 -->
                    <div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto p-6">           
                        <h4 class="text-3xl font-bold dark:text-white">Pregunta 2 
                        </h4>         
                        <p class="font-normal text-gray-700 dark:text-white">En términos de accesibilidad y disponibilidad, ¿cómo evalúas la disposición del docente para ayudar y responder a tus preguntas fuera del horario de clases?</p>
                        <br>                
                        <div class="flex items-center space-x-8 w-full">
                            <div class="flex-1">
                                <input type="radio" id="opcion1" name="p2" class="form-radio text-blue-500" value="1" required>
                                <label for="opcion1" class="text-white">Pesimo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion2" name="p2" class="form-radio text-blue-500" value="2" required>
                                <label for="opcion2" class="text-white">Malo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion3" name="p2" class="form-radio text-blue-500" value="3" required>
                                <label for="opcion3" class="text-white">Regular</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion4" name="p2" class="form-radio text-blue-500" value="4" required>
                                <label for="opcion4" class="text-white">Bueno</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion5" name="p2" class="form-radio text-blue-500" value="5" required>
                                <label for="opcion5" class="text-white">Muy bueno</label>
                            </div>
                        </div>

                       
                    </div>  
                    <!-- Pregunta 3 -->
                    <div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto p-6">           
                        <h4 class="text-3xl font-bold dark:text-white">Pregunta 3 
                        </h4>         
                        <p class="font-normal text-gray-700 dark:text-white">¿Qué opinas sobre la variedad de métodos utilizados por el docente para facilitar el aprendizaje? (por ejemplo, presentaciones, ejercicios prácticos, discusiones)</p>
                        <br>                
                        <div class="flex items-center space-x-8 w-full">
                            <div class="flex-1">
                                <input type="radio" id="opcion1" name="p3" class="form-radio text-blue-500" value="1" required>
                                <label for="opcion1" class="text-white">Pesimo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion2" name="p3" class="form-radio text-blue-500" value="2" required>
                                <label for="opcion2" class="text-white">Malo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion3" name="p3" class="form-radio text-blue-500" value="3" required>
                                <label for="opcion3" class="text-white">Regular</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion4" name="p3" class="form-radio text-blue-500" value="4" required>
                                <label for="opcion4" class="text-white">Bueno</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion5" name="p3" class="form-radio text-blue-500" value="5" required>
                                <label for="opcion5" class="text-white">Muy bueno</label>
                            </div>
                        </div>

                       
                    </div> 
                    <!-- Pregunta 4 -->
                    <div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto p-6">           
                        <h4 class="text-3xl font-bold dark:text-white">Pregunta 4
                        </h4>         
                        <p class="font-normal text-gray-700 dark:text-white">¿Cómo calificarías la capacidad del docente para mantener un ambiente de clase positivo y participativo?</p>
                        <br>                
                        <div class="flex items-center space-x-8 w-full">
                            <div class="flex-1">
                                <input type="radio" id="opcion1" name="p4" class="form-radio text-blue-500" value="1" required>
                                <label for="opcion1" class="text-white">Pesimo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion2" name="p4" class="form-radio text-blue-500" value="2" required>
                                <label for="opcion2" class="text-white">Malo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion3" name="p4" class="form-radio text-blue-500" value="3" required>
                                <label for="opcion3" class="text-white">Regular</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion4" name="p4" class="form-radio text-blue-500" value="4" required>
                                <label for="opcion4" class="text-white">Bueno</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion5" name="p4" class="form-radio text-blue-500" value="5" required>
                                <label for="opcion5" class="text-white">Muy bueno</label>
                            </div>
                        </div>

                       
                    </div> 
                    <!-- Pregunta 5 -->
                    <div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto p-6">           
                        <h4 class="text-3xl font-bold dark:text-white">Pregunta 5
                        </h4>         
                        <p class="font-normal text-gray-700 dark:text-white">En cuanto a la retroalimentación proporcionada por el docente en tus trabajos y desempeño, ¿cómo la calificarías?</p>
                        <br>                
                        <div class="flex items-center space-x-8 w-full">
                            <div class="flex-1">
                                <input type="radio" id="opcion1" name="p5" class="form-radio text-blue-500" value="1" required>
                                <label for="opcion1" class="text-white">Pesimo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion2" name="p5" class="form-radio text-blue-500" value="2" required>
                                <label for="opcion2" class="text-white">Malo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion3" name="p5" class="form-radio text-blue-500" value="3" required>
                                <label for="opcion3" class="text-white">Regular</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion4" name="p5" class="form-radio text-blue-500" value="4" required>
                                <label for="opcion4" class="text-white">Bueno</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion5" name="p5" class="form-radio text-blue-500" value="5" required>
                                <label for="opcion5" class="text-white">Muy bueno</label>
                            </div>
                        </div>

                       
                    </div> 
                    <!-- Pregunta 6 -->
                    <div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto p-6">           
                        <h4 class="text-3xl font-bold dark:text-white">Pregunta 6
                        </h4>         
                        <p class="font-normal text-gray-700 dark:text-white">¿Qué tan útiles encuentras los recursos adicionales proporcionados por el docente para apoyar tu aprendizaje fuera del aula? (lecturas, enlaces, material adicional)</p>
                        <br>                
                        <div class="flex items-center space-x-8 w-full">
                            <div class="flex-1">
                                <input type="radio" id="opcion1" name="p6" class="form-radio text-blue-500" value="1" required>
                                <label for="opcion1" class="text-white">Pesimo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion2" name="p6" class="form-radio text-blue-500" value="2" required>
                                <label for="opcion2" class="text-white">Malo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion3" name="p6" class="form-radio text-blue-500" value="3" required>
                                <label for="opcion3" class="text-white">Regular</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion4" name="p6" class="form-radio text-blue-500" value="4" required>
                                <label for="opcion4" class="text-white">Bueno</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion5" name="p6" class="form-radio text-blue-500" value="5" required>
                                <label for="opcion5" class="text-white">Muy bueno</label>
                            </div>
                        </div>

                       
                    </div> 
                    <!-- Pregunta 7 -->
                    <div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto p-6">           
                        <h4 class="text-3xl font-bold dark:text-white">Pregunta 7
                        </h4>         
                        <p class="font-normal text-gray-700 dark:text-white">¿Cómo evalúas la comunicación del docente respecto a las expectativas del curso, fechas de evaluación y otros aspectos administrativos?</p>
                        <br>                
                        <div class="flex items-center space-x-8 w-full">
                            <div class="flex-1">
                                <input type="radio" id="opcion1" name="p7" class="form-radio text-blue-500" value="1" required>
                                <label for="opcion1" class="text-white">Pesimo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion2" name="p7" class="form-radio text-blue-500" value="2" required>
                                <label for="opcion2" class="text-white">Malo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion3" name="p7" class="form-radio text-blue-500" value="3" required>
                                <label for="opcion3" class="text-white">Regular</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion4" name="p7" class="form-radio text-blue-500" value="4" required>
                                <label for="opcion4" class="text-white">Bueno</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion5" name="p7" class="form-radio text-blue-500" value="5" required>
                                <label for="opcion5" class="text-white">Muy bueno</label>
                            </div>
                        </div>

                       
                    </div> 
                    <!-- Pregunta 8 -->
                    <div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto p-6">           
                        <h4 class="text-3xl font-bold dark:text-white">Pregunta 8 
                        </h4>         
                        <p class="font-normal text-gray-700 dark:text-white">En términos de actualización y relevancia de los contenidos del curso, ¿cómo consideras el enfoque del docente?
                        </p>
                        <br>                
                        <div class="flex items-center space-x-8 w-full">
                            <div class="flex-1">
                                <input type="radio" id="opcion1" name="p8" class="form-radio text-blue-500" value="1" required>
                                <label for="opcion1" class="text-white">Pesimo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion2" name="p8" class="form-radio text-blue-500" value="2" required>
                                <label for="opcion2" class="text-white">Malo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion3" name="p8" class="form-radio text-blue-500" value="3" required>
                                <label for="opcion3" class="text-white">Regular</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion4" name="p8" class="form-radio text-blue-500" value="4" required>
                                <label for="opcion4" class="text-white">Bueno</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion5" name="p8" class="form-radio text-blue-500" value="5" required>
                                <label for="opcion5" class="text-white">Muy bueno</label>
                            </div>
                        </div>

                       
                    </div> 
                    <!-- Pregunta 9 -->
                    <div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto p-6">           
                        <h4 class="text-3xl font-bold dark:text-white">Pregunta 9 
                        </h4>         
                        <p class="font-normal text-gray-700 dark:text-white">¿Qué tan efectivo crees que es el docente en fomentar la participación activa y el debate entre los estudiantes durante las clases?</p>
                        <br>                
                        <div class="flex items-center space-x-8 w-full">
                            <div class="flex-1">
                                <input type="radio" id="opcion1" name="p9" class="form-radio text-blue-500" value="1" required>
                                <label for="opcion1" class="text-white">Pesimo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion2" name="p9" class="form-radio text-blue-500" value="2" required>
                                <label for="opcion2" class="text-white">Malo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion3" name="p9" class="form-radio text-blue-500" value="3" required>
                                <label for="opcion3" class="text-white">Regular</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion4" name="p9" class="form-radio text-blue-500" value="4" required>
                                <label for="opcion4" class="text-white">Bueno</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion5" name="p9" class="form-radio text-blue-500" value="5" required>
                                <label for="opcion5" class="text-white">Muy bueno</label>
                            </div>
                        </div>

                       
                    </div> 
                    <!-- Pregunta 10 -->
                    <div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto p-6">           
                        <h4 class="text-3xl font-bold dark:text-white">Pregunta 10
                        </h4>         
                        <p class="font-normal text-gray-700 dark:text-white">¿En general, cómo calificarías la calidad del desempeño docente en este curso?
                        </p>
                        <br>                
                        <div class="flex items-center space-x-8 w-full">
                            <div class="flex-1">
                                <input type="radio" id="opcion1" name="p10" class="form-radio text-blue-500" value="1" required>
                                <label for="opcion1" class="text-white">Pesimo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion2" name="p10" class="form-radio text-blue-500" value="2" required>
                                <label for="opcion2" class="text-white">Malo</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion3" name="p10" class="form-radio text-blue-500" value="3" required>
                                <label for="opcion3" class="text-white">Regular</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion4" name="p10" class="form-radio text-blue-500" value="4" required>
                                <label for="opcion4" class="text-white">Bueno</label>
                            </div>
                            <div class="flex-1">
                                <input type="radio" id="opcion5" name="p10" class="form-radio text-blue-500" value="5" required>
                                <label for="opcion5" class="text-white">Muy bueno</label>
                            </div>
                        </div>

                       
                    </div> 




                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrar</button>
                        </div>
                </form>           
            </div>
            <br>
        </div>
        
    </div>

</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>


