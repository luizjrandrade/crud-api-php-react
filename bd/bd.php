<?php
$pdo=null;
$host="localhost";
$user="root";
$password="";
$bd="csoreactphp";


function conectar(){
        try{
            $GLOBALS['pdo']=new PDO("mysql:host=".$GLOBALS['host'].";dbname=".$GLOBALS['bd']."", $GLOBALS['user'], $GLOBALS['password']);
            $GLOBALS['pdo']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            print "Error!: Não pode conectar no bd ";
            print "\nError!: ".$e."<br/>";
            die();
        }
    }

function desconectar(){
    $GLOBALS['pdo']=null;
}

function metodoGet($query){
    try{
        conectar();
        $sentecia=$GLOBALS['pdo']->prepare($query);
        $sentecia->setFetchMode(PDO::FETCH_ASSOC);
        $sentecia->execute();
        desconectar();
        return $sentecia;
    } catch(Exception $e){
        die("Error: ".$e);
    }
}

function metodoPost($query, $queryAutoIncrement){
    try{
        conectar();
        $sentecia=$GLOBALS['PDO']->prepare($query);
        $sentecia->execute();
        $idAutoIncrement=metodoGet($queryAutoIncrement)->fetch(PDO::FETCH_ASSOC);
        $resultado=array_merge($idAutoIncrement, $_POST);
        $sentecia->closeCursor();
        desconectar();
        return $resultado;
    } catch(Exception $e){
        die("Error: ".$e);
    }
}

function metodoPut($query){
    try{
        conectar();
        $sentecia=$GLOBALS['PDO']->prepare($query);
        $sentecia->execute();
        $resultado=array_merge($_GET, $_POST);
        $sentecia->closeCursor();
        desconectar();
        return $resultado;
    } catch(Exception $e){
        die("Error: ".$e);
    }
}

function metodoDelete($query){
    try{
        conectar();
        $sentecia=$GLOBALS['PDO']->prepare($query);
        $sentecia->execute();
        $sentecia->closeCursor();
        desconectar();
        return $_GET['id'];
    } catch(Exception $e){
        die("Error: ".$e);
    }
}

?>