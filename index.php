<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos</title>
    <link rel="stylesheet" href="bootstrap.min.css"/>
</head>
<body>
    
    <h1>Meus pedidos</h1>
    <form method="post" action="salvar_pedido.php">
        <label>Data:</label>
        <input type="date" name="data"><br><br>
        <label>Cliente:</label>
        <input type="text" name="cliente"><br><br>
        <label>Produto:</label>
        <input type="text" name="produto"><br><br>
        <label>Valor:</label>
        <input type="number" name="valor"><br><br>
        <input type="submit" value="Salvar">
    </form>
    <hr>
    <h2>Meus Pedidos</h2>
    <table>
        <thead>
        <tr>
            <th>Data</th>
            <th>Cliente</th>
            <th>Produto</th>
            <th>Valor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        
    <?php
    //Conecta o de dados usando PDO
    /*Pdo é uma extensão do php(api) para trabalhar com banco de dados */
    $host = 'localhost';
    $dbname = 'pedidos';
    $username='root';
    $password='';

    try {
        $pdo=new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
    } catch(PDOException $e){
        die("Erro ao conectar ao banco de dados".$e->getMessage());
    }

    //Busca os pedidos na tabela 'pedidos'
    $sql="SELECT * FROM pedidos";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();

    //Exibe os pedidos em uma tabela
    while($row=$stmt->fetch()){
        echo "<tr>";
        echo "<td>".$row['data']."</td>";
        echo "<td>".$row['cliente']."</td>";
        echo "<td>".$row['produto']."</td>";
        echo "<td>".$row['valor']."</td>";
        echo "<td>";
        echo "<a href='editar_pedido.php ?id=" . $row['id'] . "'>Editar</a> ";
        echo "<a href='excluir_pedido.php ?id=" . $row['id'] . "'>Excluir</a>";
        echo "</td>";
        echo "</tr>";
    }
    ?>
        </tbody>
    </table>
</body>
</html>