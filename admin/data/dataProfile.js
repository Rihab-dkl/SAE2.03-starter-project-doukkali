let HOST_URL = "https://mmi.unilim.fr/~doukkali-el-u1/SAE2.03-starter-project-doukkali/";

let DataProfile = {};


DataProfile.requestProfiles = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readProfiles");
  let profiles = await answer.json();
  return profiles;
};

DataProfile.add = async function (formData) {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=addProfile", {
    method: "POST",
    body: formData,
  });

  if (!answer.ok) return false;
  return await answer.json();
};

DataProfile.update = async function (formData) {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=updateProfile", {
    method: "POST",
    body: formData,
  });

  if (!answer.ok) return false;
  return await answer.json();
};

export { DataProfile };