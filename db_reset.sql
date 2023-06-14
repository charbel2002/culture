SET FOREIGN_KEY_CHECKS = 0;


SET @tables = NULL;
SELECT GROUP_CONCAT(table_name) INTO @tables
FROM information_schema.tables
WHERE table_schema = 'culture';


SET @query = CONCAT('DROP TABLE IF EXISTS ', @tables);
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET FOREIGN_KEY_CHECKS = 1;
