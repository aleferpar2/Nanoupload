<form method="POST" action="/login" class="bg-gray-800 p-8 rounded-lg shadow-lg max-w-sm w-full mx-auto">
    @csrf
    <h2 class="text-3xl font-bold text-center text-vsBlue mb-6">Bienvenido</h2>

    <div class="mb-4">
        <input type="email" name="email" placeholder="Email" class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-vsBlue">
    </div>

    <div class="mb-6">
        <input type="password" name="password" placeholder="Contraseña" class="w-full px-4 py-2 bg-gray-700 text-white border border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-vsBlue">
    </div>

    <div>
        <input type="submit" value="Iniciar sesión" class="w-full bg-vsBlue text-white py-2 rounded-md hover:bg-blue-600 transition duration-300">
    </div>
</form>
