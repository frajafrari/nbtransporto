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
	Fecha modificacion	= 28-02-2015
	Usuario Modifico	= CAGC

*/

class JsonData
{
    var $colu;
    var $data;

    public function JsonData()
    {
            
    }
    

    function query($flds,$rs){
        
        if (!isset($this->data))
            $this->data = array();
        
        if (!isset($this->colu))
            $this->colu = array();
        
        $j=0;
        while ($col =$flds->FetchRow()){
             $this->colu[$j]= $col[0];   
             $j=$j+1;
        }
        
        $i=0;
        while ($row =$rs->FetchRow()){
            for($j=1; $j<= count($this->colu); $j=$j+1 ){
                $campo="Campo".$j;
                $this->data[$i][$campo] = $row[$this->colu[$j-1]];
            }
            $i=$i+1;
        }
        
        return $this->data; 
    }
  
}

?>