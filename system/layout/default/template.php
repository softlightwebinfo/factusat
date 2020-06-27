<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="description" content="<?= $this->meta_descripcion ?? ''; ?>">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $_layoutParams['ruta']; ?>plugins/images/logo-srp.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?= $this->titulo; ?></title>
    <link rel="stylesheet" href="<?= src('codeunic.css', 'libs/codeunic/css/') ?>">
    <link rel="stylesheet" href="<?= $_layoutParams['ruta_css']; ?>style.css">
</head>
<body class="<?= $this->classWrapp ?? ''; ?>" style="<?= $this->styleWrapp ?? ''; ?>">
<div id="wrapper">
    <main id="app">
        <?php include_once($this->contenido); ?>
    </main>
</div>
<?php echo funciones_js(); ?>
<script src="<?= src('js/jquery-3.1.1.min.js') ?>"></script>
<?php if (isset($_layoutParams['js_plugin']) && count($_layoutParams['js_plugin'])): ?>
    <?php foreach ($_layoutParams['js_plugin'] as $js): ?>
        <script src="<?php echo $js; ?>" type="text/javascript"></script>
    <?php endforeach; ?>
<?php endif; ?>
<?php if (isset($_layoutParams['js']) && count($_layoutParams['js'])): ?>
    <?php foreach ($_layoutParams['js'] as $js): ?>
        <script src="<?php echo $js; ?>" type="text/javascript"></script>
    <?php endforeach; ?>
<?php endif; ?>
<script src="<?= publicJs('index.bundle') ?>"></script>
<script src="<?= publicJs('main.bundle') ?>"></script>
</body>
</html>