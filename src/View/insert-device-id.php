<?php
require_once 'public/header.php';
?>

<div class="container flex flex-col items-center">
    <h1 class="text-2xl font-bold text-gray-900 mb-4">
        <?php echo isset($isInvalidDevice) ? 'Informe um dispositivo válido' : 'Dispositivo não configurado'; ?>
    </h1>
    <form action="/device/validate" method="GET" class="flex flex-col w-full max-w-md">
        <label for="device_id" class="text-base font-medium text-gray-700 mb-2">Digite o id do dispositivo:</label>
        <input type="number" id="device_id" name="device_id" required class="border border-gray-300 rounded p-2 mb-4">
        <button type="submit" class="bg-blue-500 text-white rounded p-2 hover:bg-blue-600">Enviar</button>
    </form>
</div>
</body>
