<?php
/**
 * Ce fichier contient toutes les fonctions qui réalisent des opérations
 * sur la base de données, telles que les requêtes SQL pour insérer, 
 * mettre à jour, supprimer ou récupérer des données.
 *
 * Définition des constantes de connexion à la base de données.
 *
 * HOST    : Nom d'hôte du serveur de base de données, ici "localhost".
 * DBNAME  : Nom de la base de données.
 * DBLOGIN : Nom d'utilisateur pour se connecter à la base de données.
 * DBPWD   : Mot de passe pour se connecter à la base de données.
 */
define("HOST", "localhost");
define("DBNAME", "doukkali-el-u1");
define("DBLOGIN", "doukkali-el-u1");
define("DBPWD", "doukkali-el-u1");

/**  
 * Récupère la liste des films dans la base de données.
 *
 * @return array Un tableau d'objets contenant l'id, le titre (alias 'title') et l'image pour chaque film.
 */
function getMovies(){
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer les films
    $sql = "SELECT id, name, image FROM Movie";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête SQL
    $stmt->execute();
    // Récupère les résultats de la requête sous forme d'objets
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
}
?>