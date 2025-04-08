let DataProfile = {};

/**
 * Récupère la liste de tous les profils utilisateur.
 */
DataProfile.read = async function () {
  let answer = await fetch("../server/script.php?todo=readProfiles");
  let data = await answer.json();
  return data;
};

export { DataProfile };