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
 * @return array Un tableau d'objets contenant l'id, le nom et l'image pour chaque film.
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

/**
 * Insère 
 *
 * @param string $name
 * @param int    $year
 * @param int    $length
 * @param string $description
 * @param string $director
 * @param string $image
 * @param string $trailer
 * @param int    $min_age
 * @param int    $id
 *
 * @return bool
 */
function createMovie($name, $year, $length, $description, $director, $image, $trailer, $min_age, $id) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "INSERT INTO Movie (name, year, length, description, director, image, trailer, min_age, id)
            VALUES (:name, :year, :length, :description, :director, :image, :trailer, :min_age, :id)";
    $stmt = $cnx->prepare($sql);
    return $stmt->execute([
        ":name" => $name,
        ":year" => $year,
        ":length" => $length,
        ":description" => $description,
        ":director" => $director,
        ":image" => $image,
        ":trailer" => $trailer,
        ":min_age" => $min_age,
        ":id" => $id
    ]);
}

/**
 * Récupère 
 *
 * @param int $id
 * @return mixed tableau contenant les détails du film, ou false si aucun film n'est trouvé.
 */
function getMovieDetail($id) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT * FROM Movie WHERE id = :id";
    $stmt = $cnx->prepare($sql);
    $stmt->execute([":id" => $id]);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    return $res;
}
?>