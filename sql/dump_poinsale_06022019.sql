/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50716
Source Host           : localhost:3306
Source Database       : pointtosale

Target Server Type    : MYSQL
Target Server Version : 50716
File Encoding         : 65001

Date: 2019-02-06 20:28:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `catalog_address`
-- ----------------------------
DROP TABLE IF EXISTS `catalog_address`;
CREATE TABLE `catalog_address` (
  `id_address` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `del_mun` varchar(100) DEFAULT NULL,
  `colony` varchar(100) DEFAULT NULL,
  `cp` varchar(20) DEFAULT NULL,
  `str_av` varchar(200) DEFAULT NULL,
  `outdoor_number` varchar(50) DEFAULT NULL,
  `interior_number` varchar(50) DEFAULT NULL,
  `type_address` varchar(50) DEFAULT NULL,
  `id_person` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_address`),
  KEY `id_person` (`id_person`),
  CONSTRAINT `fk_person_addres` FOREIGN KEY (`id_person`) REFERENCES `catalog_person` (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of catalog_address
-- ----------------------------
INSERT INTO `catalog_address` VALUES ('1', 'Pais', 'Estado de Mexico', 'Valle de Chalco', 'Alfredo del Mazo', '56619', 'calle pt 5', '2', '1', 'casa', '1');

-- ----------------------------
-- Table structure for `catalog_contac`
-- ----------------------------
DROP TABLE IF EXISTS `catalog_contac`;
CREATE TABLE `catalog_contac` (
  `id_contact` int(11) NOT NULL AUTO_INCREMENT,
  `contacttype` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL,
  `id_person` int(11) NOT NULL,
  PRIMARY KEY (`id_contact`),
  KEY `fk_user_id` (`id_person`),
  CONSTRAINT `fk_person_contac` FOREIGN KEY (`id_person`) REFERENCES `catalog_person` (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of catalog_contac
-- ----------------------------
INSERT INTO `catalog_contac` VALUES ('1', 'h', 'x', 'des', '1', '1');
INSERT INTO `catalog_contac` VALUES ('2', 'Z', 'D', 'H', '1', '1');

-- ----------------------------
-- Table structure for `catalog_person`
-- ----------------------------
DROP TABLE IF EXISTS `catalog_person`;
CREATE TABLE `catalog_person` (
  `id_person` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) DEFAULT NULL,
  `last_name` varchar(70) DEFAULT NULL,
  `mother_lastname` varchar(70) DEFAULT NULL,
  `age` int(2) DEFAULT NULL,
  `sexo` enum('Masculino','Femenino','Otro') DEFAULT NULL,
  `curp` varchar(50) DEFAULT NULL,
  `rfc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of catalog_person
-- ----------------------------
INSERT INTO `catalog_person` VALUES ('1', 'Cesar', 'Salgado', 'Lima', '34', 'Masculino', 'SALC8412151W2', 'SAL');

-- ----------------------------
-- Table structure for `system_module_group`
-- ----------------------------
DROP TABLE IF EXISTS `system_module_group`;
CREATE TABLE `system_module_group` (
  `cve_modulegroup` char(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `orden` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`cve_modulegroup`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of system_module_group
-- ----------------------------
INSERT INTO `system_module_group` VALUES ('ACCES', 'Seguridad', null, '1', '3');
INSERT INTO `system_module_group` VALUES ('ADMIN', 'Gestión', null, '1', '2');
INSERT INTO `system_module_group` VALUES ('SYSTEM', 'Sistema', null, '1', '1');

-- ----------------------------
-- Table structure for `system_module_type`
-- ----------------------------
DROP TABLE IF EXISTS `system_module_type`;
CREATE TABLE `system_module_type` (
  `id_moduletype` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_moduletype`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of system_module_type
-- ----------------------------
INSERT INTO `system_module_type` VALUES ('1', 'MENU', null, '1');
INSERT INTO `system_module_type` VALUES ('2', 'ACCION', null, '1');
INSERT INTO `system_module_type` VALUES ('3', 'MODAL', null, '1');

-- ----------------------------
-- Table structure for `system_modulo`
-- ----------------------------
DROP TABLE IF EXISTS `system_modulo`;
CREATE TABLE `system_modulo` (
  `cve_module` char(25) NOT NULL,
  `modulename` varchar(100) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `url` varchar(255) NOT NULL,
  `id_moduletype` int(11) NOT NULL,
  `module_pather` char(25) DEFAULT NULL,
  `config_json` longtext,
  `orden` int(2) NOT NULL DEFAULT '1',
  `cve_modulegroup` char(10) DEFAULT NULL,
  `icon` char(50) DEFAULT NULL,
  PRIMARY KEY (`cve_module`),
  KEY `fk_modulo_padre` (`module_pather`),
  KEY `fk_module_type` (`id_moduletype`),
  CONSTRAINT `fk_module_type` FOREIGN KEY (`id_moduletype`) REFERENCES `system_module_type` (`id_moduletype`),
  CONSTRAINT `fk_modulo_padre` FOREIGN KEY (`module_pather`) REFERENCES `system_modulo` (`cve_module`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of system_modulo
-- ----------------------------
INSERT INTO `system_modulo` VALUES ('MOD_ALMACENES', 'Almacen', '1', '/almacen/index', '1', null, null, '3', 'SYSTEM', 'fas fa-fw fa-database');
INSERT INTO `system_modulo` VALUES ('MOD_ALMACENES_ENVSAL', 'Salida', '1', '/almacen/enviar_salida', '2', 'MOD_ALMACENES', null, '2', null, null);
INSERT INTO `system_modulo` VALUES ('MOD_ALMACENES_LISTADO', 'Lista almacen', '1', '/almacen/listado', '1', 'MOD_ALMACENES', null, '2', null, null);
INSERT INTO `system_modulo` VALUES ('MOD_ALMACENES_SALIDA', 'Salida', '1', '/almacen/salida', '1', 'MOD_ALMACENES', null, '2', 'SYSTEM', null);
INSERT INTO `system_modulo` VALUES ('MOD_CLIENTES', 'Clientes', '1', '/cliente/index', '1', null, null, '2', 'SYSTEM', 'fas fa-fw fa-users');
INSERT INTO `system_modulo` VALUES ('MOD_ENTRADAS', 'Entradas', '1', '/entradas/', '1', null, null, '7', 'SYSTEM', null);
INSERT INTO `system_modulo` VALUES ('MOD_INICIO_HOME', 'Inicio ', '1', '/inicio/home', '1', null, null, '1', null, 'fas fa-fw fa-home');
INSERT INTO `system_modulo` VALUES ('MOD_INVENTARIOS_INSUMOS', 'Inventarios', '1', '/inventario/index', '1', null, null, '4', 'ADMIN', null);
INSERT INTO `system_modulo` VALUES ('MOD_MODULOS', 'Módulos', '1', '#', '1', null, null, '1', 'ADMIN', null);
INSERT INTO `system_modulo` VALUES ('MOD_MODULOS_GRUPOS', 'Grupos módulos', '1', '/modulos/grupos', '1', 'MOD_MODULOS', null, '1', 'ADMIN', null);
INSERT INTO `system_modulo` VALUES ('MOD_MODULOS_LISTA', 'Listado de módulos', '1', '/modulos/listado', '1', 'MOD_MODULOS', null, '1', 'ADMIN', null);
INSERT INTO `system_modulo` VALUES ('MOD_MODULOS_PEAC', 'Accesos Perfil', '1', '/control/perfil_acceso', '1', 'MOD_MODULOS', null, '1', 'ADMIN', null);
INSERT INTO `system_modulo` VALUES ('MOD_MODULOS_TYMO', 'Definir Tipo de Modulo', '1', '/modulos/definir_modulo', '1', 'MOD_MODULOS', null, '1', 'ADMIN', null);
INSERT INTO `system_modulo` VALUES ('MOD_MODULOS_USMO', 'Modulos Usuarios', '1', '/modulos/acceso_usuarios', '1', 'MOD_MODULOS', null, '1', 'ADMIN', null);
INSERT INTO `system_modulo` VALUES ('MOD_PERFIL', 'Perfiles', '1', '/control/perfil', '1', 'MOD_MODULOS', null, '1', 'ADMIN', null);
INSERT INTO `system_modulo` VALUES ('MOD_PERFIL_ASPE', 'Asignar Perfil', '1', '/control/asignar_perfil', '1', 'MOD_MODULOS', null, '1', 'ADMIN', null);
INSERT INTO `system_modulo` VALUES ('MOD_PERSON', 'Persona', '1', '#', '1', null, null, '1', 'ADMIN', 'fas fa-fw fa-user');
INSERT INTO `system_modulo` VALUES ('MOD_PERSON_DACT', 'Datos de Contacto', '1', '/persona/datos_contacto', '1', 'MOD_PERSON', null, '1', 'ADMIN', null);
INSERT INTO `system_modulo` VALUES ('MOD_PERSON_DADR', 'Direccion Persona', '1', '/persona/direcciones', '1', 'MOD_PERSON', null, '1', 'ADMIN', null);
INSERT INTO `system_modulo` VALUES ('MOD_PERSON_DATOS', 'Datos Personales', '1', '/persona/datos_persona', '1', 'MOD_PERSON', null, '1', 'ADMIN', null);
INSERT INTO `system_modulo` VALUES ('MOD_PROVEEDOR', 'Proveedor', '1', '/proveedor/', '1', null, null, '5', 'SYSTEM', null);
INSERT INTO `system_modulo` VALUES ('MOD_SALIDAS', 'Salidas', '1', '/salidas/', '1', null, null, '8', 'SYSTEM', null);
INSERT INTO `system_modulo` VALUES ('MOD_USERS', 'Usuarios', '1', '#', '1', null, null, '1', 'ADMIN', 'fas fa-fw fa-user');
INSERT INTO `system_modulo` VALUES ('MOD_USERS_DAPE', 'Datos Usuarios', '1', '/usuarios/datos_usuario', '1', 'MOD_USERS', null, '1', 'ADMIN', null);
INSERT INTO `system_modulo` VALUES ('MOD_USERS_LISTA', 'Definir Perfil', '1', '/usuarios/index', '1', 'MOD_USERS', null, '1', 'ADMIN', null);
INSERT INTO `system_modulo` VALUES ('MOD_VENTAS', 'Ventas', '1', '/ventas/', '1', null, null, '6', 'SYSTEM', null);

-- ----------------------------
-- Table structure for `system_other_data_user`
-- ----------------------------
DROP TABLE IF EXISTS `system_other_data_user`;
CREATE TABLE `system_other_data_user` (
  `id_other_data_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `cp` int(6) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `active` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_other_data_user`),
  KEY `fk_user_data` (`id_user`),
  CONSTRAINT `fk_user_data` FOREIGN KEY (`id_user`) REFERENCES `system_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of system_other_data_user
-- ----------------------------

-- ----------------------------
-- Table structure for `system_rol`
-- ----------------------------
DROP TABLE IF EXISTS `system_rol`;
CREATE TABLE `system_rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `rolname` varchar(100) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of system_rol
-- ----------------------------
INSERT INTO `system_rol` VALUES ('1', 'Superusuario');
INSERT INTO `system_rol` VALUES ('2', 'Administrador');
INSERT INTO `system_rol` VALUES ('3', 'Supervisor');
INSERT INTO `system_rol` VALUES ('4', 'Agente de ventas');
INSERT INTO `system_rol` VALUES ('5', 'Cliente');

-- ----------------------------
-- Table structure for `system_rol_modulo`
-- ----------------------------
DROP TABLE IF EXISTS `system_rol_modulo`;
CREATE TABLE `system_rol_modulo` (
  `cve_modulo` char(25) NOT NULL,
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`cve_modulo`,`id_rol`),
  KEY `fk_rol_id_modulo` (`id_rol`),
  CONSTRAINT `fk_modulo_cve_rol` FOREIGN KEY (`cve_modulo`) REFERENCES `system_modulo` (`cve_module`),
  CONSTRAINT `fk_rol_id_modulo` FOREIGN KEY (`id_rol`) REFERENCES `system_rol` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of system_rol_modulo
-- ----------------------------
INSERT INTO `system_rol_modulo` VALUES ('MOD_ALMACENES', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_ALMACENES_ENVSAL', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_ALMACENES_LISTADO', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_ALMACENES_SALIDA', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_CLIENTES', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_ENTRADAS', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_INICIO_HOME', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_INVENTARIOS_INSUMOS', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_MODULOS', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_MODULOS_GRUPOS', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_MODULOS_LISTA', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_MODULOS_PEAC', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_MODULOS_TYMO', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_MODULOS_USMO', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_PERFIL', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_PERFIL_ASPE', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_PERSON', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_PERSON_DACT', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_PERSON_DADR', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_PERSON_DATOS', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_PROVEEDOR', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_SALIDAS', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_USERS', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_USERS_DAPE', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_USERS_LISTA', '2');
INSERT INTO `system_rol_modulo` VALUES ('MOD_VENTAS', '2');

-- ----------------------------
-- Table structure for `system_user`
-- ----------------------------
DROP TABLE IF EXISTS `system_user`;
CREATE TABLE `system_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `id_person` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_person` (`id_person`),
  CONSTRAINT `fk_person_usr` FOREIGN KEY (`id_person`) REFERENCES `catalog_person` (`id_person`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of system_user
-- ----------------------------
INSERT INTO `system_user` VALUES ('1', 'root', 'cenitluis.pumas@gmail.com', '9080b0f0e6ece4157fe58f4a6e5a9c51420ca025703e34e24eb782fccb3c04faca73cdae506a466ab5c13693ad7032c9908159f705e2541c20a257d19c40eba4', 'OPDFP98d', '1', '1');

-- ----------------------------
-- Table structure for `system_user_modulo`
-- ----------------------------
DROP TABLE IF EXISTS `system_user_modulo`;
CREATE TABLE `system_user_modulo` (
  `id_user` int(11) NOT NULL,
  `cve_modulo` varchar(25) NOT NULL,
  `acceso` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_user`,`cve_modulo`),
  KEY `fk_modulo_user` (`cve_modulo`),
  CONSTRAINT `fk_modulo_user` FOREIGN KEY (`cve_modulo`) REFERENCES `system_modulo` (`cve_module`),
  CONSTRAINT `fk_user_mod` FOREIGN KEY (`id_user`) REFERENCES `system_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of system_user_modulo
-- ----------------------------
INSERT INTO `system_user_modulo` VALUES ('1', 'MOD_SALIDAS', '0');
INSERT INTO `system_user_modulo` VALUES ('1', 'MOD_USERS', '1');

-- ----------------------------
-- Table structure for `system_user_rol`
-- ----------------------------
DROP TABLE IF EXISTS `system_user_rol`;
CREATE TABLE `system_user_rol` (
  `id_user` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  PRIMARY KEY (`id_user`,`id_rol`),
  KEY `fk_rol_user` (`id_rol`),
  CONSTRAINT `fk_rol_user` FOREIGN KEY (`id_rol`) REFERENCES `system_rol` (`id_rol`),
  CONSTRAINT `fk_user_rol` FOREIGN KEY (`id_user`) REFERENCES `system_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of system_user_rol
-- ----------------------------
INSERT INTO `system_user_rol` VALUES ('1', '2');
