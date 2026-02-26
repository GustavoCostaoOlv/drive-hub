<?php
// verificar_login.php - Proteção das páginas
session_start();

// Verifica se está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    // Não está logado, redireciona para login
    header('Location: login.php?redirect=' . urlencode($_SERVER['REQUEST_URI']));
    exit;
}

// Verifica se o login expirou (opcional - 8 horas)
if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time'] > 28800)) {
    // Expirou, faz logout
    session_destroy();
    header('Location: login.php?expirou=1');
    exit;
}
?>