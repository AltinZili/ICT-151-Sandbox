<?php

require "crud.php";

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

echo "Test unitaire de la fonction createFilmMaker";
$filmMaker=['1309877', 'Benoît', 'Hamon', '1987-06-06', 'Venezuela'];
createFilmMaker($filmMaker);


?>



