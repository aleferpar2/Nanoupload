<h1>Logeacion</h1>
<form method="POST" action="/">
    @csrf
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password">
        <button type="submit">Login</button>
</form>