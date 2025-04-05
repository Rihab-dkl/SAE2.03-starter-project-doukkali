<?php
/**
 * ARCHITECTURE PHP SERVEUR : Rôle du fichier controller.php
 * 
 * Dans ce fichier, on définit les fonctions de contrôle qui vont traiter les requêtes HTTP.
 * Les requêtes HTTP sont interprétées selon la valeur du paramètre 'todo' de la requête (voir script.php)
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
?>