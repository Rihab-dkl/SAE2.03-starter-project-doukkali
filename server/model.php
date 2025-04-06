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

/**
 * Insère un nouveau film dans la base de données.
 *
 * @param string $name        Le nom du film.
 * @param int    $year        L'année de sortie du film.
 * @param int    $length      La durée du film en minutes.
 * @param string $description La description du film.
 * @param string $director    Le nom du réalisateur.
 * @param string $image       Le nom du fichier image.
 * @param string $trailer     Lien vers la bande-annonce.
 * @param int    $min_age     L'âge minimum recommandé.
 * @param int    $id_category L'identifiant de la catégorie.
 *
 * @return bool Retourne true si l'insertion a réussi, false sinon.
 */
function createMovie($name, $year, $length, $description, $director, $image, $trailer, $min_age, $id_category) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "INSERT INTO Movie (name, year, length, description, director, image, trailer, min_age, id_category)
            VALUES (:name, :year, :length, :description, :director, :image, :trailer, :min_age, :id_category)";
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
        ":id_category" => $id_category
    ]);
}
?>