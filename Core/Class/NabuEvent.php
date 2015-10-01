<?php

/*
The MIT License (MIT)

Copyright (c) <2015> <Francisco Javier Franco Rivera - frajafrari@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

	Fecha creacion		= 24-09-2015
	Desarrollador		= frajafrari

*/

class NabuEvent
{
	var $page;
	var $post;
	function NabuEvent($id_page, $post) {
		$this->page = $id_page;
		$this->post = $post;
	}
	
	function Save() {
		$respcode = 0;
		$location = "";
		$tables = $db->Execute("SELECT distinct nb_id_table_fld FROM nb_form_tables_tbl where nb_id_page_fld ='" . $this->page . "'");
		while ($table = $tables->FetchRow()) {
			$fields = $db->Execute("SELECT nb_id_page_field_fld, nb_id_table_field_fld FROM nb_form_tables_tbl where nb_id_page_fld ='" . $this->page . "' and nd_id_table_fld = '" .$table['nb_id_table_fld'] . "'");
			$field = $fields->FetchRow();
			while ($field){
				$types = $db->Execute("SELECT nb_type_fld FROM nb_table_fields_tbl where nb_id_fld ='" . $field['nb_id_table_field_fld'] . "' and nd_id_table_fld = '" .$table['nb_id_table_fld'] . "'");
				$type = $types->FetchRow();
				if (isset($post[$field['nb_id_page_field_fld']])){
					$fieldsTable .= "'" . $post[$field['nb_id_table_field_fld']] . "'";					
					switch($type['nb_type_fld']) {
						case 'string':
							$fieldsValues .= "'" . $post[$field['nb_id_page_field_fld']] . "'";
							break;
						case 'number':
							$fieldsValues .= "" . $post[$field['nb_id_page_field_fld']];
							break;
						case 'date':
							$fieldsValues .= "to_date('yyyy/mm/dd', '" . $post[$field['nb_id_page_field_fld']] . "'";
							break;
					}
					
				}
				else {
					switch($type['nb_type_fld']) {
						case 'string':
							$fieldsValues .= "''";
							break;
						case 'number':
							$fieldsValues .= "0";
							break;
						case 'date':
							$fieldsValues .= "to_date('yyyy/mm/dd', '1980/01/01')";
							break;
					}
				}
				$field = $fields->FetchRow();
				if($field) {
					$fieldsTable .= ", ";
					$fieldsValues .= ", ";
				}
			}
			$insert = "INSERT INTO " .$table['nb_id_table_fld'] . "(" . $fieldsTable . ") VALUES(" . $fieldsValues . ")";
			$result =$db->Execute($insert);
			if(!$result)
				$respcode = 99;
		}
		$result = $db->Execute("SELECT nb_link_fld FROM nb_option_tbl where nb_id_page_fld = '" . $this->page . "'");
		$row = $result->FetchRow();
		if($respcode == 0)
			$location = "location:../Pages/?p=" . $row['nb_link_fld'];
		else
			$location = "location:../Pages/?p=" . $row['nb_link_fld'] . "&err=" . $respcode;
		return $location;
	}
}
?>
