DELIMITER $$

DROP TRIGGER IF EXISTS insert_reparaciones_estado$$
CREATE TRIGGER insert_reparaciones_estado AFTER INSERT
	ON cu_reparaciones_estado FOR EACH ROW
BEGIN
	IF(NEW.fk_estado != 'pendiente') THEN
		UPDATE cu_reparaciones SET estado = 'NEW.fk_estado' WHERE id = NEW.fk_reparacion;
	END IF;
END$$


DELIMITER $$

DROP TRIGGER IF EXISTS insert_reparaciones$$
CREATE TRIGGER insert_reparaciones BEFORE INSERT
	ON cu_reparaciones FOR EACH ROW
BEGIN
	INSERT cu_reparaciones_estado(fk_reparacion, fk_estado) VALUES (NEW.id, 'pendiente');
    DECLARE averia INT;
    SELECT num_repair FROM cu_config WHERE id = 1 INTO averia;
    averia = averia + OLD.id;
    UPDATE cu_reparaciones SET num_averia = averia WHERE id = NEW.id;
END$$

DELIMITER $$

DROP TRIGGER IF EXISTS insert_reparaciones_after$$
CREATE TRIGGER insert_reparaciones_after AFTER INSERT
	ON cu_reparaciones FOR EACH ROW
BEGIN
	INSERT cu_reparaciones_estado(fk_reparacion, fk_estado) VALUES (NEW.id, 'pendiente');
END$$

