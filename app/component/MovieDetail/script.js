let templateFile = await fetch('./component/MovieDetail/templateMovieDetail.html');
let template = await templateFile.text();

let MovieDetail = {};

MovieDetail.format = function(movie) {
    let html = template;
    html = html.replaceAll('{{name}}', movie.name);
    html = html.replaceAll('{{year}}', movie.year);
    html = html.replaceAll('{{length}}', movie.length);
    html = html.replaceAll('{{description}}', movie.description);
    html = html.replaceAll('{{director}}', movie.director);
    html = html.replaceAll('{{image}}', movie.image);
    html = html.replaceAll('{{trailer}}', movie.trailer);
    html = html.replaceAll('{{min_age}}', movie.min_age);
    html = html.replaceAll('{{id_category}}', movie.id_category);
    return html;
};

export { MovieDetail };