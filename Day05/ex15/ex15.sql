SELECT LEFT(REVERSE(`phone_number`), 9) as `rebmunenohp`
FROM `distrib`
WHERE `phone_number` LIKE '05%';