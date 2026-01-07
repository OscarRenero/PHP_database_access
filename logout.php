<?php
// Inicia o reanuda la sesión actual para poder manipularla
session_start();

// Elimina toda la información almacenada en la sesión actual (limpia variables)
session_destroy();

// Redirige al usuario a la página de inicio tras cerrar la sesión
header('Location: index.php');

// Finaliza la ejecución del script para asegurar la redirección
exit;
