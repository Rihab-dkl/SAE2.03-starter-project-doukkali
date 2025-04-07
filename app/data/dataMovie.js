let HOST_URL = "https://mmi.unilim.fr/~doukkali-el-u1/SAE2.03-starter-project-doukkali/";

let DataMovie = {};

/**
 * Récupère la liste de tous les films.
 */
DataMovie.requestMovies = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readMovies");
  let data = await answer.json();
  return data;
};

/**
 * Récupère les détails d'un film spécifique en fonction de son id.
 * @param {number} id - L'identifiant du film.
 */
DataMovie.requestMovieDetail = async function (id) {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readMovieDetail&id=" + id);
  let data = await answer.json();
  return data;
};

export { DataMovie };