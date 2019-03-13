/* agregar para la configuracion extra de los modulos*/
CREATE TABLE `system_module_conf_extra` (

`cve_cong_extra` char(25) NOT NULL,

`name` varchar(100) NOT NULL,

`descripcion` varchar(255) NULL,

`activo` bit NOT NULL DEFAULT 1,

`conf` text NULL,

`cve_module` char(25) NOT NULL,

PRIMARY KEY (`cve_cong_extra`, `cve_module`) 

);

ALTER TABLE `system_module_conf_extra` ADD CONSTRAINT `fk_modulos_conf_extra` FOREIGN KEY (`cve_module`) REFERENCES `system_modulo` (`cve_module`);