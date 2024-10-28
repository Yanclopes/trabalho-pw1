<?php
require_once 'public/header.php';
$isLast = false;
$deviceId = $_GET['device_id'] ?? null;

if (isset($questions['question_id'])) {
    $questionId = $questions['question_id'];
    $questionText = htmlspecialchars($questions['question_text']);
} else {
    $isLast = true;
    $questionText = "Muito obrigado por participar da pesquisa";
}
?>

<div class="feedback-container">
    <h1><?php echo $questionText; ?></h1>
    <?php if ($isLast): ?>
        <a href="/question?device_id=<?php echo htmlspecialchars($deviceId); ?>"><button class="submit-button">Voltar</button></a>
    <?php else: ?>
    <form action="/review/create" method="POST" onsubmit="return validateForm(this);">
        <input type="hidden" name="device_id" value="<?php echo htmlspecialchars($deviceId); ?>">
        <div class="flex flex-col w-full">
            <div>
                <input type="hidden" name="question_id" value="<?php echo $questionId; ?>">

,
                <p>Avalie seu atendimento de 0 a 10, onde 0 é péssimo, 5/6 é neutro, e 10 é ótimo.</p>

                <div class="rating-options">
                    <?php for ($i = 1; $i <= 10; $i++): ?>
                        <div class="rating-option">
                            <input type="radio" id="rating-<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" class="rating-checkbox">
                            <label for="rating-<?php echo $i; ?>" class="rating-label question"><?php echo $i; ?></label>
                        </div>
                    <?php endfor; ?>
                </div>
                <div id="error-message" class="text-red-500 mt-2 hidden">Por favor, selecione uma avaliação entre 1 e 10.</div>
            </div>

            <div class="flex flex-col">
                <label for="text" class="question">Descreva seu atendimento</label>
                <textarea name="text" id="text" class=""></textarea>
            </div>

            <button type="submit" class="submit-button">Enviar</button>
        </div>
        <?php endif; ?>
    </form>
</div>
</body>

