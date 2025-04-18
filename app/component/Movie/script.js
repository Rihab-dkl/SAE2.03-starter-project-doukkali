let templateFile = await fetch('./component/Movie/templateMovie.html');
let template = await templateFile.text();

let Movie = {};

Movie.format = function(movie) {
    let html = template;
    html = html.replaceAll('{{name}}', movie.name );
    html = html.replaceAll('{{image}}', movie.image );
    html = html.replaceAll('{{id}}', movie.id );
    html = html.replaceAll('{{remove_button}}', '');
    return html;
};

Movie.formatMany = function(movies) {
    let html = '';
    for (const movie of movies) {
        html += Movie.format(movie);
    }
    setTimeout(() => {
        document.querySelectorAll('.remove-favori').forEach(btn => {
            btn.addEventListener('click', async (event) => {
                event.stopPropagation();
                const id = btn.dataset.id;
                const confirmDelete = confirm("Voulez-vous retirer ce film de vos favoris ?");
                if (confirmDelete) {
                    const result = await DataMovie.deleteFavorite(activeProfileId, id);
                    if (result.success) {
                        alert("Film retiré des favoris.");
                        C.handlerProfilePage();
                    } else {
                        alert("Erreur lors de la suppression du favori.");
                    }
                }
            });
        });
    }, 0);
    return html;
};

export { Movie };