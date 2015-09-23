# Host: localhost  (Version: 5.6.16)
# Date: 2015-09-23 08:11:33
# Generator: MySQL-Front 5.3  (Build 4.198)

/*!40101 SET NAMES latin1 */;

#
# Structure for table "nb_htmlattribute_tbl"
#

DROP TABLE IF EXISTS `nb_htmlattribute_tbl`;
CREATE TABLE `nb_htmlattribute_tbl` (
  `nb_id_attribute_fld` int(11) NOT NULL DEFAULT '0',
  `nb_attribute_fld` varchar(255) NOT NULL DEFAULT '0',
  `nb_url_fld` varchar(255) DEFAULT NULL,
  `nb_type_fld` varchar(255) DEFAULT NULL,
  `nb_rel_fld` varchar(255) DEFAULT NULL,
  `nb_descripcion_fld` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`nb_id_attribute_fld`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

#
# Data for table "nb_htmlattribute_tbl"
#

/*!40000 ALTER TABLE `nb_htmlattribute_tbl` DISABLE KEYS */;
INSERT INTO `nb_htmlattribute_tbl` VALUES (1,'link','../Styles/nabu.css','text/css','stylesheet','Estilos Nabu'),(2,'link','../Images/logo.ico','image/x-icon','icon','Icono'),(3,'script','//code.jquery.com/jquery-1.11.1.min.js','text/javascript',NULL,'Libreria Jquery'),(4,'script','//cdnjs.cloudflare.com/ajax/libs/handlebars.js/3.0.3/handlebars.js','text/javascript',NULL,'Handlebars'),(5,'script','//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js','text/javascript',NULL,'Bootstrap'),(6,'link','//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css','text/css','stylesheet','Bootstrap'),(7,'link','http://code.cloudcms.com/alpaca/1.5.13/bootstrap/alpaca.min.css','text/css','stylesheet','Alpaca'),(8,'script','http://code.cloudcms.com/alpaca/1.5.13/bootstrap/alpaca.min.js','text/javascript',NULL,'Alpaca'),(9,'script','../Framework/mmenu/src/js/jquery.mmenu.min.js\" type=\"text/javascript','text/javascript',NULL,'Menu'),(10,'link','../Framework/mmenu/src/css/jquery.mmenu.all.css','text/css','stylesheet','Menu'),(11,'link','../Framework/mmenu/src/css/extensions/jquery.mmenu.iconbar.css','text/css','stylesheet','Menu'),(12,'link','../Styles/menuNabu.css','text/css','stylesheet','Menu'),(13,'link','https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css','text/css','stylesheet','Menu'),(16,'link','../Framework/Datagrid/lib/js/themes/cobo/jquery-ui.custom.css','text/css','stylesheet','Datagrid'),(17,'link','../Framework/Datagrid/lib/js/jqgrid/css/ui.jqgrid.css','text/css','stylesheet','Datagrid'),(18,'script','../Framework/Datagrid/lib/js/jqgrid/js/i18n/grid.locale-es.js','text/javascript',NULL,'Datagrid'),(19,'script','../Framework/Datagrid/lib/js/themes/jquery-ui.custom.min.js','text/javascript',NULL,'Datagrid'),(20,'script','../Framework/Datagrid/lib/js/jqgrid/js/jquery.jqGrid.min.js','text/javascript',NULL,'Datagrid'),(22,'script','https://code.jquery.com/ui/1.11.4/jquery-ui.js','text/javascript',NULL,'jQuery UI Support');
/*!40000 ALTER TABLE `nb_htmlattribute_tbl` ENABLE KEYS */;
