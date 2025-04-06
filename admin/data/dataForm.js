
let HOST_URL = ".."; 

let DataForm = {};

/**
 * DataForm.postMovieData
 * 
 * Envoie les données d'un nouveau film au serveur.
 * 
 * Cette fonction effectue une requête HTTP de type POST vers le serveur
 * en ajoutant le paramètre todo=createMovie afin d'insérer un nouveau film
 * dans la base de données. Les données du formulaire sont envoyées dans le corps de la requête
 * sous forme d'un objet FormData.
 *
 * @param {FormData} fdata 
 * @returns {Promise<Object>} 
 */
DataForm.postMovieData = async function(fdata) {
  // Configuration de la requête POST
  let config = {
    method: "POST",
    body: fdata
  };

  // Envoi de la requête et récupération de la réponse JSON
  let answer = await fetch(HOST_URL + "/server/script.php?todo=createMovie", config);
  let data = await answer.json();
  return data;
};

export { DataForm };