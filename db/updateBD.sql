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


-- 1/11/2018: agregar campos activo

ALTER TABLE persona ADD COLUMN activo boolean NOT null;
ALTER TABLE usuario ADD COLUMN activo boolean NOT null;
ALTER TABLE carrera ADD COLUMN activo boolean NOT null;
ALTER TABLE provincia ADD COLUMN activo boolean NOT null;
ALTER TABLE ciudad ADD COLUMN activo boolean NOT null;
ALTER TABLE curso ADD COLUMN activo boolean NOT null;
ALTER TABLE materia ADD COLUMN activo boolean NOT null;
ALTER TABLE mesa ADD COLUMN activo boolean NOT null;
ALTER TABLE nivel ADD COLUMN activo boolean NOT null;
ALTER TABLE perfil ADD COLUMN activo boolean NOT null;
ALTER TABLE tipo_documento ADD COLUMN activo boolean NOT null;
ALTER TABLE tutor ADD COLUMN activo boolean NOT null;

-- 1/11/2018: setear campos activo=1
UPDATE persona SET activo=1;
UPDATE usuario SET activo=1;
UPDATE carrera SET activo=1;
UPDATE provincia SET activo=1;
UPDATE ciudad SET activo=1;
UPDATE curso SET activo=1;
UPDATE materia SET activo=1;
UPDATE mesa SET activo=1;
UPDATE nivel SET activo=1;
UPDATE perfil SET activo=1;
UPDATE tipo_documento SET activo=1;
UPDATE tutor SET activo=1;

-- setear valor por defecto=1:
-- (mysql puede que muestre una X de error al escribir la consulta, pero la ejecuta correctamente)
ALTER TABLE persona ALTER COLUMN activo SET DEFAULT 1;
ALTER TABLE usuario ALTER COLUMN activo SET DEFAULT 1;
ALTER TABLE carrera ALTER COLUMN activo SET DEFAULT 1;
ALTER TABLE provincia ALTER COLUMN activo SET DEFAULT 1;
ALTER TABLE ciudad ALTER COLUMN activo SET DEFAULT 1;
ALTER TABLE materia ALTER COLUMN activo SET DEFAULT 1;
ALTER TABLE mesa ALTER COLUMN activo SET DEFAULT 1;
ALTER TABLE nivel ALTER COLUMN activo SET DEFAULT 1;
ALTER TABLE perfil ALTER COLUMN activo SET DEFAULT 1;
ALTER TABLE tipo_documento ALTER COLUMN activo SET DEFAULT 1;
ALTER TABLE tutor ALTER COLUMN activo SET DEFAULT 1;

-- 2/11/2018: Periodo de cursado

CREATE TABLE `tipo_periodo` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `periodo` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_tipo_periodo` int(11) NOT NULL,
  `desde` date NOT NULL,
  `hasta` date NOT NULL,
  FOREIGN KEY (id_tipo_periodo) REFERENCES tipo_periodo(id) ON DELETE RESTRICT ON UPDATE CASCADE

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 04/11/2018 -- cambiar periodo por id_periodo en tabla curso
ALTER TABLE `curso` CHANGE `periodo` `id_periodo` INT(11) NOT NULL;
ALTER TABLE `esmn`.`curso` ADD INDEX (`id_periodo`) USING BTREE;
ALTER TABLE `curso` ADD CONSTRAINT `curso_ibfk_2` FOREIGN KEY (`id_periodo`) REFERENCES `periodo`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;


-- 07/11/18 falto esta modificacion
ALTER TABLE `curso` CHANGE `activo` `activo` TINYINT(1) NOT NULL DEFAULT '1';

-- 07/11/18 agregar columna de dias (json de solo nombre de los dias de semana)
ALTER TABLE `curso` ADD `diassemana` TEXT NOT NULL AFTER `diascursado`;
