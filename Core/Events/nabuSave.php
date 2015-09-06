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

	Fecha creacion		= 12-05-2015
	Desarrollador		= frajafrari

*/

    include "../Class/Utilities.php";

	$objUtilities = new Utilities();

	$idPage=$_GET['p'];

	$db = $objUtilities->cx->conectar();
   
    $result = $db->Execute("SELECT distinct nb_id_pr_Schema_fld FROM nb_forms_tbl where nb_id_page_fld ='$idPage'");

	$insert = "INSERT INTO usr_" . $idPage . "_tbl VALUES(0";
	while ($row = $result->FetchRow()){
		if (isset($_POST[$row[0]])){
			$insert .= ", '" . $_POST[$row[0]] . "'";
		}
	}
	$insert .= ')';
	echo $insert;
	$result =$db->Execute($insert);

	if ($result != null) {
		$result = $db->Execute("SELECT nb_link_fld FROM nb_option_tbl where nb_id_page_fld = '$idPage'");
		$row = $result->FetchRow();
		header("location:../Pages/?p=" . $row[0]);
	}
	$db=$objUtilities->cx->desconectar();
?>