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
    // var_dump ($nom, $photo, $datenaissance);
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "INSERT INTO Profile (nom_utilisateur, photo_profil, date_naissance) 
            VALUES (:nom_utilisateur, :photo_profil, :date_naissance)";
    $stmt = $cnx->prepare($sql);
    return $stmt->execute([
        ":nom_utilisateur" => $nom,
        ":photo_profil" => $photo,
        ":date_naissance" => $datenaissance
    ]);
}

function updateProfile($id, $nom, $photo, $datenaissance) {
    $cnx = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, DBLOGIN, DBPWD);
    $sql = "UPDATE Profile 
            SET nom_utilisateur = :nom_utilisateur, 
                photo_profil = :photo_profil, 
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