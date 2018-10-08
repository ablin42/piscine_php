INSERT INTO ft_table (`login`, `creation_date`)
SELECT `last_name`, `birthdate` 
FROM `user_card`
WHERE `last_name` REGEXP 'a' AND CHAR_LENGTH(`last_name`) < 9
ORDER BY `last_name` ASC
LIMIT 10;