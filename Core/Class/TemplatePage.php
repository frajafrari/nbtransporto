<?php

/*
The MIT License (MIT)

Copyright (c) <2015> <Carlos Alberto Garcia Cobo - carlosgc4@gmail.com>

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

	Fecha creacion		= 28-02-2015
	Desarrollador		= CAGC
	Fecha modificacion	= 03-03-2015
	Usuario Modifico	= CAGC

*/

include "../Class/Menu.php";
include "../Class/Utilities.php";


class TemplatePage
{
	var $menu;
	var $idPage;
	var $title;
	var $objUtilities;
	var $pageProperties;
    var $render;
    

	function TemplatePage($id_page){
        
		$this->objUtilities = new Utilities();
		$this->idPage=$this->objUtilities->idPage($id_page);
		$this->pageProperties=$this->objUtilities->pageProperties($this->idPage);
		$this->title=$this->pageProperties['title'];
		$this->tipo=$this->pageProperties['tipo'];
		if ($this->tipo == 'datagrid')
			$this->render=$this->objUtilities->getDataGrid($this->idPage);
		
		$this->header();
		$this->body();
		$this->tail();
	}


	function header(){
?>
		<!DOCTYPE html>
		<html>
			<head>

				<meta charset="UTF-8"/>
				<meta name="author" content="nabu" />

                <title><?php echo $this->title ?></title>

				<!-- Propias -->
				
                <link href="../Styles/nabu.css" rel=stylesheet type=text/css>
				<link rel="icon" type="image/x-icon" href="../Images/logo.ico"/>
                    
          		<!-- dependencies (jquery, handlebars and bootstrap) -->
                
                <script type="text/javascript" src="../Framework/jquery/dist/jquery.min.js"></script>
                
               
				<script type="text/javascript" src="../Framework/handlebars/handlebars.min.js"></script>
				<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
                <link type="text/css" href="../Framework/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
				
                <!-- alpaca -->
				
                <link type="text/css" href="../Framework/alpaca/dist/alpaca/bootstrap/alpaca.min.css" rel="stylesheet"/>
				<script type="text/javascript" src="../Framework/alpaca/dist/alpaca/bootstrap/alpaca.min.js"></script>
                
				<!-- Menu -->
			    
                <script src="../Framework/mmenu/src/js/jquery.mmenu.min.js" type="text/javascript"></script>
   				<link href="../Framework/mmenu/src/css/jquery.mmenu.all.css" type="text/css" rel="stylesheet" />
   				<link type="../Framework/mmenu/src/css/extensions/jquery.mmenu.iconbar.css" rel="stylesheet" />
				<link type="text/css" rel="stylesheet" href="../Styles/menuNabu.css" />
				<link type="text/css" href="../Framework/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
                
                <!-- Tables -->
                
                <!--http://www.datatables.net/ -->
                <link type="text/css" rel="stylesheet" href="../Framework/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet" />
                <script type="text/javascript" src="../Framework/datatables/media/js/jquery.dataTables.min.js"></script>
                
                <!-- Datagrid -->
                
                <link rel='stylesheet' type='text/css' media='screen' href='../Framework/Datagrid/lib/js/themes/cobo/jquery-ui.custom.css'></link>
                <link rel='stylesheet' type='text/css' media='screen' href='../Framework/Datagrid/lib/js/jqgrid/css/ui.jqgrid.css'></link>
				
                <script src='../Framework/Datagrid/lib/js/jqgrid/js/i18n/grid.locale-es.js' type='text/javascript'></script>
				<script src='../Framework/Datagrid/lib/js/themes/jquery-ui.custom.min.js' type='text/javascript'></script>
                <script src='../Framework/Datagrid/lib/js/jqgrid/js/jquery.jqGrid.min.js' type='text/javascript'></script>
				
                <!-- Charts -->
                <script src="../Framework/Chart.js/Chart.js" type='text/javascript'></script>

                <!-- jQuery UI Support -->
                <script type="text/javascript" src="../Framework/jquery-ui/jquery-ui.min.js"></script>

                <script type="text/javascript">
                    $(function() {
                        $("nav#menu").mmenu(
                            {
                                slidingSubmenus: false,
                                "classes": "mm-light"
                            })
                    ;}
                     );
                </script>        
            
            </head>
<?php
    }

	function banner(){
?>
    <div class="Menuheader"><a href="#menu"></a></div>

    <div class="content">
	<header>
			<table width="100%">
				<tr>
					<td colspan="1">&nbsp&nbsp<img src="../Images/logo.png" ></td>
				</tr>
				<tr>
					<td class="slogan">&nbsp&nbsp Semilla de innovación para dar vida a tus ideas</td>
					<td class="banderas"  colspan="1">
						<img src="../Images/col-flag.png" >
						<img src="../Images/uk-flag.png" >
                        <img src="../Images/bra-flag.png" >
					</td>
				</tr>
			</table>
		</header>


		<br><br>
<?php
		$this->menu = new Menu($this->idPage,$this->objUtilities);
	}
    
	function body(){
?>
		<body>
			<?php $this->banner(); ?>
			 <div align='center'>
				<?php

					$style=$this->pageProperties['style'];
					$trace=$this->pageProperties['trace'];
                    
                    if ($this->tipo == 'alpaca'){
	
                        $schema=$this->objUtilities->getSchema($this->idPage);
                        $options=$this->objUtilities->getOption($this->idPage);
                        $data =$this->objUtilities->getData($this->idPage);
                        $view =$this->objUtilities->getView($this->idPage);
                        
                        
                        $this->objUtilities->forms($style,$trace,$schema,$options,$data, $view);
					}
                    if ($this->tipo == 'datagrid'){
                    ?>    
                        <div style="margin:10px">
                            <?php echo $this->render ?>
                        </div>
                    <?php
                    }
                    if ($this->tipo == 'chart'){
                        $this->objUtilities->legend($this->idPage);
                    ?>
                        <div style="width: 60%">
			               <canvas id="canvas" height="300" width="600"></canvas> 
                        </div>
                    <?php
                        $this->objUtilities->charts($this->idPage,'');  
                    }
                    if ($this->tipo == 'wizard'){
                        $schema = $this->objUtilities->getSchema($this->idPage);
                        $options=$this->objUtilities->getOption($this->idPage);
                        $view =$this->objUtilities->getView($this->idPage);
                        $this->objUtilities->forms($style,$trace,$schema,$options,"", $view);
                    }
                    ?>
			</div>
<?php
	echo '<br><br><br><br>';
    }

	function tail() {
?>
		      <footer class="footer">
			            <a href="#"><i class="fa fa-facebook"></i></a>
				        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-google-plus"></i></a>
                        <a href="#"><i class="fa fa-youtube"></i></a>    
				        <a href="http://cagc4.github.io/Nabu/" TARGET="_blank"><i class="fa fa-github"></i></a>
                        <p>Nabu &copy; 2015</p>
		        </footer>
            
                </div>    
			</body>
		</html>

<?php
	}
}
?>
