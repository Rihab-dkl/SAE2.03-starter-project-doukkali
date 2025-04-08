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

export { DataMovie };