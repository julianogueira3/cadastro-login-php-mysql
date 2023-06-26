<!DOCTYPE html>
<html>
<head>
  <title>Perfil do Usuário</title>
</head>
<body>

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

    // Verifica se o usuário está logado
    if (!isset($_SESSION['usuario_id'])) {
      header('Location: index.html');
      exit();
    }

    // Obtém as informações do perfil do usuário
    $usuario_id = $_SESSION['usuario_id'];
    $stmt = $db->prepare('SELECT nome, email FROM usuarios WHERE id = :id');
    $stmt->bindParam(':id', $usuario_id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Exibe as informações do perfil
    echo 'Nome: ' . $usuario['nome'] . '<br>';
    echo 'Email: ' . $usuario['email'] . '<br>';
  } catch (PDOException $e) {
    die('Erro ao conectar com o banco de dados: ' . $e->getMessage());
  }
  ?>
</body>
</html>
