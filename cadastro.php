<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'api_php';
$username = 'root';
$password = 'jujubalinha';

try {
  // Conexão com o banco de dados
  $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Recebe os dados do formulário de registro
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

// Insere os dados no banco de dados
$stmt = $db->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)');
$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senha);
$stmt->execute();

// Exibe a mensagem de registro bem-sucedido
echo "Registrado com sucesso!";


  // Redireciona para a página de perfil
  header('Location: perfil.php');
  exit();
} catch (PDOException $e) {
  die('Erro ao conectar com o banco de dados: ' . $e->getMessage());
}
