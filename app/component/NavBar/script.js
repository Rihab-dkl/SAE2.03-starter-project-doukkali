let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function(hAbout, hHome, hFavorites, profiles) {
  let html = template;
  let profileOptions = profiles
    .map(p => 
      `<option 
        value="${p.id}" 
        data-naissance="${p.date_naissance}" 
        img="${p.photo_profil}">
          ${p.nom_utilisateur}
      </option>`
    ).join("");

    console.log(profiles);
  html = html.replace('{{hAbout}}', hAbout);
  html = html.replace('{{hHome}}', hHome);
  html = html.replace('{{hFavorites}}', hFavorites || '');
  html = html.replace('{{profileOptions}}', profileOptions);
  return html;
};

export { NavBar };