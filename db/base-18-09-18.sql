CREATE TABLE `estado_asistencia` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` VARCHAR(64) NOT NULL COMMENT "Descripcion",
  `nomenclatura` VARCHAR(4) COMMENT "Abreviacion"
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `estado_cursado` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` VARCHAR(64) NOT NULL COMMENT "Descripcion",
  `nomenclatura` VARCHAR(4) COMMENT "Abreviacion"
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tutor` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` VARCHAR(64) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tipo_documento` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` VARCHAR(64) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `nivel` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` VARCHAR(64) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `carrera` (
  `id` VARCHAR(11) NOT NULL PRIMARY KEY COMMENT "Codigo Plan",
  `id_nivel` INT(11) NOT NULL,
  `nombre` VARCHAR(128) NOT NULL,
  `acta` VARCHAR(256) COMMENT "ruta a archivo",
  `fecha` DATE,
  FOREIGN KEY (id_nivel) REFERENCES nivel(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `materia` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_carrera` VARCHAR(11) NOT NULL,
  `nombre` VARCHAR(128) NOT NULL,
  `codigo_anio` VARCHAR(24),
  `regimen_cursado` VARCHAR(24) COMMENT "individual o colectiva",
  `regimen_aprobacion` VARCHAR(24),
  `carga_horaria` INT(4),
  `tipo_catedra` VARCHAR(24) COMMENT "Anual o cuatrimestral",
  FOREIGN KEY (id_carrera) REFERENCES carrera(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `materia_correlativa` (
  `id_materia` INT(11) NOT NULL,
  `id_correlativa` INT(11) NOT NULL,
  PRIMARY KEY (id_materia,id_correlativa),
  FOREIGN KEY (id_materia) REFERENCES materia(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (id_correlativa) REFERENCES materia(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `provincia` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` VARCHAR(64) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ciudad` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `id_provincia` INT(11) NOT NULL,
  `nombre` VARCHAR(64) NOT NULL,
  PRIMARY KEY (id,id_provincia),
  FOREIGN KEY (id_provincia) REFERENCES provincia(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `persona` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_tipo_documento` INT(11) NOT NULL,
  `numero_documento` VARCHAR(11) NOT NULL,
  `nombre` VARCHAR(128) NOT NULL,
  `apellido` VARCHAR(128) NOT NULL,
  `domicilio` VARCHAR(128),
  `id_ciudad` INT(11),
  `telefono` VARCHAR(128),
  `email` VARCHAR(128),
  `fecha_nacimiento` DATE,
  -- `legajo` VARCHAR
  FOREIGN KEY (id_tipo_documento) REFERENCES tipo_documento(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (id_ciudad) REFERENCES ciudad(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `persona_tutor` (
  `id_persona` INT(11) NOT NULL,
  `id_responsable` INT(11) NOT NULL,
  `id_tutor` INT(11) COMMENT "Tipo de relacion",
  PRIMARY KEY (id_persona,id_responsable),
  FOREIGN KEY (id_persona) REFERENCES persona(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (id_responsable) REFERENCES persona(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (id_tutor) REFERENCES tutor(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `documentacion` (
  `id_persona` INT(11) NOT NULL PRIMARY KEY,
  `fotocopia_dni` TEXT,
  `titulo_secundario` TEXT,
  `fecha_inscripcion` DATE,
  `foto_carnet` TEXT,
  `certificado_nacimiento` TEXT,
  FOREIGN KEY (id_persona) REFERENCES persona(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- CREATE TABLE `coperadora` (
--   `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
--   `id_persona` INT(11) NOT NULL,
--   `valor` VARCHAR(64) NOT NULL,
--   `fecha` DATE NOT NULL,
--   FOREIGN KEY (id_persona) REFERENCES persona(id) ON DELETE RESTRICT ON UPDATE CASCADE
-- )ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `usuario` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_persona` INT(11) NOT NULL,
  `username` VARCHAR(128),
  `password` VARCHAR(256),
  FOREIGN KEY (id_persona) REFERENCES persona(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `perfil` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` VARCHAR(64) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `perfil_usuario` (
  `id_usuario` INT(11) NOT NULL,
  `id_perfil` INT(11) NOT NULL,
  `permisos` TEXT,
  PRIMARY KEY (id_usuario,id_perfil),
  FOREIGN KEY (id_usuario) REFERENCES usuario(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (id_perfil) REFERENCES perfil(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `curso` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_materia` INT(11) NOT NULL,
  `periodo` VARCHAR(64) NOT NULL,
  `diascursado` TEXT COMMENT "Json dias/horas",
  FOREIGN KEY (id_materia) REFERENCES materia(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `catedra` (
  `id_curso` INT(11) NOT NULL,
  `id_persona` INT(11) NOT NULL,
  PRIMARY KEY (id_curso,id_persona),
  FOREIGN KEY (id_curso) REFERENCES curso(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (id_persona) REFERENCES persona(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `asiste` (
`id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_persona` INT(11) NOT NULL,
  `id_curso` INT(11) NOT NULL,
  `porcentaje` INT(3) COMMENT "Porcentaje de asistencias",
  FOREIGN KEY (id_persona) REFERENCES persona(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (id_curso) REFERENCES curso(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `asistencia` (
  `id_asiste` INT(11) NOT NULL,
  `fecha` DATE NOT NULL,
  `id_estado` INT(11) NOT NULL,
  PRIMARY KEY (id_asiste,fecha),
  FOREIGN KEY (id_asiste) REFERENCES asiste(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (id_estado) REFERENCES estado_asistencia(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `mesa` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_materia` INT(11) NOT NULL,
  `fecha` DATE NOT NULL,
  FOREIGN KEY (id_materia) REFERENCES materia(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `inscripcion_materia` (
  `id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_persona` INT(11) NOT NULL,
  `id_curso` INT(11),
  `id_materia` INT(11),
  `id_mesa` INT(11),
  `id_estado` INT(11) NOT NULL,
  `calificacion` INT(3),
  `fecha` DATE,
  FOREIGN KEY (id_persona) REFERENCES persona(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (id_curso) REFERENCES curso(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (id_materia) REFERENCES materia(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (id_mesa) REFERENCES mesa(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (id_estado) REFERENCES estado_cursado(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tribunal` (
  `id_mesa` INT(11) NOT NULL,
  `id_persona` INT(11) NOT NULL,
  PRIMARY KEY (id_mesa,id_persona),
  FOREIGN KEY (id_mesa) REFERENCES mesa(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (id_persona) REFERENCES persona(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `inscripcion_carrera` (
  `id_persona` INT(11) NOT NULL,
  `id_carrera` varchar(11) NOT NULL,
  PRIMARY KEY (id_persona,id_carrera),
  FOREIGN KEY (id_persona) REFERENCES persona(id) ON DELETE RESTRICT ON UPDATE CASCADE,
  FOREIGN KEY (id_carrera) REFERENCES carrera(id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ci_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `ci_sessions_timestamp` (`timestamp`)
);
ALTER TABLE ci_sessions ADD PRIMARY KEY (id);
