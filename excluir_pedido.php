<?php
    // Conecta ao banco de dados usando PDO
    $host = 'localhost';
    $dbname = 'pedidos';
    $username = 'root';
    $password = '';
    try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    } catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
    }

    //Verifica se o Id do pedido foi fornecido como parâmetro
    if(!isset($_GET['id'])){
        header('Location:index.php');
        exit();
    }

    //Obtém o ID do pedido a ser editado
    $id=$_GET['id'];

    //Busca o pedido correspondente na tabela 'pedidos'
    $sql="SELECT * FROM pedidos WHERE id=:id";
    $stmt=$pdo->prepare($sql);
    $stmt->bindValue(':id',$id);
    $stmt->execute();
    $pedido=$stmt->fetch();

    //Verifica se o pedido existe
    if(!$pedido){
        header('Location:index.php');
        exit();
    }

    //Exclui o pedido da tabela 'pedidos'
    $sql='DELETE FROM pedidos WHERE id=:id';
    $stmt=$pdo->prepare($sql);
    $stmt->bindValue(':id',$id);
    $stmt->execute();

    //Redireciona para a página principal após salvar o pedido
    header('Location: index.php');
    exit();
?>