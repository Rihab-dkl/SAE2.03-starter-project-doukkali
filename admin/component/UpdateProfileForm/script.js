let templateFile = await fetch("./component/UpdateProfileForm/template.html");
let template = await templateFile.text();

let UpdateProfileForm = {};

UpdateProfileForm.format = function (handler) {
  let html = template;
  html = html.replace("{{handler}}", handler);
  return html;
};

export { UpdateProfileForm };