<?php
require_once 'public/header.php';
require_once 'public/nav.php';
?>

<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Dispositivos</h1>

    <button id="createDeviceBtn" class="mb-4 bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition duration-200">
        Criar Novo Dispositivo
    </button>

    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead>
        <tr class="bg-gray-200">
            <th class="py-2 px-4">ID</th>
            <th class="py-2 px-4">Nome</th>
            <th class="py-2 px-4">Status</th>
            <th class="py-2 px-4">Setor</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($devices as $device): ?>
            <tr class="border-b">
                <td class="py-2 px-4"><?php echo htmlspecialchars($device['device_id']); ?></td>
                <td class="py-2 px-4"><?php echo htmlspecialchars($device['device_name']); ?></td>
                <td class="py-2 px-4"><?php echo htmlspecialchars($device['device_status']); ?></td>
                <td class="py-2 px-4"><?php echo htmlspecialchars($device['sector_id']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="createDeviceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criar Novo Dispositivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createDeviceForm" method="POST" action="/device/create">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="device_name">Nome</label>
                        <input type="text" class="form-control" id="name" name="device_name" required>
                    </div>
                    <div class="form-group">
                        <label for="sector_id">Setor</label>
                        <select class="form-control" id="sector_id" name="sector" required>
                            <?php foreach ($sectors as $sector): ?>
                                <option value="<?php echo htmlspecialchars($sector['sector_id']); ?>">
                                    <?php echo htmlspecialchars($sector['sector_name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="device_status">Status</label>
                        <select class="form-control" id="device_status" name="status" required>
                            <option value="ativo">Ativo</option>
                            <option value="inativo">Inativo</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#createDeviceBtn').click(function() {
            $('#createDeviceModal').modal('show');
        });
    });
</script>

<?php
require_once 'public/footer.php';
?>
