<?php
session_start();

// Configurações do banco de dados
$host = 'localhost';
$dbname = 'api_php';
$username = 'root';
$password = 'jujubalinha';

try {
  // Conexão com o banco de dados
  $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Recebe os dados do formulário de login
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  // Verifica as credenciais do usuário
  $stmt = $db->prepare('SELECT * FROM usuarios WHERE email = :email');
  $stmt->bindParam(':email', $email);
  $stmt->execute();
  $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($usuario && password_verify($senha, $usuario['senha'])) {
    // Login bem-sucedido
    $_SESSION['usuario_id'] = $usuario['id'];
    header('Location: perfil.php');
    exit();
  } else {
    // Credenciais inválidas
    echo 'Credenciais inválidas.';
  }
} catch (PDOException $e) {
  die('Erro ao conectar com o banco de dados: ' . $e->getMessage());
}
