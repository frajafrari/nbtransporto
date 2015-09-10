/*INSERTAR MENU */
insert into nb_navigation_tbl
select 
'addcustomer',	
nb_sec_fld,	
nb_parent_fld,	
nb_id_menu_fld,	
nb_descr_men_fld,	
nb_link_fld,	
nb_image_fld,	
nb_target_fld
from nb_navigation_tbl where nb_id_page_fld='home';

/*INSERTAR CAMPO EN FORMULARIO */

insert into NB_FORMS_TBL
SELECT 
nb_id_page_fld
,'nb_add_email_fld'
,nb_config_frmwrk_id_fld
,nb_schem_value_fld	
FROM NB_FORMS_TBL
WHERE nb_id_page_fld='addcustomer'
and  nb_id_pr_schema_fld ='nb_numerodoc_fld';

/*Insertar Atributos*/
insert into nb_pageattribute_tbl
select 'srccustomer',nb_id_attribute_fld from nb_pageattribute_tbl where nb_id_page_fld='home'