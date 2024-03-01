<?php
include_once 'security.php';

require_once($_SESSION['raiz'] . '/modules/sections/role-access-admin-editor.php');

$name_image_user = $_SESSION['raiz'] . '/images/users/' . $_SESSION['image'] . '';

if (file_exists($name_image_user)) {
} else {
    $sql = "SELECT image FROM users WHERE user = '" . $_SESSION['user'] . "'";

    if ($result = $conexion->query($sql)) {
        if ($row = mysqli_fetch_array($result)) {
            $_SESSION['image'] = $row['image'];
        }

        $name_image_user = $_SESSION['raiz'] . '/images/users/' . $_SESSION['image'] . '';

        if (file_exists($name_image_user)) {
        } else {
            $_SESSION['image'] = 'user.png';
        }
    }
}

$url_actual = $_SERVER["REQUEST_URI"];

if (strpos($url_actual, 'modules')) {
    $input = $url_actual;
    preg_match('~modules/(.*?)/~', $input, $output);
    $output[1];
} elseif (strpos($url_actual, 'attendance')) {
    $input = $url_actual;
    preg_match('~/(.*?)/~', $input, $output);
    $output[1];
} elseif (strpos($url_actual, 'user')) {
    $input = $url_actual;
    preg_match('~/(.*?)/~', $input, $output);
    $output[1];
} else {
    $output[1] = 'home';
}
?>
<div class="nav-home">
    <span class="name_system">Levantamiento de Información</span>
    <div class="user">
        <img class="image_user" src="/images/users/<?php echo $_SESSION['image']; ?>" />
        <span class="name_user">
            <?php print $_SESSION['name'] . ' ' . $_SESSION['surnames']; ?>
        </span>
        <span class="logout_user">
            <a class="icon" href="#">expand_more</a>
            <ul>
                <li>
                    <a style="border-bottom: 3px solid #6272a4;" href="/user"><span class="icon">settings</span>Configuración</a>
                    <a href="/modules/logout"><span class="icon">logout</span>Cerrar Sesión</a>
                </li>
            </ul>
        </span>
    </div>
    <ul>
        <li><a class="<?php if ($output[1] == 'home') {
                            echo 'active';
                        } ?>" href="/home"><span class="icon">dashboard</span>Dashboard</a></li>        
        <li><a class="<?php if ($output[1] == 'Informes_Quincenales') {
                            echo 'active';
                        } ?>" href="/modules/Informes_Quincenales"><span class="icon">recent_actors</span> <strong>1.1 </strong><u>Informes Quincenales</u></a></li>
        <li><a class="<?php if ($output[1] == 'Justificaciones') {
                            echo 'active';
                        } ?>" href="/modules/Justificaciones"><span class="icon">library_books</span><strong>1.2 </strong><u> Justificaciones</u></a></li>
        <li><a class="<?php if ($output[1] == 'Envio_1') {
                            echo 'active';
                        } ?>" href="/modules/send_one"><span class="icon">recent_actors</span> <strong>1.3 </strong><u>Envio 1 y Record academico</u></a></li>
        <li><a class="<?php if ($output[1] == 'Envio_2') {
                            echo 'active';
                        } ?>" href="/modules/send_two"><span class="icon">recent_actors</span><strong>1.4 </strong> <u>Envio 2</u></a></li>
        <li><a class="<?php if ($output[1] == 'Certificado') {
                            echo 'active';
                        } ?>" href="/modules/certification"><span class="icon">recent_actors</span> <strong>1.5 </strong> <u>Certificados </u></a></li>
        
        
</div>
<div class="menu-mobile">
    <header>
        <span class="activator icon" id="activator">menu</span>
        <nav>
            <ul>
                <li>
                    <a class="<?php if ($output[1] == 'home') {
                                    echo 'active';
                                } ?>" href="/home" title="Dashboard"><span class="icon">dashboard</span></a>
                </li>
                <li>
                    <a class="<?php if ($output[1] == 'Informes_Quincenales') {
                            echo 'active';
                        } ?>" href="/modules/Informes_Quincenales" title="Informes Quincenales"><span class="icon">recent_actors</span></a>
                </li>
                <li>
                    <a class="" href="" title="Justificaciones"><span class="icon">library_books</span></a>
                </li>
                <li>
                    <a class="" href="" title="Envio_1"><span class="icon">recent_actors</span></a>
                </li>
                <li>
                    <a class="" href="" title="Envio_2"><span class="icon">recent_actors</span></a>
                </li>
                <li>
                    <a class="" href="" title="Certificado"><span class="icon">recent_actors</span></a>
                </li>
                
            </ul>
        </nav>
    </header>
    <span class="name_system">Levantamiento de Información</span>
</div>
<div class="user-mobile">
    <header>
        <img class="activator-user" id="activator-user" src="/images/users/<?php echo $_SESSION['image']; ?>">
        <nav>
            <ul>
                <li class="first">
                    <a class="<?php if ($output[1] == 'user') {
                                    echo 'active';
                                } ?>" href="/user" title="Configuración"><span class="icon">settings</span></a>
                </li>
                <li>
                    <a href="/modules/logout" title="Cerrar Sesión"><span class="icon">logout</span></a>
                </li>
            </ul>
        </nav>
    </header>
</div>
<script src="/js/external/gsap.min.js"></script>
<script src="/js/controls/menumobile.js"></script>
