<?php

try{

    $connection = new PDO("mysql:dbname=nroubcom_searchengine;host=localhost","nroubcom_adminnroubcom","XmD4!aOPIf[Yorj4");

}
catch(PDOException $ex){
echo "Error occured : " . $ex->getMessage();
}

?>