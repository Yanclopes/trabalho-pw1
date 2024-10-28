<?php
require_once 'public/header.php';
require_once 'public/nav.php';
?>
<div class="container mx-auto mt-10">
    <h1 class="text-3xl font-bold mb-6">Perguntas</h1>

    <button id="createQuestionBtn" class="mb-4 bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition duration-200">
        Criar Nova Pergunta
    </button>

    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead>
        <tr class="bg-gray-200">
            <th class="py-2 px-4">ID</th>
            <th class="py-2 px-4">Texto da Pergunta</th>
            <th class="py-2 px-4">Status</th>
            <th class="py-2 px-4">Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($questions as $question): ?>
            <tr class="border-b">
                <td class="py-2 px-4"><?php echo htmlspecialchars($question['question_id']); ?></td>
                <td class="py-2 px-4"><?php echo htmlspecialchars($question['question_text']); ?></td>
                <td class="py-2 px-4"><?php echo htmlspecialchars($question['question_status']); ?></td>
                <td class="py-2 px-4">
                    <form method="POST" action="/question/<?php echo $question['question_id']; ?>/status">
                        <input type="hidden" name="question_id" value="<?php echo $question['question_id']; ?>">
                        <button type="submit" class="bg-<?php echo $question['question_status'] === 'ativa' ? 'red' : 'green'; ?>-500 text-white font-bold py-1 px-4 rounded hover:bg-<?php echo $question['question_status'] === 'ativa' ? 'red' : 'green'; ?>-600 transition duration-200">
                            <?php echo $question['question_status'] === 'ativa' ? 'Desativar' : 'Ativar'; ?>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="createQuestionModal" tabindex="-1" role="dialog" aria-labelledby="createQuestionLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createQuestionLabel">Criar Nova Pergunta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="createQuestionForm" method="POST" action="/question/create">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="question_text">Texto da Pergunta</label>
                        <input type="text" class="form-control" id="question_text" name="question_text" required>
                    </div>
                    <div class="form-group">
                        <label for="question_status">Status</label>
                        <select class="form-control" id="question_status" name="question_status" required>
                            <option value="ativa">Ativa</option>
                            <option value="inativa">Inativa</option>
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
        $('#createQuestionBtn').click(function() {
            $('#createQuestionModal').modal('show');
        });

        $('#createQuestionForm').on('submit', function(e) {
        });
    });
</script>
<?php
require_once 'public/footer.php';
?>
