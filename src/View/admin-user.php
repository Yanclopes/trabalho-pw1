
<?php
require_once 'public/header.php';
require_once 'public/nav.php';
?>
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Usuários</h1>

    <button id="createUserBtn" class="mb-4 bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition duration-200">
        Criar Novo Usuário
    </button>

    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead>
        <tr class="bg-gray-200">
            <th class="py-2 px-4">ID</th>
            <th class="py-2 px-4">Nome</th>
            <th class="py-2 px-4">Email</th>
            <th class="py-2 px-4">Criado Em</th>
            <th class="py-2 px-4">Admin</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr class="border-b">
                <td class="py-2 px-4"><?php echo htmlspecialchars($user['user_id']); ?></td>
                <td class="py-2 px-4"><?php echo htmlspecialchars($user['user_name']); ?></td>
                <td class="py-2 px-4"><?php echo htmlspecialchars($user['user_email']); ?></td>
                <td class="py-2 px-4"><?php echo htmlspecialchars($user['user_created_at']); ?></td>
                <td class="py-2 px-4"><?php echo $user['user_is_admin'] ? 'Sim' : 'Não'; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criar Novo Usuário</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createUserForm" method="POST" action="/user/create">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
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
        $('#createUserBtn').click(function() {
            $('#createUserModal').modal('show');
        });

        $('#createUserForm').on('submit', function(e) {
            const sessionToken = getCookie('SESSID');
            if (!sessionToken) {
                e.preventDefault();
                alert('Você não está autenticado. Por favor, faça login antes de criar um usuário.'); // Mensagem de erro
                return;
            }
            const payload = jwt_decode(sessionToken);
            console.log(payload)
            if (!payload.user.isAdmin) {
                e.preventDefault();
                alert('Você não tem permissão para criar um usuário.');
                return;
            }
        });
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        },
    });
</script>

<?php
require_once 'public/footer.php';
?>