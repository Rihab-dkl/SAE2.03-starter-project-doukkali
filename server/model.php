<?php
define("HOST", "localhost");
define("DBNAME", "doukkali-el-u1");
define("DBLOGIN", "doukkali-el-u1");
define("DBPWD", "doukkali-el-u1");

function getMovies(){
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT 
                Movie.id,
                Movie.name,
                Movie.image,
                Category.name AS category_name
            FROM Movie
            JOIN Category ON Movie.id_category = Category.id";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function createMovie($name, $year, $length, $description, $director, $image, $trailer, $min_age, $id_category) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
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

function getMovieDetail($id) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT 
                Movie.*,
                Category.name AS category_name
            FROM Movie
            JOIN Category ON Movie.id_category = Category.id
            WHERE Movie.id = :id";
    $stmt = $cnx->prepare($sql);
    $stmt->execute([":id" => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getMoviesByAge($age) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT 
                Movie.id,
                Movie.name,
                Movie.image,
                Category.name AS category_name
            FROM Movie
            JOIN Category ON Movie.id_category = Category.id
            WHERE Movie.min_age <= :age";
    $stmt = $cnx->prepare($sql);
    $stmt->execute([":age" => $age]);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function getMoviesByAgeAndCategory($age, $category) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT 
                Movie.id,
                Movie.name,
                Movie.image,
                Category.name AS category_name
            FROM Movie
            JOIN Category ON Movie.id_category = Category.id
            WHERE Movie.min_age <= :age AND Category.name = :category";
    $stmt = $cnx->prepare($sql);
    $stmt->execute([
        ":age" => $age,
        ":category" => $category
    ]);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function getCategories() {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT name FROM Category";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function getProfiles() {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT * FROM Profile";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addProfile($nom, $photo, $datenaissance) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "INSERT INTO Profile (nom_utilisateur date_naissance) 
            VALUES (:nom_utilisateur, :date_naissance)";
    $stmt = $cnx->prepare($sql);
    return $stmt->execute([
        ":nom_utilisateur" => $nom,
        ":date_naissance" => $datenaissance
    ]);
}

function updateProfile($id, $nom, $photo, $datenaissance) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "UPDATE Profile 
            SET nom_utilisateur = :nom_utilisateur, 
                date_naissance = :date_naissance 
            WHERE id = :id";
    $stmt = $cnx->prepare($sql);
    return $stmt->execute([
        ":id" => $id,
        ":nom_utilisateur" => $nom,
        ":photo_profil" => $photo,
        ":date_naissance" => $datenaissance
    ]);
}



/**
 * Vérifie si un film est déjà favori pour un profil donné
 *
 * @param int $idProfile
 * @param int $idMovie
 * @return bool True si c'est déjà un favori, false sinon
 */
function verifyFavorite($idProfile, $idMovie) {
    try {
        $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
        $sql = "SELECT COUNT(*) FROM Favoris WHERE id_profile = :profile AND id_movie = :movie";
        $stmt = $cnx->prepare($sql);
        $stmt->execute([
            ":profile" => $idProfile,
            ":movie"   => $idMovie
        ]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    } catch (PDOException $e) {
        error_log("Erreur DB dans verifyFavorite : " . $e->getMessage());
        return false;
    }
}

/**
 * Ajoute un film en favoris pour un profil
 *
 * @param int $idProfile
 * @param int $idMovie
 * @return int Nombre de lignes insérées (1 si succès, 0 sinon)
 */
function addFavori($idProfile, $idMovie) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);

    $sql = "INSERT INTO Favoris (id_profile, id_movie) VALUES (:profile, :movie)";
    $stmt = $cnx->prepare($sql);
    $stmt->execute([
        ":profile" => $idProfile,
        ":movie"   => $idMovie
    ]);

    return $stmt->rowCount();
}

/**
 * Supprime un film des favoris pour un profil
 *
 * @param int $idProfile
 * @param int $idMovie
 * @return int Nombre de lignes supprimées (1 si succès, 0 sinon)
 */
function removeFavori($idProfile, $idMovie) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);

    $sql = "DELETE FROM Favoris WHERE id_profile = :profile AND id_movie = :movie";
    $stmt = $cnx->prepare($sql);
    $stmt->execute([
        ":profile" => $idProfile,
        ":movie"   => $idMovie
    ]);

    return $stmt->rowCount();
}

/**
 * Récupère la liste des favoris d'un profil
 *
 * @param int $idProfile
 * @return array Tableau d'objets représentant les films favoris
 */
function getFavori($idProfile) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);

    $sql = "SELECT 
                Favoris.id_profile,
                Profile.nom_utilisateur AS profile_name,
                Movie.id,
                Movie.name,
                Movie.image
            FROM Favoris
            JOIN Movie ON Favoris.id_movie = Movie.id
            JOIN Profile ON Favoris.id_profile = Profile.id
            WHERE Favoris.id_profile = :profile";

    $stmt = $cnx->prepare($sql);
    $stmt->execute([
        ":profile" => $idProfile
    ]);

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

/**
 * Ouvre la page de profil pour afficher ses infos (et éventuellement ses favoris)
 *
 * @param int $idProfile
 * @return mixed Un objet contenant les infos du profil, ou false si introuvable
 */
function openProfileView($idProfile) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);

    $sql = "SELECT nom_utilisateur, photo_profil
            FROM Profile
            WHERE id = :profile";

    $stmt = $cnx->prepare($sql);
    $stmt->execute([
        ":profile" => $idProfile
    ]);

    return $stmt->fetch(PDO::FETCH_OBJ);
}

/**
 * Récupère tous les films marqués comme "mis en avant"
 *
 * @return array Tableau d’objets représentant les films
 */
function getFilmsMisEnAvant() {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);

    $sql = "SELECT id, name, image, description, trailer
            FROM Movie
            WHERE mise_en_avant = TRUE";

    $stmt = $cnx->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
?>