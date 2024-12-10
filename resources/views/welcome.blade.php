<div class="bg-orchid p-4">
    @auth
        <span class="text-white">{{ Auth::user()->name }}</span>
        <a href="/logout" class="text-white ml-4">Logout</a>
    @else
        <a href="/login" class="text-white">Login</a>
    @endauth
</div>

@auth
<!-- Barra de búsqueda -->
<form action="{{ route('files.search') }}" method="GET" class="my-4">
    <input
        type="text"
        name="query"
        placeholder="Buscar archivos..."
        class="rounded border-gray-300 p-2 w-3/4"
    >
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Buscar</button>
</form>

<!-- Navegación en carpetas -->
<div class="my-4">
    @if ($currentFolder)
        <a href="{{ route('folders.index', $currentFolder->parent_id) }}" class="text-blue-500 hover:text-blue-700">
            ⬅ Volver a la carpeta anterior
        </a>
    @endif
    <h2 class="text-white text-lg font-bold">
        {{ $currentFolder ? $currentFolder->name : 'Raíz' }}
    </h2>
</div>

<!-- Crear nueva carpeta -->
<form action="{{ route('folders.create') }}" method="POST" class="bg-gray-800 p-4 rounded-lg shadow-lg">
    @csrf
    <input type="hidden" name="parent_id" value="{{ $currentFolder->id ?? null }}">
    <input
        type="text"
        name="name"
        placeholder="Nombre de la nueva carpeta"
        class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-md mb-4"
        required
    >
    <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-md hover:bg-green-600 transition">
        Crear carpeta
    </button>
</form>

<!-- Listado de carpetas -->
<div class="mt-6">
    <h3 class="text-white font-bold mb-2">Carpetas:</h3>
    <ul>
        @foreach ($folders as $folder)
            <li class="mb-2">
                <a href="{{ route('folders.index', $folder->id) }}" class="text-blue-500 hover:text-blue-700">
                    📁 {{ $folder->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

<!-- Tabla de archivos -->
<div class="mt-6">
    <h3 class="text-white font-bold mb-2">Archivos:</h3>
    <table class="min-w-full text-white">
        <thead>
            <tr>
                <th class="px-4 py-2">Acciones</th>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Tamaño</th>
                <th class="px-4 py-2">Propietario</th>
                <th class="px-4 py-2">Creado</th>
                <th class="px-4 py-2">Modificado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($files as $file)
                <tr class="border-t border-gray-600">
                    <td class="px-4 py-2">
                        @if ($file->trashed())
                        @can('restore', $file)
                            <!-- Botón para restaurar -->
                            <a href="{{ route('files.restore', $file->id) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                                🔄 Restaurar
                            </a>
                        @endcan
                        @else
                            <!-- Botón para borrar -->
                            @can('delete', $file)
                            <a href="{{ route('files.delete', $file->id) }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                                🗑 Borrar
                            </a>
                            @endcan
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="/download/{{$file->id}}" class="text-vsBlue hover:text-blue-600">{{$file->name}}</a>
                    </td>
                    <td class="px-4 py-2">{{$file->size()}}</td>
                    <td class="px-4 py-2">{{$file->user->name}}</td>
                    <td class="px-4 py-2">{{$file->created_at}}</td>
                    <td class="px-4 py-2">{{$file->updated_at}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endauth
