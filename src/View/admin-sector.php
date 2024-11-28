<?php
require_once 'public/header.php';
require_once 'public/nav.php';
?>

<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Setores</h1>

    <button id="createSectorBtn" class="mb-4 bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition duration-200">
        Criar Novo Setor
    </button>

    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead>
        <tr class="bg-gray-200">
            <th class="py-2 px-4">ID</th>
            <th class="py-2 px-4">Nome</th>
            <th class="py-2 px-4">Descrição</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($sectors as $sector): ?>
            <tr class="border-b">
                <td class="py-2 px-4"><?php echo htmlspecialchars($sector['sector_id']); ?></td>
                <td class="py-2 px-4"><?php echo htmlspecialchars($sector['sector_name']); ?></td>
                <td class="py-2 px-4"><?php echo htmlspecialchars($sector['sector_description']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="createSectorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criar Novo Setor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createSectorForm" method="POST" action="/sector/create">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="sector_name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="sector_description">Descrição</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
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
        $('#createSectorBtn').click(function() {
            $('#createSectorModal').modal('show');
        });
    });
</script>

<?php
require_once 'public/footer.php';
?>
