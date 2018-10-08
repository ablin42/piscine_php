SELECT UPPER(`last_name`) AS `NAME`, `first_name`, `price`
FROM `member`
INNER JOIN `subscription` ON member.id_sub = subscription.id_sub
INNER JOIN `user_card` ON member.id_user_card = user_card.id_user
WHERE subscription.id_sub = 0 OR subscription.id_sub = 1 OR subscription.id_sub = 4
ORDER BY `last_name` ASC, `first_name` ASC;