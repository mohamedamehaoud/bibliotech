-- 1. Les livres de Jules Verne, du plus ancien au plus récent
SELECT titre, annee
FROM livre
WHERE auteur = 'Jules Verne'
ORDER BY annee ASC;

-- 2. Le nombre de livres par genre
SELECT genre, COUNT(*) AS nombre_livres
FROM livre
GROUP BY genre;

-- 3. Les emprunts en cours, avec l'adhérent et le livre
SELECT a.nom, l.titre, e.date_emprunt
FROM emprunt e
INNER JOIN adherent a ON e.adherent_id = a.id
INNER JOIN livre l ON e.livre_id = l.id
WHERE e.date_retour IS NULL
ORDER BY e.date_emprunt;

-- 4. Les 5 livres les plus empruntés
SELECT l.titre, COUNT(e.id) AS nombre_emprunts
FROM livre l
INNER JOIN emprunt e ON e.livre_id = l.id
GROUP BY l.id, l.titre
ORDER BY nombre_emprunts DESC
LIMIT 5;

-- 5. Les adhérents qui n'ont jamais emprunté
SELECT a.nom
FROM adherent a
LEFT JOIN emprunt e ON e.adherent_id = a.id
WHERE e.id IS NULL;