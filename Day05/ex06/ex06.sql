SELECT `title`, `summary`
FROM `film`
WHERE LOWER(`summary`) REGEXP 'vincent'
ORDER BY `id_film` ASC;