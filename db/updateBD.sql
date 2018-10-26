--Scripts para actualizar la base

ALTER TABLE `perfil` ADD `permisos` TEXT NULL AFTER `nombre`;


UPDATE `perfil` SET `permisos` = '{\"Provincia\":{\"index\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"remove\":\"1\"},\"Inicio\":{\"index\":\"1\",\"subir_archivos\":\"1\"},\"Perfil\":{\"index\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"remove\":\"1\",\"edit_permission\":\"1\"},\"Persona\":{\"index\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"remove\":\"1\"},\"Ciudad\":{\"index\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"remove\":\"1\"},\"Perfil_usuario\":{\"index\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"remove\":\"1\"},\"Tipo_documento\":{\"index\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"remove\":\"1\"},\"Usuario\":{\"index\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"remove\":\"1\"},\"Login\":{\"index\":\"1\",\"oauth2callback\":\"1\",\"login\":\"1\",\"token\":\"1\",\"logout\":\"1\"}}\r\n' WHERE `perfil`.`id` = 1;

UPDATE `perfil_usuario` SET `permisos` = '{\"Provincia\":{\"index\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"remove\":\"1\"},\"Inicio\":{\"index\":\"1\",\"subir_archivos\":\"1\"},\"Perfil\":{\"index\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"remove\":\"1\",\"edit_permission\":\"1\"},\"Persona\":{\"index\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"remove\":\"1\"},\"Ciudad\":{\"index\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"remove\":\"1\"},\"Perfil_usuario\":{\"index\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"remove\":\"1\"},\"Tipo_documento\":{\"index\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"remove\":\"1\"},\"Usuario\":{\"index\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"remove\":\"1\"},\"Login\":{\"index\":\"1\",\"oauth2callback\":\"1\",\"login\":\"1\",\"token\":\"1\",\"logout\":\"1\"}}\r\n' WHERE `perfil_usuario`.`id_usuario` = 1 AND `perfil_usuario`.`id_perfil` = 1;

-- 21/10/2018:------------------
DROP TABLE `documentacion`;
CREATE TABLE `documentacion` (
  `id` INT(11) NOT NULL PRIMARY KEY,
  `id_persona` INT(11) NOT NULL,
  `genero` VARCHAR(24),
  `fotocopia_dni` TEXT,
  `titulo_primario` TEXT,
  `titulo_secundario` TEXT,
  `otros_titulos` TEXT,
  `fecha_inscripcion` DATE,
  `foto_carnet` TEXT,
  `certificado_nacimiento` TEXT,
  `beca` TEXT,
  `certificado_jucaid` TEXT,
  `medicacion` TEXT,
  `enfermedad` TEXT,
  `trabajo` TEXT,
  FOREIGN KEY (id_persona) REFERENCES persona(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
---------------------------------------


-- 26/10/2018: agregar columna foto de perfil a persona --------
ALTER TABLE `persona` ADD `foto` TEXT NULL AFTER `fecha_nacimiento`;
---------------------------------------------------------
