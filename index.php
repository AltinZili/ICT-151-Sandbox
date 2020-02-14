<?php



function getAllItems()
{
    require ".constant.php";
    try {
        $dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $user, $pass);
        $query = 'SELECT * FROM filmmakers';
        $statment = $dbh->prepare($query);//prepare query, il doit faire des vérifications et il va pas exécuter tant
        //qu'il y a des choses incorrects
        $statment->execute();//execute query
        $queryResult = $statment->fetchAll(PDO::FETCH_ASSOC);//prepare result for client cherche tous les résultats
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
        $queryResult = $statment->fetch(PDO::FETCH_ASSOC);//prepare result for client cherche tous les résultats
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

die();




/*$item = getItem(3);
if ($item['firstname'] == 'Luc-Olivier'){
    echo 'OK !!!';
} else {
    echo 'BUG !!!';
}*/

function getPDO(){
    require ".constant.php";
    $dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $user, $pass);
    return $dbh;
}

function getFilmMakerByName($name)
{
    try {
        $dbh = getPDO();
        $query = "SELECT * FROM filmmakers WHERE lastname='$name'";
        $statement = $dbh->prepare($query);//prepare query
        $statement->execute();//execute query
        $queryResult = $statement->fetch(PDO::FETCH_ASSOC);//prepare result for client
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

function updateFilmMaker($item){
try {
    $dbh = getPDO();
    $query = "UPDATE filmmakers SET filmmakersnumber=:filmmakersnumber,
    lastname=:lastname,
    firstname=:firstname,
    birthname=:birthname,
    nationality=:nationality WHERE id =:id";
    $statement = $dbh->prepare($query);//prepare query
    $statement->execute($item);//execute query
    $dbh = null;
    return true;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    return null;
}

/*UPDATE shows
SET channel = 'C+'
WHERE channel ='Canal+';
}*/
}

function getFilmMaker($id){

    try {
        $dbh = getPDO(); //séparer les deux choses (;)
        $query = "SELECT * FROM filmmakers WHERE id = $id";
        echo $query;//savoir ce qui va pas
        $statment = $dbh->prepare($query);//prepare query
        $statment->execute();//execute query
        $queryResult = $statment->fetch(PDO::FETCH_ASSOC);//prepare result for client cherche tous les résultats
        $dbh = null;
        return $queryResult;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        return null;
    }
}

require ".constant.php";
$cmd = "mysql -u root -proot < Restore-MCU-PO-Final.sql";
exec($cmd);


echo "Test unitaire de la fonction updateFilmMaker : ";
$item = getFilmMakerByName('Gérard');
$id = $item['id']; // se souvenir de l'id pour comparer
$item['firstname'] = 'Mario';
$item['lastname'] = 'Bros';
updateFilmMaker($item);
$readback = getFilmMaker($id);
if (($readback['firstname'] == 'Mario') && ($readback['lastname'] == 'Bros')) {
    echo 'OK !!!';
} else {
    echo '### BUG ###';
}
echo "\n";



?>






