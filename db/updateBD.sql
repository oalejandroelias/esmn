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


-- 11/11/2018 cambiar date por datetime en mesa
ALTER TABLE `mesa` CHANGE `fecha` `fecha` DATETIME NOT NULL;


--10/11/2018
ALTER TABLE `inscripcion_materia` CHANGE `id_estado` `id_estado_inicial` INT(11) NOT NULL;

ALTER TABLE `inscripcion_materia` ADD `id_estado_final` INT(11) NOT NULL;


CREATE TABLE `estado_inscripcion_inicial` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL COMMENT 'Descripcion',
  `nomenclatura` varchar(4) DEFAULT NULL COMMENT 'Abreviacion',
  `es_cursado` tinyint(1),
  `es_mesa` tinyint(1)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `estado_inscripcion_final` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(64) NOT NULL COMMENT 'Descripcion',
  `nomenclatura` varchar(4) DEFAULT NULL COMMENT 'Abreviacion',
  `es_cursado` tinyint(1),
  `es_mesa` tinyint(1)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- 11/11/18 tabla materias equivalentes
CREATE TABLE `esmn`.`materia_equivalente` (
  `id_materia` INT(11) NOT NULL ,
  `id_equivalencia` INT(11) NOT NULL ,
  PRIMARY KEY  (`id_materia`, `id_equivalencia`)
  USING BTREE) ENGINE = InnoDB;

ALTER TABLE `materia_equivalente` ADD CONSTRAINT `materia_equivalente_ibfk_1` FOREIGN KEY (`id_materia`) REFERENCES `materia`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE; ALTER TABLE `materia_equivalente` ADD CONSTRAINT `materia_equivalente_ibfk_2` FOREIGN KEY (`id_equivalencia`) REFERENCES `materia`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- 12/11/18 cambiar id_estado a null
ALTER TABLE `inscripcion_materia` CHANGE `id_estado_final` `id_estado_final` INT(11) NULL;
-- agregar index id_estado_final y relacion foranea
ALTER TABLE `esmn`.`inscripcion_materia` ADD INDEX `id_estado_final` (`id_estado_final`) USING BTREE;

-- lo mismo con id_estado_inicial
ALTER TABLE `esmn`.`inscripcion_materia` DROP INDEX `id_estado`,
ADD INDEX `id_estado_inicial` (`id_estado_inicial`) USING BTREE;
ALTER TABLE `inscripcion_materia` DROP FOREIGN KEY `inscripcion_materia_ibfk_5`;
ALTER TABLE `inscripcion_materia` ADD CONSTRAINT `inscripcion_materia_ibfk_5`
FOREIGN KEY (`id_estado_inicial`) REFERENCES `estado_inscripcion_inicial`(`id`)
ON DELETE RESTRICT ON UPDATE CASCADE; ALTER TABLE `inscripcion_materia` ADD CONSTRAINT `inscripcion_materia_ibfk_6`
FOREIGN KEY (`id_estado_final`) REFERENCES `estado_inscripcion_final`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- 13/11/18 edicion tabla asiste, eliminar tabla asistencia
ALTER TABLE `asiste` ADD `id_estado` INT(11) NULL AFTER `id_curso`, ADD `asistencia` TEXT NULL COMMENT 'json' AFTER `id_estado`, ADD INDEX (`id_estado`) USING BTREE;
ALTER TABLE `asiste` ADD CONSTRAINT `asiste_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estado_asistencia`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- 16/11/18 borrar tabla asistencia, se usa solo "asiste"
DROP TABLE `asistencia`

-- 17/11/18 tabla estado_asistencia ya no se utiliza
ALTER TABLE `asiste` DROP FOREIGN KEY `asiste_ibfk_3`;
ALTER TABLE `asiste` DROP INDEX `id_estado`;
ALTER TABLE `asiste` DROP `id_estado`;
DROP TABLE `estado_asistencia`;
-- agregar columna faltas a asiste
ALTER TABLE `asiste` ADD `faltas` INT(2) NULL DEFAULT NULL AFTER `porcentaje`;


-- 25/11/18 poblar tablas estado inscripcion
INSERT INTO `estado_inscripcion_final` (`id`, `nombre`, `nomenclatura`, `es_cursado`, `es_mesa`) VALUES
(1, 'Desaprobado', 'D', 1, 1),
(2, 'Aprobado', 'A', 1, 1),
(3, 'Promoción', 'P', 1, 0),
(4, 'Libre', 'L', 1, 1),
(5, 'Equivalencia', 'E', 1, 1);

INSERT INTO `estado_inscripcion_inicial` (`id`, `nombre`, `nomenclatura`, `es_cursado`, `es_mesa`) VALUES
(1, 'Regular', 'R', 1, 1),
(2, 'Libre', 'L', 0, 1),
(3, 'Aprobado', 'A', 0, 1),
(4, 'Equivalencia', 'E', 0, 1);
