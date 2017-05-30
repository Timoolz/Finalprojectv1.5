<?php
class validation{
    
    public $fullname = '';
    public $emailaddress = '';
    public $phonenumber = '';
    public $dateolp = 00000000;
    public $currentqual = '';
    public $currentpos = '';
    public $appointmentpos = '';
    public $college = '';
    public $pubscore = 0;
    public $confscore = 0;
    public $reqscore = null;
    public $reqexp   = null;
    public $curexp   = 0;    
    
    
    
    function setperdetails($fullname,$emailad,$phone,$qualification,$college){
        $this->fullname = $fullname;
        
        $this->emailaddress = $emailad;
        
        $this->phonenumber = $phone;
        $this->college = $college;
        $this->currentqual = $qualification;
        
        
    }
    
    function setappdetails($currpos,$apppos,$dateolp,$pubscore,$confscore,$pubeids = array()){
        $this->currentpos = $currpos;
        $this->appointmentpos = $apppos;
        $this->dateolp = $dateolp;
        $this->pubscore = $pubscore;
        $this->confscore = $confscore;
        foreach ($pubeids as $incre => $eid){
        $this->eidvals[$incre] = $eid;
        
        }
    }
    
    
    
}


class appvalidator extends validation{
    
    var $validatecounter  = true;
    var $validateerror    = "";
    var $validateresponse = "";
    function validate(){
        
        
        
//        
//        var_dump($this->currentpos);
//        var_dump($this->eidvals);
//        var_dump($this->appointmentpos);
//        var_dump($this->dateolp);
//        var_dump($this->pubscore);
//        var_dump(getcurrentdate()); 
//        var_dump($this->currentqual);
//        var_dump($this->confscore);       
//        
//       
        
        $this->curexp = date_difference($this->dateolp,getcurrentdate());
//        var_dump($this->curexp);
        
        if ($this->confscore > 5)
        {
        $this->validatecounter = false;
        $this->validateerror = " Maximum Of Five Conference proceedings has been exceeded";
        
        }
    
        
        
        
        switch ($this->appointmentpos){//Swithes throught the various Appointment positions
            case "AL":
            
                $this->validateresponse=" This is the Minimal Position for all Teaching staffs";
            
                break ;
                
            case "L2":
                $this->reqscore = 18;
                $this->reqexp   = 3;
                
                if($this->currentpos!='AL'){
                    $this->validatecounter = false;
                    $this->validateerror   = "Only an Assistant Lecturer is eligible for this position";
                }
                
                if($this->pubscore < $this->reqscore){
                    $this->validatecounter = false;
                    $this->validateerror   = "You did not meet the required Total publication post for this position";
                    
                }
                
                if($this->currentqual !='PHD'){
                    
                    if($this->curexp<$this->reqexp){
                        $this->validatecounter = false;
                        $this->validateerror   = "PHD is required for this position or Three years experience as Assistant Lecturer";
                    
                    }
                   
                }
                
            
                break ;
            
            case "L1":
                $this->reqscore = 25;
                $this->reqexp   = 3;
                
                if($this->currentpos!='L2'){
                    $this->validatecounter = false;
                    $this->validateerror   = "Only a Lecturer II is eligible for this position";
                }
                
                if($this->pubscore < $this->reqscore){
                    $this->validatecounter = false;
                    $this->validateerror   = "You did not meet the required Total publication post for this position";
                    
                }
                
                
                if($this->currentqual !='PHD'){
                    
                    if($this->curexp<$this->reqexp){
                        $this->validatecounter = false;
                        $this->validateerror   = " Three years experience as  Lecturer II is Required";
                    
                    }
                   
                }
                
            
            
                break ;
                
            case "SL":
                $this->reqscore = 30;
                $this->reqexp   = 3;
                
                if($this->currentpos!='L1'){
                    $this->validatecounter = false;
                    $this->validateerror   = "Only a Lecturer I is eligible for this position";
                }
                
                if($this->pubscore < $this->reqscore){
                    $this->validatecounter = false;
                    $this->validateerror   = "You did not meet the required Total publication post for this position";
                    
                }
                
                if($this->currentqual !='PHD'){
                    $this->validatecounter = false;
                    $this->validateerror   = "PHD is a Compulsory Requirement for this Position ";
                   
                }
                
                if($this->curexp<$this->reqexp)
                {
                    $this->validatecounter = false;
                    $this->validateerror   = " Three years experience as  Lecturer I is Required";
                    
                }
            
            
                break ;
                
            case "AP":
                $this->reqscore = 35;
                $this->reqexp   = 2;
                
                if($this->currentpos!='SL'){
                    $this->validatecounter = false;
                    $this->validateerror   = "Only a Senior Lecturer is eligible for this position";
                }
                
                if($this->pubscore < $this->reqscore){
                    $this->validatecounter = false;
                    $this->validateerror   = "You did not meet the required Total publication post for this position";
                    
                }
                
                if($this->currentqual !='PHD'){
                    $this->validatecounter = false;
                    $this->validateerror   = "PHD is a Compulsory Requirement for this Position ";
                   
                }
                
                if($this->curexp<$this->reqexp)
                {
                    $this->validatecounter = false;
                    $this->validateerror   = " Two years experience as  Senior Lecturer is Required";
                    
                }
            
            
                break ;
                
            case "PR":
                $this->reqscore = 40;
                
                if(($this->currentpos=='AP') || ($this->currentpos=='SL')){
                    
                    if($this->currentqual !='PHD'){
                    $this->validatecounter = false;
                    $this->validateerror   = "PHD is a Compulsory Requirement for this Position ";
                   
                    }
                    
                    if($this->pubscore < $this->reqscore){
                    $this->validatecounter = false;
                    $this->validateerror   = "You did not meet the required Total publication post for this position";
                    
                    }
                    
                    switch ($this->currentpos){
                        
                        case 'AP':
                            $this->reqexp   = 2;
                            if($this->curexp<$this->reqexp)
                            {
                                $this->validatecounter = false;
                                $this->validateerror   = " Two years experience as  Associate Professor is Required";
                                
                            }
                            
                            break;
                        
                        case 'SL':
                            $this->reqexp   = 5;
                            if($this->curexp<$this->reqexp)
                            {
                                $this->validatecounter = false;
                                $this->validateerror   = " Five years experience as  Senior Lecturer is Required";
                                
                            }
                            
                            break;
                        
                        
                        
                        default:
                        
                    }
                    
                    
                    
                    }
                else{
                    $this->validatecounter = false;
                    $this->validateerror   = "Only an Associate Professor or Senior Lecturer is eligible for this position";
                
                    
                }
                
                
                
            
            
                break ;
                
                    
            default:
                $this->validatecounter = false;
                $this->validateerror   = "No Appointment Position was chosen";
                
                
            
            
            
        }
    }
    function getintdate(){
        $nowdate = getcurrentdate();
        $yb= substr($nowdate,0,4);
   
        $mb= substr($nowdate,5,2);
        $db= substr($nowdate,8,2);
        
        $leapy=((mod($yb,4)==0) && ((mod ($yb,100)<>0) || (mod($yb,400)==0)));
        
        
       //Month Group
       if (($mb==9) || ($mb==4) || ($mb==6) || ($mb==11)){
        $mbtot = 30;
       }
       else if ($mb==2){
        if($leapy){
            $mbtot = 29;
        }
        else{
            $mbtot = 28;}
        
       }
       else {
        $mbtot = 31;
       }
       
       
        
        $newday = $db + 14;
        if($newday>$mbtot){
            $intday = $newday - $mbtot;
            if($mb==12){
                $mb = 1;
                $yb= $yb+1;
            }
            else{
                $mb  = $mb+1;
            }
            
            
        }
        else{
            $intday = $newday;
        }
        
        return $yb.'-'.$mb.'-'.$intday;
        
        
    }
}


?>