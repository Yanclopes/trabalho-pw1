<?php require_once 'public/header.php'; ?>

<div class="container flex justify-center items-center h-screen">
    <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-4">
        <h1 class="text-2xl font-bold text-center mb-4">Login</h1>

        <form action="/login" method="POST" class="flex flex-col items-center gap-8">
            <div class="flex flex-col w-full items-center">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" id="email" name="email" required class="w-3 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500" placeholder="Seu email">
            </div>

            <div class="flex flex-col w-full items-center">
                <label for="password" class="block text-gray-700 font-medium mb-2">Senha</label>
                <input type="password" id="password" name="password" required class="w-3 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500" placeholder="Sua senha">
            </div>

            <button type="submit" class="w-3 bg-blue-500 text-white font-bold py-2 rounded hover:bg-blue-600 transition duration-200">Entrar</button>
        </form>
    </div>
</div>
</body>

