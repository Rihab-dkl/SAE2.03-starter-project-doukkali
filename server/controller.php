<?php
require("model.php");

// intval() permet de convertir une valeur en entier (integer)
function readMoviesController(){
    if (isset($_GET["age"])) {
        $age = intval($_GET["age"]);
    } else {
        $age = 0;
    }
    return getMoviesByAge($age);
}

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

function readMovieDetailController() {
    if (isset($_GET["id"])) {
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            return getMovieDetail($id);
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function readMoviesByCategoryController(){
    if (isset($_GET["age"])) {
        $age = intval($_GET["age"]);
    } else {
        $age = 0;
    }
    $movies = getMoviesByAge($age);
    if ($movies === false) {
        return false;
    } else {
        $grouped = array();
        foreach ($movies as $movie) {
            $cat = $movie->category_name;
            if (!isset($grouped[$cat])) {
                $grouped[$cat] = array();
            }
            $grouped[$cat][] = $movie;
        }
        return $grouped;
    }
}

function readMoviesByAgeController() {
    if (isset($_GET["age"])) {
        $age = intval($_GET["age"]);
        return getMoviesByAge($age);
    } else {
        return false;
    }
}

function readMoviesAgeCategoryController() {
    if (isset($_GET["age"]) && isset($_GET["category"])) {
        $age = intval($_GET["age"]);
        $category = $_GET["category"];
        return getMoviesByAgeAndCategory($age, $category);
    } else {
        return false;
    }
}

function readCategoriesController() {
    return getCategories();
}

function readProfilesController() {
    return getProfiles();
}

function addProfileController() {
    if (isset($_POST["nom_utilisateur"]) && isset($_POST["photo_profil"]) && isset($_POST["date_naissance"])) {
        $nom = $_POST["nom_utilisateur"];
        $photo = $_POST["photo_profil"];
        $datenaissance = $_POST["date_naissance"];
        return addProfile($nom, $photo, $datenaissance);
    } else {
        return false;
    }
}

function updateProfileController() {
    if (isset($_POST["id"], $_POST["nom_utilisateur"], $_POST["photo_profil"], $_POST["date_naissance"])) {
        $id = intval($_POST["id"]);
        $nom = $_POST["nom_utilisateur"];
        $photo = $_POST["photo_profil"];
        $date = $_POST["date_naissance"];
        return updateProfile($id, $nom, $photo, $date);
    } else {
        return false;
    }
}