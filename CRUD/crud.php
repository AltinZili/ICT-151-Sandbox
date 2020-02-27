<?php

function getPDO(){
    require ".constant.php";
    $dbh = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname, $user, $pass);
    return $dbh;
}

function getAllFilsmMakers()
{
    try {
        $dbh = getPDO();
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

function createFilmMaker($filmMaker){
        try {
            $dbh = getPDO();
            $query = "INSERT INTO filmmakers (filmmakersnumber, lastname, firstname, birthname, nationality) 
            VALUES (:filmmakersnumber, :lastname, :firstname, birthname, nationality)";
            $statement = $dbh->prepare($query);//prepare query
            $statement->execute($filmMaker);//execute query
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

require ".constant.php";
$cmd = "mysql -u root -proot < Restore-MCU-PO-Final.sql";
exec($cmd);

?>




