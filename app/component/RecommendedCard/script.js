let templateFile = await fetch("./component/RecommendedCard/templateCard.html");
let templateCard = await templateFile.text();

let RecommendedCard = {};

RecommendedCard.format = function (movies) {
  let cardsHTML = "";

  for (let movie of movies) {
    let card = templateCard;
    card = card.replace("{{image}}", movie.image); 
    card = card.replace("{{name}}", movie.name);
    card = card.replace("{{description}}", movie.description);
    cardsHTML += card;
  }

  return cardsHTML;
};

export { RecommendedCard };