<?php

/*
The MIT License (MIT)

Copyright (c) <2015> <Gabriel Asakawa - gabriel.asakawa@gmail.com>

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

	Fecha creacion		= 20-02-2015
	Desarrollador		= GASAKAWA
	Fecha modificacion	= 23-02-2015
	Usuario Modifico	= GASAKAWA

*/


    class Database{
        
        var $cx;
        var $db;
        
        
        function Database(){
            $this->cx=new Conexion();   
        }
        
        function executeQuery($sql){
            $this->db=$this->cx->conectar();
            $result = $this->db->Execute($sql);
            $i = 0;
            while($row = $result->FetchRow()){
                $rows[$i] = $row;
                $i++;
            }

            $this->db=$this->cx->desconectar();
            return $rows;
        }
        
        function executeQueryOneRow($sql){
            $this->db=$this->cx->conectar();
            $result = $this->db->Execute($sql);
            $i = 0;
            $row = $result->FetchRow();

            $this->db=$this->cx->desconectar();
            return $row;
        }
        
        function getWizardQuery($idPage){
            $sql = " SELECT NB_WIZARD_TITLE,NB_WIZARD_DESC,NB_WIZARD_SHOW_PROGRESS FROM NB_WIZARD_TBL WHERE NB_ID_PAGE_FLD = '$idPage'";
            return $this->executeQuery($sql);
            
        }
        
        function getWizardStepsQuery($idPage){
            $sql = "SELECT NB_WIZARD_STEP_TITLE, NB_WIZARD_STEP_DESC FROM NB_WIZARD_STEPS_TBL WHERE NB_ID_PAGE_FLD = '$idPage'";
            return $this->executeQuery($sql);
            
        }
        
        function getWizardBindingsQuery($idPage){
            $sql = "SELECT NB_ID_PR_SCHEMA_FLD, NB_ID_WIZARD_STEP FROM NB_WIZARD_BIND_TBL WHERE NB_ID_PAGE_FLD = '$idPage' ORDER BY NB_ID_WIZARD_STEP_ORDER, NB_ID_WIZARD_STEP";
            return $this->executeQuery($sql);
        }
        
        function getWizardButtonQuery($idPage){
            $sql = "SELECT NB_WIZARD_BUTTON_NAME, NB_WIZARD_BUTTON_TITLE, NB_WIZARD_BUTTON_VALIDATE, NB_WIZARD_BUTTON_CLICK FROM NB_WIZARD_BUTTONS_TBL WHERE NB_ID_PAGE_FLD = '$idPage'";
            return $this->executeQuery($sql);   
        }
        
        function getValidateRole($idRole, $idPage){
            $sql = "SELECT NB_ID_ROLE_FLD,NB_ID_PAGE_FLD FROM NB_ROLE_PAG_TBL WHERE NB_ID_ROLE_FLD = $idRole AND NB_ID_PAGE_FLD = '$idPage'";
            return $this->executeQueryOneRow($sql);   
        }
        
        function getMaxHijo($idPage, $papa){
            $sql = "SELECT MAX(A.NB_ID_MENU_FLD) FROM NB_NAVIGATION_TBL A WHERE A.NB_ID_PAGE_FLD='$idPage' AND A.NB_PARENT_FLD ='$papa'";
            return $this->executeQueryOneRow($sql);
        }
        
        function getMenuHijos($idPage, $id){
            $sql = "SELECT COUNT(1) FROM  NB_NAVIGATION_TBL A WHERE A.NB_ID_PAGE_FLD='$idPage' AND A.NB_PARENT_FLD='$id'";
            return $this->executeQueryOneRow($sql);   
        }
        
        function getPageProperties($idPage){
            $sql = "SELECT NB_PAGE_TITLE_FLD title,NB_PAGE_STYLE_FLD style,NB_PAGE_TRACE_FLD trace,NB_PAGE_TYPE_FLD tipo FROM NB_PAGES_TBL WHERE NB_ID_PAGE_FLD='$idPage'";
            return $this->executeQueryOneRow($sql);   
        }
        
        function getSchemaDescription($idPage){
            $sql = "SELECT A.NB_TITLE_FLD, A.NB_DESCRIPTION_FLD, A.NB_TYPE_FLD FROM NB_SCHEMA_TBL A WHERE  A.NB_ID_PAGE_FLD = '$idPage'";
            return $this->executeQueryOneRow($sql);   
        }
        
        function getFormFields($idPage, $type){
            $sql = "SELECT DISTINCT A.NB_ID_PR_SCHEMA_FLD FROM  NB_FORMS_TBL A , NB_CONFIG_FRMWRK_TBL B WHERE A.NB_CONFIG_FRMWRK_ID_FLD = B.NB_CONFIG_FRMWRK_ID_FLD AND  B.NB_CONFIG_TYPE_FLD='$type' AND A.NB_ID_PAGE_FLD = '$idPage'";
            return $this->executeQuery($sql);   
        }
        
        function getFormFieldsTypes($idPage, $type, $field){
            $sql = "SELECT B.NB_PROPERTY_FLD,B.NB_TYPE_FLD,A.NB_SCHEM_VALUE_FLD FROM NB_FORMS_TBL A , NB_CONFIG_FRMWRK_TBL B WHERE A.NB_CONFIG_FRMWRK_ID_FLD = B.NB_CONFIG_FRMWRK_ID_FLD AND B.NB_CONFIG_TYPE_FLD='$type' AND A.NB_ID_PAGE_FLD = '$idPage' AND A.NB_ID_PR_SCHEMA_FLD ='$field'";
            return $this->executeQuery($sql);   
        }
        
        function getPageType($idPage){
            $sql = "SELECT A.NB_TYPEALPACA_FLD TYPE FROM NB_OPTION_TBL A WHERE A.NB_ID_PAGE_FLD = '$idPage'";
            return $this->executeQueryOneRow($sql);   
        }
        
        function getOptionsEvents($idPage){
            $sql = "SELECT A.NB_TYPEALPACA_FLD ALPACA,CONCAT(A.NB_ACTION_PATH,A.NB_ACTION_FLD,'.php?p=$idPage') EVENT FROM NB_OPTION_TBL A WHERE A.NB_ID_PAGE_FLD = '$idPage'";
            return $this->executeQueryOneRow($sql);   
        }
        
        function getFormButtonsQuery($idPage){
            $sql = "SELECT A.NB_ID_OPT_FORM_FLD,A.NB_VALUE_FLD,A.NB_TITLE_FLD,A.NB_CLICK_FLD FROM NB_OPTIONS_BUTTONS_TBL A WHERE A.NB_ID_PAGE_FLD = '$idPage'";
            return $this->executeQuery($sql);   
        }
        
        function getChartDataQuery($idPage, $type){
            $sql = "SELECT NB_VALUE_FLD, NB_COLOR_FLD FROM NB_CHART_DATA_TBL WHERE NB_ID_PAGE_FLD = '$idPage' AND NB_TYPE_FLD='$type' ORDER BY NB_POS_FLD";
            return $this->executeQuery($sql);   
        }

         
       
    }
?>