@props(['data', 'headers', 'columns', 'columns_links'])
<div class="relative overflow-x-auto">
    <table class="w-full divide-y divide-gray-200 ">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    #
                </th>
                @foreach ($headers as $header)
                    <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ $header }}</th>
                @endforeach
                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Acciones</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($data as $index => $row)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                    @for ($i = 0; $i < count($columns); $i++)
                        @if (array_key_exists($columns[$i], $columns_links))
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ $row[$columns[$i]] }}" target="_blank">
                                    {{ $columns_links[$columns[$i]] }}
                                </a>
                            </td>
                        @else
                            <td class="px-6 py-4 whitespace-nowrap">{{ $row[$columns[$i]] }}</td>
                        @endif
                    @endfor
                    <td class="px-6 py-4 whitespace-nowrap flex">
                        <button class="text-indigo-600 hover:text-indigo-900" type="button">Editar</button>
                        <button class="text-red-600 hover:text-red-900 ml-2" type="button">Eliminar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
