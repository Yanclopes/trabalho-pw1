<?php require_once 'public/header.php'; ?>

<div class="container flex justify-center items-center h-screen">
    <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-4">
        <h1 class="text-2xl font-bold text-center mb-4">Alterar Senha</h1>

        <form id="changePasswordForm" action="/change-password" method="POST" class="flex flex-col items-center gap-8">
            <div class="flex flex-col w-full items-center">
                <label for="current_password" class="block text-gray-700 font-medium mb-2">Senha Antiga</label>
                <input type="password" id="current_password" name="current_password" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500" placeholder="Sua senha antiga">
            </div>
            <div class="flex flex-col w-full items-center">
                <label for="new_password" class="block text-gray-700 font-medium mb-2">Nova Senha</label>
                <input type="password" id="new_password" name="new_password" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500" placeholder="Sua nova senha">
                <small class="text-gray-500">A senha deve ter pelo menos 8 caracteres, incluindo 1 letra maiúscula, 1 número e 1 caractere especial.</small>
            </div>
            <div class="flex flex-col w-full items-center">
                <label for="confirm_password" class="block text-gray-700 font-medium mb-2">Confirmar Nova Senha</label>
                <input type="password" id="confirm_password" name="confirm_password" required class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500" placeholder="Confirme sua nova senha">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 rounded hover:bg-blue-600 transition duration-200">Alterar Senha</button>
        </form>
        <div id="error_message" class="text-red-500 text-center mt-4 hidden">As senhas não coincidem ou não atendem aos requisitos de segurança.</div>
    </div>
</div>

<script>
    document.getElementById('changePasswordForm').addEventListener('submit', function(event) {
        const newPassword = document.getElementById('new_password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        const errorMessage = document.getElementById('error_message');
        const passwordRegex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_]).{8,}$/;

        if (newPassword !== confirmPassword || !passwordRegex.test(newPassword)) {
            event.preventDefault();
            errorMessage.classList.remove('hidden');
        } else {
            errorMessage.classList.add('hidden');
        }
    });
</script>
