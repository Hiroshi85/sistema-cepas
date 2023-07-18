
function changeThemeMode(){
    //Change localStorage theme: 'dark' or theme: 'light'
    var current = localStorage.getItem('theme');
    console.log(current);
    if (current === 'dark') {
      localStorage.setItem('theme', 'light');
    } else {
      localStorage.setItem('theme', 'dark');
    }
}

function resetea(){
    console.log("reset");
    var container = document.getElementById('apoderados-container');
     container.innerHTML = '';
    
    var select = document.getElementById('apoderados');
}

function asignarApoderados() {
    var select = document.getElementById('apoderados');
    var selectedApoderados = Array.from(select.selectedOptions, option => option.value);
    var nombres = Array.from(select.selectedOptions, option => option.text);
    console.log(nombres + selectedApoderados);
    var container = document.getElementById('apoderados-container');
    container.innerHTML = '';
    
    if (selectedApoderados.length > 0) {
        var counter = 0;
        selectedApoderados.forEach(function(apoderadoId) {

            var labelApoderado = document.createElement('labelApoderado');
            labelApoderado.textContent = nombres[counter++];
            labelApoderado.setAttribute('class', 'p-2 block text-sm font-medium text-gray-700 dark:text-gray-300');
            container.appendChild(labelApoderado);

            var inputParentesco = document.createElement('input');
            inputParentesco.setAttribute('type', 'text');
            inputParentesco.setAttribute('name', 'parentesco:' + apoderadoId);
            inputParentesco.setAttribute('id', 'parentesco:' + apoderadoId);
            inputParentesco.setAttribute('placeholder', 'Parentesco');
            inputParentesco.setAttribute('class', 'p-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm');
            inputParentesco.setAttribute('required', '');
            container.appendChild(inputParentesco);

            var inputConvivencia = document.createElement('input');
            inputConvivencia.setAttribute('type', 'checkbox');
            inputConvivencia.setAttribute('name', 'convivencia:' + apoderadoId);
            inputConvivencia.setAttribute('id', 'convivencia:' + apoderadoId);
            inputConvivencia.classList.add('px-2', 'rounded', 'dark:bg-gray-900', 'border-gray-300', 'dark:border-gray-700', 'text-indigo-600', 'shadow-sm', 'focus:ring-indigo-500', 'dark:focus:ring-indigo-600', 'dark:focus:ring-offset-gray-800');
            container.appendChild(inputConvivencia);

            var label = document.createElement('label');
            label.textContent = '¿Convive con el apoderado?   ';
            label.setAttribute('class', 'px-2 block text-sm font-medium text-gray-700 dark:text-gray-300');
            label.appendChild(inputConvivencia);
            container.appendChild(label);
        });
    }
}

//Show-hide entrevistaForm
function showEntrevistaForm(show){
    console.log("click");
    var container = document.getElementById('entrevistaForm');
    var select = document.getElementById('postulantes');
    var selectedPostulantes = Array.from(select.selectedOptions, option => option.value);
    show && selectedPostulantes.length > 0 ?  container.classList.remove('hidden') : container.classList.add('hidden');
}