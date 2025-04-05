let HOST_URL = "https://mmi.unilim.fr/~doukkali-el-u1/SAE2.03-starter-project-doukkali/";

let DataMovie = {};

DataMovie.requestMovies = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readMovies");
  let data = await answer.json();
  return data;
}

export {DataMovie}