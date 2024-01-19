<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resultados de la Encuesta') }}
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
    @if(count($encuestas) > 0)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-" id="active">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">  
                <div class="col-span-1 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mx:auto p-6">           

                    <p class="font-normal text-gray-700 dark:text-gray-400">Para el docente: 1</p>
                </div>
                <div class="flex flex-wrap">
                    <div class="mx-8 w-1/3">
                        <h2 class="font-normal text-gray-700 dark:text-gray-100">Pregunta 1</h2>
                        <p class="font-normal text-gray-700 dark:text-gray-100">¿Cómo calificarías la claridad y organización de las explicaciones del docente durante las clases?</p>
                        <canvas id="miGraficoCircular" width="400" height="400"></canvas>
                    </div>
                    <div class="mx-auto w-1/3">
                        
                    </div>
                    <div class="mx-auto w-1/3">
                        
                    </div>
                </div>         
            </div>
            <br>
        </div>
    @else
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-" id="results">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">                
                <div class="p-6 text-gray-900 dark:text-gray-100 flex">
                    <p class="mx-10 my-3 text-sm text-center" >No hay encuestas disponibles.</p>
                </div>
            </div>
            <br>
        </div>
    @endif
    </div>
    <script>
        // Extrae los resultados de la primera encuesta (puedes iterar según tus necesidades)
        function contarFrecuencia(strings) {
            var frecuencia = [0, 0, 0, 0, 0]; // Índices representan los números 1, 2, 3, 4, 5

            strings.forEach(function (str) {
                var primerDigito = str.charAt(0);
                var indice = parseInt(primerDigito) - 1;
                
                if (!isNaN(indice)) {
                    frecuencia[indice]++;
                }
            });

            return frecuencia;
        }


        // Ejemplo de strings aleatorios
        var resultadosEncuesta = @json($encuestas);
        console.log(resultadosEncuesta);
        //var resultados = ['1452113214', '5213121445', '3521412355', '2153451231'];

        // Obtén la frecuencia de los números en la primera posición
        var frecuenciaResultados = contarFrecuencia(resultadosEncuesta);

        var labels = ['Pesimo','Malo','Regular','Bueno','Muy Bueno'];
        // Configura los datos para el gráfico circular
        var datosGrafico = {
            labels: labels,
            datasets: [{
                data: Object.values(frecuenciaResultados),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(0, 255, 0, 0.5)',  // Nuevo color
                    'rgba(0, 255, 255, 0.5)',
                    // Puedes añadir más colores según la cantidad de opciones
                ],
            }],
        };

        // Obtén el contexto del canvas
        var ctx = document.getElementById('miGraficoCircular').getContext('2d');

        // Crea el gráfico circular
        var miGraficoCircular = new Chart(ctx, {
            type: 'pie',
            data: datosGrafico,
        });
    </script>     

</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>


