
//https://www.youtube.com/watch?v=Gu-Fl1zIVbE
<?php
include 'bd/bd.php';

header('Access-Control-Allow-Origin: "');

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $query="SELECT * from frameworks WHERE id=".$_GET['id'];
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
    } else{
        $query="SELECT * from frameworks";
        $resultado=metodoGet($query);
        echo json_encode($resultado->fetchAll());
    }
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);
    $nome=$_POST['nome'];
    $lancamento=$_POST['lancamento'];
    $dev=$_POST['dev'];
    $query="INSERT into frameworks(nome, lancamento, dev) VALUES ('$nome', '$lancamento', '$dev')";
    $queryAutoIncrement="SELECT MAX(id) as id FROM frameworks";
    $resultado=metodoPost($query, $queryAutoIncrement);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $nome=$_POST['nome'];
    $lancamento=$_POST['lancamento'];
    $dev=$_POST['dev'];
    $query="UPDATE frameworks SET nome='$nome', lancamento='$lancamento', dev='$dev' WHERE id='$id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

if($_POST['METHOD']=='DELETE'){
    unset($_POST['METHOD']);
    $id=$_GET['id'];
    $query="DELETE FROM frameworks where id='$id'";
    $resultado=metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 400 Bad Request");

?>