let templateFile = await fetch("./component/NewMovieForm/templateNewMovieForm.html");
let template = await templateFile.text();

let NewMovieForm = {};


NewMovieForm.format = function(handler) {
  let html = template;
  html = html.replace("{{handler}}", handler);
  return html;
};



NewMovieForm.init = function(selector, handler) {
  const container = document.querySelector(selector);
  container.innerHTML = NewMovieForm.format(handler);
};


export { NewMovieForm };