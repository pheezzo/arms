<?php
error_reporting(0);
class ValidateForm{
  var $ValidType=array('text','numeric','email','empty','null');
  var $ErrString="";
  var $retval=true;  // 17APR10: Assumed true initially
  var $ErrtxtPrefix='<div class="errortxt">';
  var $ErrtxtSufix='</div>';
  var $ErrPrefix='<fieldset  class="errorhead"><legend>Validation Error</legend>';
  var $ErrSufix='<br /></fieldset>';

function IsEmail($value){
if(!$this->IsEmpty($value)){
 if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $value)) return false;else return true; 
 }elseif($this->IsEmpty($value)){
   return false;
  }
}


function IsText(){
$this->retval=false;
 if(!$this->IsEmpty($value)){
  if(is_string($value)) return true;else return false;
   }elseif($this->IsEmpty($value)){
   return false;
   }
}

function IsNull($value){
if(is_null($value)) return true;else return false;
}

function IsHtml(){
}
function IsSCheck($value){
if(count($value)<=0) return false;else return true;
}
function IsMCheck($value){
if(count($value)<=1) return false;else return true;
}
function IsEmpty($value){
 if(strlen(trim($value))==0 || trim($value)=="") return true;else return false;
}

function IsValidType($Type){
 if(in_array($this->ValidType) ) return true;else return false;
}		
function IsNumeric($value){
 if(!$this->IsEmpty($value)){
  if(ctype_digit($value)){return true;} else{ return false;}
   }else if($this->IsEmpty($value)){
   return false;
  }
}	
/*
function SetError($Err){
if(!$this->IsEmpty($this->ErrorString)){
  $this->ErrorString.="<BR/>";
  $this->ErrorString.=$this->ErrtxtPrefix.$Err.$this->ErrtxtSufix;
  }
  elseif($this->IsEmpty($this->ErrorString)){
  $this->ErrorString.=$this->ErrPrefix.$this->ErrtxtPrefix.$Err.$this->ErrtxtSufix;
  }
}*/



function SetError($Err){
if(!$this->IsEmpty($this->ErrorString)){
  $this->ErrorString.="<BR/>";
  $this->ErrorString.=$Err;
  }
  elseif($this->IsEmpty($this->ErrorString)){
  $this->ErrorString.=$Err;
  }
}

function ValidField($Value,$CType,$ErrText="Invalid Error Type",$Params=array('Default'=>'','Min'=>false,'Max'=>false)){
  switch($CType){
  
  case "text":
  if(!$this->IsEmpty($Value) && $Min && strlen(trim($Value))<$Min){
    $ErrText=" Required Minimum  ".$Min." Character";  
	$this->SetError($ErrText);   
	$this->retval=false;  
  }
  elseif(!$this->IsEmpty($Value) && $Max && strlen(trim($Value))>$Max){
    $ErrText=" Required Maximum ".$Max." Character";
    $this->SetError($ErrText);   
	$this->retval=false;
  }
  elseif(!$this->IsText($Value)) {
	$this->SetError($ErrText);
	$this->retval=false;
  } 
  #else $this->retval=true;
  break;
   
   case "numeric":
   if(!$this->IsEmpty($Value) && $Params['Min'] && strlen(trim($Value))<$Params['Min']){
    $ErrText=" Required Minimum  ".$Params['Min']." Number"; 
	$this->SetError($ErrText);   
	$this->retval=false;
   }
   elseif(!$this->IsEmpty($Value) && $Params['Max'] && strlen(trim($Value))>$Params['Max']) {
    $ErrText=" Required Maximum  ".$Params['Max']." Number"; 
	$this->SetError($ErrText);
	$this->retval=false;  
   }
   elseif(!$this->IsNumeric($Value) || is_float($Value)){
   $ErrText="Invalid Phone Number";
   $this->SetError($ErrText);
   $this->retval=false;
   }
   elseif($this->IsEmpty($Value))  {$this->SetError($ErrText);$this->retval=false;} #else $this->retval=true;
   break;
   
   case "email":
   if(!$this->IsEmail($Value))    {$this->SetError($ErrText);$this->retval=false;} #else $this->retval=true;
   break;
   
   case "empty":
    if($this->IsEmpty($Value))    {$this->SetError($ErrText);$this->retval=false;} #else $this->retval=true;
   break;
   
   case "null":
   if($this->IsNull($Value))     {$this->SetError($ErrText);$this->retval=false;} #else $this->retval=true;
   break;
   case "SCheck":
   if(!$this->IsSCheck($Value))   {$this->SetError($ErrText);$this->retval=false;} #else $this->retval=true;
   break;
   case "MCheck":
   if(!$this->IsMCheck($Value))   {$this->SetError($ErrText);$this->retval=false;} #else $this->retval=true;
   break;
   case "RCheck":
   if(!isset($Value) || !$this->IsSCheck($Value))   {$this->SetError($ErrText);$this->retval=false;} #else $this->retval=true;
   break;
   case "Select":
   if(!isset($Value) || $Value==$Params['Default'])   {$this->SetError($ErrText);$this->retval=false;} #else $this->retval=true;
   break;
   default:
   $this->SetError($this->ErrString);
   break;  
  }
$this->ErrorString; 
 return $this->retval;
}
						
}
if(count($_POST)>0){
$Form=new ValidateForm();
 foreach($_POST as $key => $value){
   $$key=$value;  //clean_input( 17APR10: clean_input in commonscripts.php 
 }
}
?>