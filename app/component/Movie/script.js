let templateFile = await fetch('./component/Movie/templateMovie.html');
let template = await templateFile.text();

let Movie = {};

Movie.format = function(movie) {
    let html = template;
    html = html.replaceAll('{{name}}', movie.name );
    html = html.replaceAll('{{image}}', movie.image );
    html = html.replaceAll('{{id}}', movie.id );
    return html;
};

Movie.formatMany = function(movies) {
    let html = '';
    for (const movie of movies) {
        html += Movie.format(movie);
    }
    return html;
};

export { Movie };