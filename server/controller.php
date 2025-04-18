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

function addFavoriController() {
    if (isset($_REQUEST['id_profile']) && isset($_REQUEST['id_movie'])) {
        $profileId = $_REQUEST['id_profile'];
        $movieId   = $_REQUEST['id_movie'];

        // Vérifie si ce favori existe déjà
        $exists = verifyFavorite($profileId, $movieId);
        if ($exists) {
            return ["alreadyFavoris" => true]; 
        }

        // Sinon on l'ajoute
        $ok = addFavori($profileId, $movieId);
        if ($ok != 0) {
            return ["success" => true];
        } else {
            return ["success" => false];
        }
    } else {
        return false;
    }
}

/**
 * openProfileViewController
 * 
 * Ouvre la page de profil pour afficher ses informations (nom, photo, etc.)
 * Paramètre attendu : id_profile
 * 
 * @return mixed Objet contenant les infos du profil, ou false si paramètre manquant
 */
function openProfileViewController() {
    if (isset($_REQUEST['id_profile'])) {
        $profileId = $_REQUEST['id_profile'];
        $profile = openProfileView($profileId);
        return $profile;
    } else {
        return false;
    }
}

/**
 * readFavoriController
 * 
 * Récupère la liste des films favoris d'un profil
 * Paramètre attendu : id_profile
 * 
 * @return mixed Tableau d'objets films favoris, ou false si paramètre manquant
 */
function readFavorisController() {
    if (isset($_REQUEST['id_profile'])) {
        $profileId = $_REQUEST['id_profile'];
        $moviesFav = getFavori($profileId);
        return $moviesFav;
    } else {
        return false;
    }
}

/**
 * removeFavoriController
 * 
 * Supprime un film des favoris d'un profil s'il y est déjà
 * Paramètres attendus : id_profile, id_movie
 * 
 * @return array Un tableau indiquant si le film existait et si la suppression a réussi
 */
function removeFavoriController() {
    if (isset($_REQUEST['id_profile']) && isset($_REQUEST['id_movie'])) {
        $profileId = $_REQUEST['id_profile'];
        $movieId   = $_REQUEST['id_movie'];

        $exists = verifyFavorite($profileId, $movieId);
        if (!$exists) {
            return ["wasNotFavoris" => true]; 
        }

        $ok = removeFavori($profileId, $movieId);
        if ($ok != 0) {
            return ["success" => true];
        } else {
            return ["success" => false];
        }
    } else {
        return false;
    }
}

/**
 * checkFavoriController
 * 
 * Vérifie si un film est dans les favoris d’un utilisateur
 * Paramètres attendus : id_profile, id_movie
 * 
 * @return array Un tableau contenant "exists" => true|false
 */
function checkFavoriController() {
    if (isset($_REQUEST['id_profile']) && isset($_REQUEST['id_movie'])) {
        $profileId = $_REQUEST['id_profile'];
        $movieId   = $_REQUEST['id_movie'];

        $exists = verifyFavorite($profileId, $movieId);
        return ["exists" => $exists];
    } else {
        return ["exists" => false];
    }
}

/**
 * readFilmsMisEnAvantController
 * 
 * Récupère la liste des films marqués comme mis en avant.
 * 
 * @return mixed Tableau d'objets films mis en avant, ou false si erreur
 */
function readFilmsMisEnAvantController() {
    return getFilmsMisEnAvant();
}