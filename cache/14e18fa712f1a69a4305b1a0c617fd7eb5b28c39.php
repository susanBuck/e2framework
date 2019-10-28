<!doctype html>
<html lang='en'>
<head>

    <title><?php echo $__env->yieldContent('title', $app->config('app.name')); ?></title>
    <meta charset='utf-8'>

    <link href='/css/app.css' rel='stylesheet'>

    <?php echo $__env->yieldContent('head'); ?>

</head>
<body>

<header>
    <img id='logo' src='/images/hes-logo.png' alt='Harvard Extension School Logo'>
    <h1><?php echo e($app->config('app.name')); ?></h1>
</header>

<main>
    <?php echo $__env->yieldContent('content'); ?>
</main>

<footer>
</footer>

<?php echo $__env->yieldContent('body'); ?>

</body>
</html><?php /**PATH /Users/Susan/Sites/hes/e2framework/views/templates/master.blade.php ENDPATH**/ ?>