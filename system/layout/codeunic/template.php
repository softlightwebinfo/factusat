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
    <?php if (!isset($this->header) OR ($this->header == true)): ?>
        <header class="Header">
            <div class="Header__content">
                <div class="Header__item Header__search rd-hidden-sm-max">
                    <a href="<?= base_url(''); ?>">
                        <img src="<?= ruta_public('iconos/logo-noname.svg') ?>" class="Header__logo" alt="">
                    </a>
                    <div class="ComboBox">
                        <div class="ComboBox__search">
                            <svg class="ComboBox__icono" aria-hidden="true">
                                <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                     xlink:href="<?= srcLib('codeunic', 'assets/icons/symbols.svg#search') ?>"></use>
                            </svg>
                            <input tabindex="1" autofocus type="text" autocomplete="off" class="ComboBox__input"
                                   placeholder="Buscar anuncios"/>
                        </div>
                        <ul class="ComboBox-list ComboBox__list">
                            <li class="ComboBox-list__item">
                                <h3 class="ComboBox-list__title">Recent Items</h3>
                            </li>
                            <li class="ComboBox-list__item">
                                <div class="ComboBox-item">
                                    <svg class="ComboBox-item__figure">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="<?= srcLib('codeunic', 'assets/icons/standard.svg#opportunity') ?>"></use>
                                    </svg>
                                    <div class="ComboBox-item__body">
                                        <span class="ComboBox-item__title">Salesforce - 1,000 Licenses</span>
                                        <span class="ComboBox-item__category">
                                        Opportunity • Prospecting
                                    </span>
                                    </div>
                                </div>
                            </li>
                            <li class="ComboBox-list__item">
                                <div class="ComboBox-item">
                                    <svg class="ComboBox-item__figure">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="<?= srcLib('codeunic', 'assets/icons/standard.svg#opportunity') ?>"></use>
                                    </svg>
                                    <div class="ComboBox-item__body">
                                        <span class="ComboBox-item__title">Salesforce - 1,000 Licenses</span>
                                        <span class="ComboBox-item__category">
                                        Opportunity • Prospecting
                                    </span>
                                    </div>
                                </div>
                            </li>
                            <li class="ComboBox-list__item">
                                <div class="ComboBox-item">
                                    <svg class="ComboBox-item__figure">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="<?= srcLib('codeunic', 'assets/icons/standard.svg#opportunity') ?>"></use>
                                    </svg>
                                    <div class="ComboBox-item__body">
                                        <span class="ComboBox-item__title">Salesforce - 1,000 Licenses</span>
                                        <span class="ComboBox-item__category">
                                        Opportunity • Prospecting
                                    </span>
                                    </div>
                                </div>
                            </li>
                            <li class="ComboBox-list__item">
                                <div class="ComboBox-item">
                                    <svg class="ComboBox-item__figure">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="<?= srcLib('codeunic', 'assets/icons/standard.svg#opportunity') ?>"></use>
                                    </svg>
                                    <div class="ComboBox-item__body">
                                        <span class="ComboBox-item__title">Salesforce - 1,000 Licenses</span>
                                        <span class="ComboBox-item__category">
                                        Opportunity • Prospecting
                                    </span>
                                    </div>
                                </div>
                            </li>
                            <li class="ComboBox-list__item">
                                <div class="ComboBox-item">
                                    <svg class="ComboBox-item__figure">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="<?= srcLib('codeunic', 'assets/icons/standard.svg#opportunity') ?>"></use>
                                    </svg>
                                    <div class="ComboBox-item__body">
                                        <span class="ComboBox-item__title">Salesforce - 1,000 Licenses</span>
                                        <span class="ComboBox-item__category">
                                        Opportunity • Prospecting
                                    </span>
                                    </div>
                                </div>
                            </li>
                            <li class="ComboBox-list__item">
                                <div class="ComboBox-item">
                                    <svg class="ComboBox-item__figure">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="<?= srcLib('codeunic', 'assets/icons/standard.svg#opportunity') ?>"></use>
                                    </svg>
                                    <div class="ComboBox-item__body">
                                        <span class="ComboBox-item__title">Salesforce - 1,000 Licenses</span>
                                        <span class="ComboBox-item__category">
                                        Opportunity • Prospecting
                                    </span>
                                    </div>
                                </div>
                            </li>
                            <li class="ComboBox-list__item">
                                <div class="ComboBox-item">
                                    <svg class="ComboBox-item__figure">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="<?= srcLib('codeunic', 'assets/icons/standard.svg#opportunity') ?>"></use>
                                    </svg>
                                    <div class="ComboBox-item__body">
                                        <span class="ComboBox-item__title">Salesforce - 1,000 Licenses</span>
                                        <span class="ComboBox-item__category">
                                        Opportunity • Prospecting
                                    </span>
                                    </div>
                                </div>
                            </li>
                            <li class="ComboBox-list__item">
                                <div class="ComboBox-item">
                                    <svg class="ComboBox-item__figure">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="<?= srcLib('codeunic', 'assets/icons/standard.svg#opportunity') ?>"></use>
                                    </svg>
                                    <div class="ComboBox-item__body">
                                        <span class="ComboBox-item__title">Salesforce - 1,000 Licenses</span>
                                        <span class="ComboBox-item__category">
                                        Opportunity • Prospecting
                                    </span>
                                    </div>
                                </div>
                            </li>
                            <li class="ComboBox-list__item">
                                <div class="ComboBox-item">
                                    <svg class="ComboBox-item__figure">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="<?= srcLib('codeunic', 'assets/icons/standard.svg#opportunity') ?>"></use>
                                    </svg>
                                    <div class="ComboBox-item__body">
                                        <span class="ComboBox-item__title">Salesforce - 1,000 Licenses</span>
                                        <span class="ComboBox-item__category">
                                        Opportunity • Prospecting
                                    </span>
                                    </div>
                                </div>
                            </li>
                            <li class="ComboBox-list__item">
                                <div class="ComboBox-item">
                                    <svg class="ComboBox-item__figure">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="<?= srcLib('codeunic', 'assets/icons/standard.svg#opportunity') ?>"></use>
                                    </svg>
                                    <div class="ComboBox-item__body">
                                        <span class="ComboBox-item__title">Salesforce - 1,000 Licenses</span>
                                        <span class="ComboBox-item__category">
                                        Opportunity • Prospecting
                                    </span>
                                    </div>
                                </div>
                            </li>
                            <li class="ComboBox-list__item">
                                <div class="ComboBox-item">
                                    <svg class="ComboBox-item__figure">
                                        <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xlink:href="<?= srcLib('codeunic', 'assets/icons/standard.svg#opportunity') ?>"></use>
                                    </svg>
                                    <div class="ComboBox-item__body">
                                        <span class="ComboBox-item__title">Salesforce - 1,000 Licenses</span>
                                        <span class="ComboBox-item__category">
                                        Opportunity • Prospecting
                                    </span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <ul class="Header__item List List--horizontal Header-list">
                    <?php if ($this->_acl->isRol('Administrador')): ?>
                        <li class="List__item rd-hidden-sm-max">
                            <a href="<?= base_url('codeunic/') ?>" class="Button Button--neutral">
                                Administración
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (!Session::accesoViewSimple()): ?>
                        <li class="List__item rd-hidden-sm-max">
                            <a href="<?= base_url('usuario/login/') ?>" class="Button Button--neutral">
                                Login
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if (Session::accesoViewSimple()): ?>
                        <?php if (!$this->_acl->isRol('Administrador')): ?>
                            <li class="List__item rd-hidden-sm-max">
                                <a href="<?= base_url('panel/') ?>" class="Button Button--neutral">
                                    Panel de control
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <li class="List__item rd-hidden-sm-max">
                        <a href="<?= base_url('anuncios/') ?>" class="Button Button--neutral">
                            Listado de animales
                        </a>
                    </li>
                    <?php if (Session::accesoViewSimple()): ?>
                        <li class="List__item">
                            <button class="Button Button--icon">
                                <svg class="Button__icon Icon Icon--medium Icon--star">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                         xlink:href="<?= srcLib('codeunic', 'assets/icons/symbols.svg#favorite') ?>"></use>
                                </svg>
                            </button>
                        </li>
                        <li class="List__item">
                            <button class="Button Button--icon">
                                <svg class="Button__icon Icon Icon--medium">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                         xlink:href="<?= srcLib('codeunic', 'assets/icons/symbols.svg#question') ?>"></use>
                                </svg>
                            </button>
                        </li>
                        <li class="List__item">
                            <a href="<?= base_url('panel/configuracion/'); ?>" class="Button Button--icon">
                                <svg class="Button__icon Icon Icon--medium">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                         xlink:href="<?= srcLib('codeunic', 'assets/icons/symbols.svg#setup') ?>"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="List__item">
                            <button class="Button Button--icon">
                                <svg class="Button__icon Icon Icon--medium">
                                    <use xmlns:xlink="http://www.w3.org/1999/xlink"
                                         xlink:href="<?= srcLib('codeunic', 'assets/icons/symbols.svg#notification') ?>"></use>
                                </svg>
                            </button>
                        </li>
                        <li class="List__item c-Dropdown">
                            <button class="Button Button--icon c-Dropdown__trigger">
                               <span class="Avatar Avatar--circle">
                                   <img src="<?= srcLib('codeunic', 'assets/images/avatar2.jpg') ?>"
                                        class="Avatar__image" alt="">
                               </span>
                            </button>
                            <ul class="c-Dropdown__menu">
                                <li class="c-Dropdown__item">
                                    <a href="<?= base_url('panel/') ?>" class="c-Dropdown__link">Panel de control</a></li>
                                <li class="c-Dropdown__item"><a href="<?= base_url('panel/configuracion/') ?>" class="c-Dropdown__link">Configuración</a></li>
                                <li class="c-Dropdown__item"><a href="<?= base_url('contacto/'); ?>"
                                                                class="c-Dropdown__link">Contactar</a></li>
                                <li class="c-Dropdown__item"><a href="" class="c-Dropdown__link">Perfil</a></li>
                                <li class="c-Dropdown__item--separate"></li>
                                <li class="c-Dropdown__item"><a href="<?= base_url('usuario/cerrar-session/') ?>"
                                                                class="c-Dropdown__link">Cerrar sessión</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </header>
    <?php endif; ?>
    <main class="Grilla">
        <aside class="c-Menu">
            <div class="c-User-info">
                <div class="c-User-info__avatar Avatar Avatar--circle Avatar--large--x">
                    <img class="c-User-info__image Avatar__image" src="<?= imageUrl('avatar.jpg') ?>" alt="">
                </div>
                <span class="c-User-info__info">Bienvenido</span>
                <h2 class="c-User-info__name"><?= ucfirst($this->_user->getUser()->getUsuario()); ?></h2>
                <ul class="c-User-info__lista Lista Lista--horizontal">
                    <li class="Lista__item"><a href="" class="Lista__link--white"><i class="fa fa-envelope"></i></a>
                    </li>
                    <li class="Lista__item"><a href="" class="Lista__link--white"><i class="fa fa-user"></i></a></li>
                    <li class="Lista__item"><a href="<?= base_url('usuario/cerrar-session/') ?>"
                                               class="Lista__link--white"><i class="fa fa-sign-out"></i></a></li>
                    <li class="Lista__item"><a href="" class="Lista__link--white"><i class="fa fa-cog"></i></a></li>
                </ul>
                <div class="c-User-info__settings">
                    <h4 class="c-User-info__title">Reportes de hoy</h4>
                    <span class="c-User-info__report">
                        456
                        <span class="c-User-info__text">Ventas</span>
                    </span>
                    <span class="c-User-info__report">
                        2,345
                        <span class="c-User-info__text">Ordenes</span>
                    </span>
                    <span class="c-User-info__report">
                        456
                        <span class="c-User-info__text">Beneficios</span>
                    </span>
                </div>
            </div>
            <ul class="c-Menu-list">
                <li class="c-Menu-list__header">Menu de navegación</li>
                <li class="c-Menu-list__item">
                    <a href="<?= base_url('codeunic/') ?>" class="c-Menu-list__a"><i
                                class="c-Menu-list__icon fa fa-home"></i>Dashboard</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="<?= base_url('codeunic/generar-pojos/') ?>" class="c-Menu-list__a"><i
                                class="c-Menu-list__icon fa fa-home"></i>Generar Pojos</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="<?= base_url('codeunic/usuarios/') ?>" class="c-Menu-list__a"><i
                                class="c-Menu-list__icon fa fa-home"></i>Usuarios</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="<?= base_url('codeunic/roles/'); ?>" class="c-Menu-list__a"><i
                                class="c-Menu-list__icon fa fa-home"></i>Roles</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="<?= base_url('codeunic/provincias/'); ?>" class="c-Menu-list__a"><i
                                class="c-Menu-list__icon fa fa-home"></i>Provincias</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="<?= base_url('codeunic/municipios/'); ?>" class="c-Menu-list__a"><i
                                class="c-Menu-list__icon fa fa-home"></i>Municipios</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="<?= base_url('codeunic/nacionalidades/'); ?>" class="c-Menu-list__a"><i
                                class="c-Menu-list__icon fa fa-home"></i>Nacionalidades</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="<?= base_url('codeunic/razas/') ?>" class="c-Menu-list__a"><i
                                class="c-Menu-list__icon fa fa-home"></i>Tipos animales</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="<?= base_url('codeunic/caracteristicas/') ?>" class="c-Menu-list__a"><i class="c-Menu-list__icon fa fa-home"></i>Caracteristicas Animales</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="<?= base_url('api/loadPerreraPalma/') ?>" class="c-Menu-list__a"><i class="c-Menu-list__icon fa fa-home"></i>Insertar animales palma</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="<?= base_url('api/loadPerreraInca/') ?>" class="c-Menu-list__a"><i class="c-Menu-list__icon fa fa-home"></i>Insertar animales Inca</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="" class="c-Menu-list__a"><i class="c-Menu-list__icon fa fa-home"></i>Dashboard</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="" class="c-Menu-list__a"><i class="c-Menu-list__icon fa fa-home"></i>Dashboard</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="" class="c-Menu-list__a"><i class="c-Menu-list__icon fa fa-home"></i>Dashboard</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="" class="c-Menu-list__a"><i class="c-Menu-list__icon fa fa-home"></i>Dashboard</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="" class="c-Menu-list__a"><i class="c-Menu-list__icon fa fa-home"></i>Dashboard</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="" class="c-Menu-list__a"><i class="c-Menu-list__icon fa fa-home"></i>Dashboard</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="" class="c-Menu-list__a"><i class="c-Menu-list__icon fa fa-home"></i>Dashboard</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="" class="c-Menu-list__a"><i class="c-Menu-list__icon fa fa-home"></i>Dashboard</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="" class="c-Menu-list__a"><i class="c-Menu-list__icon fa fa-home"></i>Dashboard</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="" class="c-Menu-list__a"><i class="c-Menu-list__icon fa fa-home"></i>Dashboard</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="" class="c-Menu-list__a"><i class="c-Menu-list__icon fa fa-home"></i>Dashboard</a>
                </li>
                <li class="c-Menu-list__item">
                    <a href="" class="c-Menu-list__a"><i class="c-Menu-list__icon fa fa-home"></i>Dashboard</a>
                </li>
            </ul>
        </aside>
        <section class="c-Content Grilla__xs--12">
            <div class="c-Content__head"><?php if (isset($this->page_title)): ?>
                    <h2 class="c-Content__title"><?= $this->page_title; ?></h2>
                <?php endif; ?>  <?php if (isset($this->page_subTitle)): ?>
                    <h2 class="c-Content__subtitle"><?= $this->page_subTitle; ?></h2>
                <?php endif; ?></div>
            <?php include_once($this->contenido); ?>
        </section>
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
<script src="<?= publicJs('main.bundle') ?>"></script>
</body>
</html>