<?php
/**
 * ARCHITECTURE PHP SERVEUR : Rôle du fichier controller.php
 * 
 * Dans ce fichier, on définit les fonctions de contrôle qui vont traiter les requêtes HTTP.
 * Les requêtes HTTP sont interprétées selon la valeur du paramètre 'todo' de la requête (voir script.php).
 * Pour chaque valeur différente, on déclare une fonction de contrôle différente.
 *
 * Inclusion du fichier model.php
 * Il contient les fonctions nécessaires pour interagir avec la base de données.
 */ 
require("model.php");

/** 
 * readMoviesController
 * 
 * Cette fonction est en charge du traitement des requêtes HTTP pour lesquelles le paramètre 'todo' vaut 'readMovies'.
 * Elle appelle la fonction getMovies() déclarée dans model.php pour récupérer la liste des films dans la base de données.
 *
 * @return mixed Un tableau d'objets contenant les films, ou false en cas d'erreur.
 */
function readMoviesController(){
    // Appel de la fonction getMovies du modèle pour extraire la liste des films
    $movies = getMovies();
    return $movies;
}

/**
 * createMovieController
 * 
 * Fonction de contrôle pour le traitement des requêtes HTTP 'createMovie'.
 * Elle vérifie la présence des champs requis dans la requête POST,
 * puis appelle la fonction createMovie du modèle pour insérer un nouveau film.
 *
 * IMPORTANT : Les noms de champs doivent EXACTEMENT correspondre à ceux définis dans ta base de données.
 * C'est-à-dire : "name", "year", "length", "description", "director", "image", "trailer", "min_age" et "id_category".
 *
 * @return bool True si l'insertion s'est bien passée, False sinon.
 */
function createMovieController() {
    if (
        isset($_POST["name"], $_POST["year"], $_POST["length"], $_POST["description"],
              $_POST["director"], $_POST["image"], $_POST["trailer"], $_POST["min_age"], $_POST["id_category"])
    ) {
        return createMovie(
            $_POST["name"],
            $_POST["year"],
            $_POST["length"],
            $_POST["description"],
            $_POST["director"],
            $_POST["image"],
            $_POST["trailer"],
            $_POST["min_age"],
            $_POST["id_category"]
        );
    } else {
        return false;
    }
}

/**
 * readMovieDetailController
 * 
 * Fonction de contrôle pour le traitement des requêtes HTTP 'readMovieDetail'.
 * Elle vérifie la présence du paramètre 'id' dans la requête GET,
 * puis appelle la fonction getMovieDetail du modèle pour récupérer les détails du film.
 *
 * @return mixed Un tableau associatif contenant les détails du film, ou false en cas d'erreur.
 */
function readMovieDetailController() {
    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $id = intval($_GET["id"]);
        return getMovieDetail($id);
    } else {
        return false;
    }
}
?>