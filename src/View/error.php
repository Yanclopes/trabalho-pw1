<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .error-container { text-align: center; padding: 50px; }
        .error-title { font-size: 24px; color: red; }
    </style>
</head>
<body>
<div class="error-container">
    <h1 class="error-title"><?php echo $exception->getMessage() ?></h1>
    <p>Por favor, tente novamente mais tarde.</p>
</div>
</body>
</html>
