let templateFile = await fetch("./component/Moviecategorie/template.html");
let template = await templateFile.text();

let Moviecategorie = {};

Moviecategorie.format = function (categories) {
  let listHTML = categories
    .map(
      (cat) =>
        `<li class="categorie__tag" onclick="C.handlerCategorie('${cat}')">${cat}</li>`
    )
    .join("");

  let html = template.replace("{{categories}}", listHTML);
  return html;
};

export { Moviecategorie };