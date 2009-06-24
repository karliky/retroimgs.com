DELIMITER //

DROP PROCEDURE IF EXISTS CreateTickets//
CREATE PROCEDURE CreateTickets(rId int(11), tLimit int(11))
  BEGIN
  DECLARE c int(11);
  SET n = 1;
  START TRANSACTION;
  WHILE n <= tLimit DO
    INSERT INTO tickets (id, `number`, raffle_id, created) VALUES (UUID(), n, rId, NOW());
    SET n = n + 1;
  END WHILE;
  COMMIT;
END//

DELIMITER ;