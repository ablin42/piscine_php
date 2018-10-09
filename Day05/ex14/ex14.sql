SELECT `floor_number` as `floor`, SUM(`nb_seats`) as `seats`
FROM `cinema`
GROUP BY `floor`
ORDER BY `seats` DESC;