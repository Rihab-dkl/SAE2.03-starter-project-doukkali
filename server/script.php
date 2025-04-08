<?php
require("controller.php");

if (isset($_REQUEST["todo"])) {
    header("Content-Type: application/json");
    $todo = $_REQUEST["todo"];

    switch ($todo) {
        case "readMovies":
            $age = isset($_GET["age"]) ? intval($_GET["age"]) : 0;
            $data = readMoviesController($age);
            break;
        case "createMovie":
            $data = createMovieController();
            break;
        case "readMovieDetail":
            $data = readMovieDetailController();
            break;
        case "readMoviesByCategory":
            $data = readMoviesByCategoryController();
            break;
        case "readMoviesByAge":
            $data = readMoviesByAgeController();
            break;
        case "readMoviesAgeCategory":
            $data = readMoviesAgeCategoryController();
            break;
        case "readCategories":
            $data = readCategoriesController();
            break;
        case "readProfiles":
            $data = readProfilesController();
            break;
        case "addProfile":

        
             $data = addProfileController();
            // var_dump($_REQUEST["date_naissance"]);
            break;
        default:
            echo json_encode("[error] Unknown todo value");
            http_response_code(400);
            exit();
    }

    if ($data === false) {
        echo json_encode("[error] Controller returns false");
        http_response_code(500);
        exit();
    } else {
        echo json_encode($data);
        http_response_code(200);
        exit();
    }
} else {
    http_response_code(404);
    exit();
}