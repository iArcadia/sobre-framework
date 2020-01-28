<?php

use SobreFramework\Core\Router;

$controller_class = Router::findController();
$controller = new $controller_class;
$view = $controller->exec();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= env('APP_NAME', 'Sobre Framework Project') ?> - <?= $controller->getTitle() ?></title>
</head>
<body>

<main>
    <?php if ($controller->getBreadcrumb()): $controller->getBreadcrumb()->render(); endif; ?>
    <?php $view->render(); ?>
</main>
</body>
</html>