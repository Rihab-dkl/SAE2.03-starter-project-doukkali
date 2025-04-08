let templateFile = await fetch("./component/ProfileForm/template.html");
let template = await templateFile.text();

let ProfileForm = {};

ProfileForm.format = function (handler) {
  let html = template;
  html = html.replace("{{handler}}", "C.handlerAddProfile(event)");
  return html;
};
export { ProfileForm };