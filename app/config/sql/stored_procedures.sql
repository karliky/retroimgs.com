DELIMITER //

DROP PROCEDURE IF EXISTS CreateTickets//
CREATE PROCEDURE CreateTickets(rId int(11), tLimit int(11))
  BEGIN
  DECLARE c int(11);
  SET c = 1;
  START TRANSACTION;
  WHILE c <= tLimit DO
    INSERT INTO tickets (code, raffle_id, created) VALUES (c, rId, NOW());
    SET c = c + 1;
  END WHILE;
  COMMIT;
END//

DELIMITER ;