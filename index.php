<?php

require_once ".constant.php";

function getAllItems()
{
    require ".constant.php";
    try {
        $dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $user, $pass);
        $query = 'SELECT * FROM filmakers';
        $statment = $dbh->prepare($query);//prepare query, il doit faire des vérifications et il va pas exécuter tant
        //qu'il y a des choses incorrects
        $statment->execute();//execute query
        $queryResult = $statment->fetchAll();//prepare result for client cherche tous les résultats
        var_dump($queryResult);
        $dbh = null; //refermer une connection quand on a fini
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function getItem($id)
{
    require ".constant.php";
    try {
        $dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $user, $pass); //séparer les deux choses (;)
        $query = "SELECT * FROM filmmakers WHERE id = $id";

        echo $query;//savoir ce qui va pas
        $statment = $dbh->prepare($query);//prepare query
        $statment->execute();//execute query
        $queryResult = $statment->fetch();//prepare result for client cherche tous les résultats
        var_dump($queryResult);
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

//Test unitaire de la fonction getAllItems

/*$items = getAllItems();
if (count($items) == 4){
    echo 'OK !!!';
} else {
    echo 'BUG !!!';
}

?>*/

$item = getItem(3);
if ($item['firstname'] == 'Luc-Olivier'){
    echo 'OK !!!';
} else {
    echo 'BUG !!!';
}

?>





