DROP TRIGGER IF EXISTS insert_competition;

DELIMITER $$
CREATE TRIGGER insert_competition
BEFORE INSERT ON competition FOR EACH ROW
SET
  NEW.finishing_date = CONCAT(DATE_FORMAT(DATE_ADD(NOW(), INTERVAL 7 DAY) ,'%Y-%m-%d'), ' 23:59:00')
$$
DELIMITER ;

SET GLOBAL event_scheduler = ON;

DELIMITER $$
CREATE EVENT e_check_competitions_expiration
  ON SCHEDULE EVERY 1 DAY STARTS '2018-06-22 00:00:00'
DO
  UPDATE competition
  SET is_active = 0
  WHERE finishing_date <= UNIX_TIMESTAMP(CURDATE());
$$
DELIMITER ;