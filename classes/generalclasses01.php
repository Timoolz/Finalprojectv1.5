<?php 

 //////////////////////////////////////////  
 class dropdownitems {
    
    
    function fillanyarr($lst,$narr) {   
   if ( !empty($narr) ) $this->anyarroptions[$narr]= "NONE";
       
     foreach ($lst as $desc => $code){
        $this->anyarroptions[$desc] = $code;
        
     }
  }
  
  
  
  function filllectposition() {
   $this->lectoptions["Select Position"]        ="NONE";
   $this->lectoptions["Assistant Lecturer"]     ="AL";
   $this->lectoptions["Lecturer II"]            ="L2";
   $this->lectoptions["Lecturer I"]             ="L1";
   $this->lectoptions["Senior Lecturer"]        ="SL";
   $this->lectoptions["Associate Professor"]    ="AP";
   $this->lectoptions["Professor"]              ="PR";
   
  }
  
  
   function fillqualification() {
   $this->qualoptions["Select Qualification"]   ="NONE";
   $this->qualoptions["Bachelors Degree"]       ="BSC";
   $this->qualoptions["Masters Degree"]         ="MSC";
   $this->qualoptions["Doctorate Degree"]       ="PHD";
   
   
  }
  
  function fillyesno() {      
   $this->ynoptions['(Y/N)'] = "NONE"; 
   $this->ynoptions['Yes']   = "Y";
   $this->ynoptions['No']    = "N"; 
  }   
  
  function fillnumbers($pcount,$start) {   
   for ($xi=$start;$xi <= $pcount;$xi++) { 
    $desc  = $xi;
    $code  = $xi;
    $this->numoptions[$desc]=$code;
   }
  } 

  function fillnumbers2($pcount,$start,$interval,$title) {   
   if ($title != "") {
    $this->numoptions[$title]="NONE";
   }
   else {
    $this->numoptions['Select']="NONE";    
   } 
   
   for ($xi=$start;$xi <= $pcount;) { 
    $desc  = $xi;
    $code  = $xi;
    $this->numoptions[$desc]=$code;
    $xi = ($xi + $interval);
   }
  } 
  
  
  function fillmarstatusb() {
   $this->mstaoptions["Marital Status"]   ="NONE";
   $this->mstaoptions["Single"]   ="S";
   $this->mstaoptions["Married"]  ="M";
   $this->mstaoptions["Seperated"]="P";
   $this->mstaoptions["Divorced"] ="D";
   $this->mstaoptions["Domestic Partner"] ="T";
   $this->mstaoptions["Widowed"]  ="C";
  }
  
  
  
    function fillmonthdays($month) {
   
   $this->doptions["Day"] = "NONE";
   //Check Leap Year
   $today = getdate();   
   $y = $today['year'];   
   $leapy=((mod($y,4)==0) && ((mod ($y,100)<>0) || (mod($y,400)==0)));
    
   //Month Group
   if (($month==9) || ($month==4) || ($month==6) || ($month==11)){
    $mgrp = 1;
   }
   else if ($month==2){
    $mgrp = 2;
   }
   else {
    $mgrp = 3;
   }
    
   for ($i=1; $i<=31; $i++) {
    if ($i <= 9) {
     $x = ("0". $i);
    }
    else {
     $x = $i;
    }
    
    if ( ($month==0) || ($i <= 28) || ($mgrp == 3) ||
         (($i==29) && ($mgrp ==2) && ($leapy)) || 
         (($mgrp == 1) && ($i <= 30)) ) {
     
     $this->doptions[$x] = $x;
    }
     
   }   
  } 
    
  function fillyear($lowerage,$upperage,$fyear) {
    
   $this->yoptions["Year"] = "NONE";
         
   //Init
   if ($lowerage <= 0){
    $lowerage = 13;
   }
   if ($upperage <= 0) {
    $upperage = 80;
   }
   //
   $today = getdate();   
   $y = $today['year'];   
   $start = ($y - $lowerage + $fyear);
   //     
   for ($i=$upperage; $i>=$lowerage; $i--) {
     
    $this->yoptions[$start] =  $start;
    $start 		    = ($start - 1); 
     
   }   
  }
    
    
   function fillgender() {
   $this->goptions["Gender"]="NONE";
   $this->goptions["Male"]="M";
   $this->goptions["Female"]="F";
   $this->goptions["N/A"]="N";
  }
    
  function fillmonth() {
   $this->moptions["Month"]="NONE";
   $this->moptions["January"]="01";
   $this->moptions["February"]="02";
   $this->moptions["March"]="03";
   $this->moptions["April"]="04";
   $this->moptions["May"]="05";
   $this->moptions["June"]="06";
   $this->moptions["July"]="07";
   $this->moptions["August"]="08";
   $this->moptions["September"]="09";
   $this->moptions["October"]="10";
   $this->moptions["November"]="11";
   $this->moptions["December"]="12";
  }
    
 }//end of dropdownmenu
                             
    //////////////////////////////////////////
 /**
  * dropdownmenu
  * 
  * @package Final Project
  * @author Laleye Olamide
  * @copyright 2017
  * @access public
  */
 class dropdownmenu extends dropdownitems {
   
  function SetName($name,$id=""){
   $this->myid   = ""; 
   $this->myname = $name;
   if ($id != "") $this->myid = $id; 
  }
    	
  //function SetOption($optionvalue,$optionname){
  // $this->options[$optionname] = $optionvalue;
  //}
  
  // fuction edited  by me Olamide
   
  function CreateBox($optionsarray,$selected="NONE",$actionline="",$required=false,$multiple=false,$search=true){
  
  
  $len      = count($optionsarray);
  //var_dump($actionline); 
  
  print "<SELECT name='".$this->myname."' class='selbox";
  if($search==true)//check if it is searchable
  {
  print " chosen-select'";
  }
  print"  id='" . $this->myid . "'";
   if ($actionline <> "") {
    print " onChange='".$actionline."'" ;
    }
   else{
    print " onChange='".$actionline."'" ;
    }
  if ($multiple) {
    print " multiple='multiple' ";
   }
  print " >\n";
  if($optionsarray) {
    // Create Options
    foreach($optionsarray as $optionname=>$optionvalue) {
     
     print "<OPTION value='$optionvalue'";
     
     // NB: Extended this library to suite the multiple selection.... /n/n 
     // USAGE: the multiple selection option value should be gotten and set into an array containing the save value as key => value pair 
     // e.g $myArr[value] = value;
     if ( $multiple ) { // Check if its multiple then iterate through using the selected index.
        if( isset( $selected[$optionvalue] ) && $selected[$optionvalue] == $optionvalue ){ // Check if option should be selected
            print " SELECTED";
        }
     }
     else {
        // Check if option should be selected
        if( $selected == $optionvalue ){
            print " SELECTED";
        }
     }
    print ">$optionname</OPTION>\n";
    }
   				
    print "</SELECT> "; 
      
     
   }
   else {
    print "<OPTION value='NONE'";
    print ">No Option Found</OPTION>\n";
    
    print "</SELECT></div>";  
         
   }
   }
  
}
 //////////////////////////////////////////
                    
?>