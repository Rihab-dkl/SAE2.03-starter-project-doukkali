# Documentation de la base de données – SAÉ 2.03

## Présentation

## Itération 1 – Consulter la liste des films

Modifications sur la base :
- Utilisation des tables `Movie` et `Category` déjà fournies dans le fichier `SAE2_03.sql`.
- Enrichissement de la table `Movie` avec de nouveaux champs.

Justification :
- Les champs `trailer`, `min_age`, `mise_en_avant`, `description`, `image`, etc. ont été ajoutés pour enrichir l’expérience utilisateur.
- Le type `VARCHAR(255)` est utilisé pour les champs texte classiques, et `TEXT` pour les champs plus longs comme `description`.
- La relation entre `Movie` et `Category` est de type 0,n → 1,1 (un film appartient à une seule catégorie, une catégorie peut regrouper plusieurs films).
- Les index ont été ajoutés pour optimiser les requêtes par catégorie.

---

## Itération 2 – Ajouter des films

Modifications :
- Utilisation du formulaire côté admin pour alimenter dynamiquement la base en films.

---

## Itération 4 – Regrouper les films par catégorie

Modifications :
- Les requêtes serveur ont été ajustées pour permettre de regrouper les films selon leur `id_category`.

---

## Itération 5 – Ajouter des profils utilisateurs

Modifications :
- Création de la table `Profile` avec les champs `nom_utilisateur`, `photo_profil`, `date_naissance`.

---

## Itération 6 – Sélectionner un profil

Modifications :
- Lecture des profils pour les afficher sur l’interface.

---

## Itération 7 – Filtrer les contenus par âge

Modifications :
- Adaptation de la logique serveur pour ne renvoyer que les films dont l’âge minimum (`min_age`) est compatible avec le profil sélectionné.

---

## Itération 9 – Ajouter des favoris

Modifications :
- Création de la table `Favoris`.

Justification :
- Table associative entre `Movie` et `Profile` : chaque profil peut avoir plusieurs films en favoris, et chaque film peut être dans les favoris de plusieurs profils.

---

## Itération 10 – Supprimer des favoris

Modifications :
- Suppression d’une entrée dans la table `Favoris` à partir de l’identifiant du profil et du film.

---

## Itération 11 – Affichage des films mis en avant

Modifications :
- Affichage conditionnel basé sur la valeur du champ `mise_en_avant` dans la table `Movie`.

---

## Modèle conceptuel Looping

Le modèle a été réalisé avec Looping. Il inclut les entités suivantes :

- Category (`id`, `name`)
- Movie (`id`, `name`, `year`, `length`, `description`, `director`, `image`, `trailer`, `min_age`, `mise_en_avant`, `id_category`)
- Profile (`id`, `nom_utilisateur`, `date_naissance`, `photo_profil`)
- Favoris (`id`) — Voir note ci-dessous

---

## Explication des cardinalités (modèle Looping)

Category → Movie  
- Cardinalité :
  - Côté Category : 1,1
  - Côté Movie : 0,n  
- Explication :
  - Un film appartient obligatoirement à une seule catégorie.
  - Une catégorie peut regrouper plusieurs films.
  - Cette relation est modélisée avec une clé étrangère `id_category` dans la table `Movie`.

Profile → Favoris ← Movie  
- Cardinalités dans Looping :
  - Profile → Favoris : 1,n
  - Movie → Favoris : 1,n

Remarque :
- La table Favoris a été modélisée comme une entité indépendante avec un champ `id`, ce qui n’est pas optimal.
- Une meilleure modélisation consiste à représenter Favoris comme une table associative pure, avec une clé primaire composée de :
  - `id_profile` (clé étrangère vers Profile)
  - `id_movie` (clé étrangère vers Movie)
- Cela reflète la relation n-n réelle entre profils et films.

---
