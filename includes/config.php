<?php 

/** Nom de la base de données de KELMA. */
define( "DB_NAME", "location");

/** Utilisateur de la base de données MySQL. */
define("DB_USER", "root");

/** Mot de passe de la base de données MySQL. */
define("DB_PASSWORD", "");

/** Adresse de l'hébergement MySQL. */
define("DB_HOST", "localhost");

$con=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// CHECK CONNECTION
if (mysqli_connect_errno()){ echo "Failed to connect to MySQL: " . mysqli_connect_error();}
global $con;
?>