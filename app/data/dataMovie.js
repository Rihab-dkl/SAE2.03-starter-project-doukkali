let HOST_URL = "https://mmi.unilim.fr/~doukkali-el-u1/SAE2.03-starter-project-doukkali/";

let DataMovie = {};

/**
 * Récupère la liste de tous les films selon l'âge.
 */
DataMovie.requestMovies = async function (age = 0) {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readMovies&age=" + age);
  let data = await answer.json();
  return data;
};

/**
 * Récupère les détails d'un film
 * @param {number} id
 */
DataMovie.requestMovieDetail = async function (id) {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readMovieDetail&id=" + id);
  let data = await answer.json();
  return data;
};

/**
 * Récupère la liste des catégories
 */
DataMovie.requestCategories = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readCategories");
  let categories = await answer.json();
  return categories;
};

/**
 * Récupère les films filtrés par âge, regroupés par catégorie
 * Puis extrait ceux d'une catégorie précise
 */
DataMovie.requestMoviesByCategory = async function (category, age = 0) {
  let response = await fetch(HOST_URL + "/server/script.php?todo=readMoviesByCategory&age=" + age);
  let grouped = await response.json();
  return grouped[category] || [];
};

/**
 * Ajoute un film aux favoris d'un utilisateur
 */
DataMovie.addFavori = async function(id_profile, id_movie) {
  let response = await fetch(`${HOST_URL}/server/script.php?todo=addFavori&id_profile=${id_profile}&id_movie=${id_movie}`);
  let data = await response.json();
  return data;
};

/**
 * Récupère la liste des films favoris d'un utilisateur
 */
DataMovie.readFavori = async function(id_profile) {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readFavoris&id_profile=" + id_profile);
  
  if (!answer.ok) {
    console.error("Erreur serveur lors du fetch readFavoris");
    return [];
  }

  const text = await answer.text();
  if (!text) {
    console.warn("Réponse vide reçue pour readFavoris");
    return [];
  }

  try {
    let data = JSON.parse(text);
    return data;
  } catch (e) {
    console.error("Erreur JSON.parse dans readFavoris :", e);
    return [];
  }
};

/**
 * Retire un film des favoris d'un utilisateur
 */
DataMovie.deleteFavori = async function(id_profile, id_movie) {
  let response = await fetch(`${HOST_URL}/server/script.php?todo=deleteFavori&id_profile=${id_profile}&id_movie=${id_movie}`);
  let data = await response.json();
  return data;
};

/**
 * Vérifie si un film est déjà dans les favoris d'un utilisateur
 */
DataMovie.checkFavori = async function(id_profile, id_movie) {
  const response = await fetch(`${HOST_URL}/server/script.php?todo=checkFavori&id_profile=${id_profile}&id_movie=${id_movie}`);
  
  if (!response.ok) {
    console.error("Erreur serveur lors de checkFavori");
    return false;
  }

  const text = await response.text();
  if (!text) {
    console.error("Réponse vide reçue pour checkFavori");
    return false;
  }

  try {
    const data = JSON.parse(text);
    return data.exists;
  } catch (e) {
    console.error("Erreur JSON.parse dans checkFavori :", e);
    return false;
  }
};

/**
 * Récupère les films marqués comme mis en avant
 */
DataMovie.readFilmsMisEnAvant = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readFilmsMisEnAvant");
  
  if (!answer.ok) {
    console.error("Erreur serveur lors du fetch readFilmsMisEnAvant");
    return [];
  }

  const text = await answer.text();
  if (!text) {
    console.warn("Réponse vide reçue pour readFilmsMisEnAvant");
    return [];
  }

  try {
    let data = JSON.parse(text);
    return data;
  } catch (e) {
    console.error("Erreur JSON.parse dans readFilmsMisEnAvant :", e);
    return [];
  }
};

export { DataMovie };