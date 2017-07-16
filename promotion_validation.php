
<?php
    require_once 'creds/creds.php';
    include_once('functions/generalfunctions01.php');
    include("classes/validateappointment.php"); 
    
      
    $fname         = $_POST['fname'];
    $lname         = $_POST['lname'];
    $emailad       = $_POST['emailad'];
    $phoneno       = $_POST['phoneno'];
    $dolp          = $_POST['dolp'];
    $molp          = $_POST['molp'];
    $yolp          = $_POST['yolp'];
    $colname       = $_POST['colname'];
    $appposition   = $_POST['appposition'];
    $curposition   = $_POST['curposition'];
    $qualification = $_POST['curqualification']; 
    
    
    
    $dateolp   = $yolp.'-'.$molp.'-'.$dolp;
    $fullname  = $fname.' '.$lname;
    
    
    
    // To get all publication eids
    $pubeid = array();
   
    
    // To get all Conferences eids
    $conf = array();
    $totalconf = 0;
    
   // To get Score for publication
    $score = array();
    $totalscore = 0;
    
    for ($i=1;$i<=25;$i++){
        $poststring = "score".$i;
        
        if (isset($_POST[$poststring])){ //loops through score posts sent
        
        
            $stringeid = "pubeid".$i;
        
            if (isset($_POST[$stringeid])){ //loops through eid posts sent
                
                //echo 'found '.$stringeid;
                $pubeid[$i] = $_POST[$stringeid];
                
                
            }
            
            $conf = "conf".$i;
            
            if (isset($_POST[$conf])){
                
                //echo 'found '.$conf;
                $conf[$i] = $_POST[$conf];
                
                $totalconf +=$conf[$i];
            }
            
            //echo 'found '.$poststring;
            $score[$i] = $_POST[$poststring];
            
            $totalscore +=$score[$i];
            
        }
        
    }
    
    //var_dump($pubeid);
//    var_dump($totalscore);



    $appointment = new appvalidator;
    $appointment->eidvals='';
    $appointment->setperdetails($fullname,$emailad,$phoneno,$qualification,$colname);
    
    $appointment->setappdetails($curposition,$appposition,$dateolp,$totalpubscore,$confcount,$pubarr,$puburlarr);
    $appointment->validate();
    
    $publst = '';
    if(is_Array($appointment->eidvals)){
        foreach($appointment->eidvals as $lll){
            $publst .= $lll.'__';
           
        }
    }
    else{
        $publst = $appointment->eidvals;
    }
    
    // To g
    $urllst = '';
    if(is_Array($appointment->urlvals)){
        foreach($appointment->urlvals as $llj){
            $urllst .= $llj.'__';
           
        }
    }
    else{
        $urllst = $appointment->urlvals;
    }
    

    require_once 'creds/creds.php';
    require_once("dbscripts/dbconnection.php");
    
   
    
    if ($appointment->validatecounter==false){
        
        
        try{
            
            $dbh->beginTransaction();
            $sql ="INSERT INTO appointments (fullname, emailad, phoneno, college, curposition, appposition, dateolp, dateoap, publications, publications_url, publication_score, approval_status, comments) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sth = $dbh->prepare($sql);
            
            
            
            
            $res = $sth -> execute(array($appointment->fullname,$appointment->emailaddress,$appointment->phonenumber,$appointment->college,$appointment->currentpos,$appointment->appointmentpos,$appointment->dateolp,getcurrentdate(),$publst,$urllst,$appointment->pubscore,0,$appointment->validateerror));
           
            if($res){
                
                    print "<pre>";
                    print "<h3>     Unable to complete your application           </h3>";
                    print "<br /><span> Name : ".$appointment->fullname."</span>";
                    print "<br /><span> Application Position : ".$appointment->appointmentpos."</span>";
                    print "<br /><span> Publication Score Attained : ".$appointment->pubscore."</span>";
                    print "<br /><span> Required publication score for Position : ".$appointment->reqscore."</span>";
                    print "<br /><span> Required experience in Current Position : ".$appointment->reqexp." Years</span>";
                    
                    //print "<br /><span> Total number of Publications : ".count($appointment->eidvals)."</span>";
                    print "<br /><span> Number of Conference papers used : ".$appointment->confscore."</span>";
                    print "<br /><span> Approval Status : <b>Not approved</b> </span>";
                    print "<br /><span> Reason : ".$appointment->validateerror."</span>";
                    print "</pre>";
                   
                  
                  
                
                
                    
            }
            
            $dbh->commit();
            $sth = null;
            $dbh = null;
        }
        catch(PDOException $e){
            //var_dump($e);
            $dbh->rollBack();
            echo "Failed: " . $e->getMessage();
        }
    }
    else{
        //var_dump($appointment->validateresponse);
        
        
        
        try{
            
            $dbh->beginTransaction();
            $sql ="INSERT INTO appointments (fullname, emailad, phoneno, college, curposition, appposition, dateolp, dateoap, publications, publications_url, publication_score, approval_status, comments, dateofint) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sth = $dbh->prepare($sql);
            
            
            
            
            $res = $sth -> execute(array($appointment->fullname,$appointment->emailaddress,$appointment->phonenumber,$appointment->college,$appointment->currentpos,$appointment->appointmentpos,$appointment->dateolp,getcurrentdate(),$publst,$urllst,$appointment->pubscore,1,'',$appointment->getintdate()));
           
            if($res){
                print "<pre>";
                    //print "<h3>     SIR THIS IS A TEST     </h3>";
                    print "<h3>     Your application is being processed you will be contacted shortly.     </h3>";
                    print "<br /><span> Name : ".$appointment->fullname."</span>";
                    print "<br /><span> Application Position : ".$appointment->appointmentpos."</span>";
                    print "<br /><span> Publication Score Attained : ".$appointment->pubscore."</span>";
                    print "<br /><span> Required publication score for Position : ".$appointment->reqscore."</span>";
                    print "<br /><span> Required experience in Current Position : ".$appointment->reqexp." Years</span>";
                    
                    //print "<br /><span> Total number of Publications : ".count($appointment->eidvals)."</span>";
                    print "<br /><span> Number of Conference papers used : ".$appointment->confscore."</span>";
                    print "<br /><span> Approval Status : <b>Approved</b> </span>";
                   
                    //print "</pre>";
                
                
                require_once 'PHPMailer-master/PHPMailerAutoload.php';
                 
                $results_messages = array();
                 
                $mail = new PHPMailer(true);
                $mail->CharSet = 'utf-8';
                ini_set('default_charset', 'UTF-8');
                 
                class phpmailerAppException extends phpmailerException {}
                 
                try {
                
                $to = $appointment->emailaddress;
                $subject = "Promotion Application";
                
                //$message = "
//                <html>
//                <head>
//                <title>Covenant Unversity A&PC</title>
//                </head>
//                <body>
//                <p>Dear ".$appointment->fullname."</p>
//                Your promotion application for the position<b> ".$appointment->appointmentpos."</b> has been Approved. \n
//                Your interview has been set for ".$appointment->getintdate().". Please do make yourself available. \n
//                Please do not reply this message, any further information will be communicated to you. 
//                
//                </body>
//                </html>
//                ";

                $message = "
                <html>
                <head>
                <title>Covenant Unversity A&PC</title>
                </head>
                <body>
                <p>Dear ".$appointment->fullname."</p>
                Your promotion application for the position<b> ".$appointment->appointmentpos."</b> is being processed. \n
                Please do not reply this message, any further information will be communicated to you. 
                
                </body>
                </html>
                ";
                
                
                
              
                if(!PHPMailer::validateAddress($to)) {
                  throw new phpmailerAppException("Email address " . $to . " is invalid -- aborting!");
                }
                $mail->isSMTP();
                $mail->SMTPDebug  = 0;
                $mail->Host       = "smtp.gmail.com";
                $mail->Port       = "465";
                $mail->SMTPSecure = "ssl";
                $mail->SMTPAuth   = true;
                $mail->isHtml();
                $mail->Username   = EMAILUSERNAME;
                $mail->Password   = EMAILUSERPASS;
                $mail->addReplyTo("olamide.laleye@stu.cu.edu.ng", "Laleye Olamide");
                $mail->setFrom("olamide.laleye@stu.cu.edu.ng", "Laleye Olamide");
                
                $mail->addAddress($appointment->emailaddress, $appointment->fullname);
                $mail->Subject  = $subject;
                $body = $message;
                $mail->WordWrap = 78;
                
                $mail->msgHTML($body, dirname(__FILE__), true); //Create message bodies and embed images
                //$mail->addAttachment('images/phpmailer_mini.png','phpmailer_mini.png'); //  optional name
                //$mail->addAttachment('images/phpmailer.png', 'phpmailer.png'); //  optional name
                 
                try {
                  $sendemail = $mail->send();
                  $results_messages[] = "Message has been sent using SMTP";
                }
                catch (phpmailerException $e) {
                  throw new phpmailerAppException('Unable to send to: ' . $to. ': '.$e->getMessage());
                }
                }
                catch (phpmailerAppException $e) {
                  $results_messages[] = $e->errorMessage();
                }
                 
                //if (count($results_messages) > 0) {
//                  echo "<h2>Run results</h2>\n";
//                  echo "<ul>\n";
//                foreach ($results_messages as $result) {
//                  echo "<li>$result</li>\n";
//                }
//                echo "</ul>\n";
//                }
                    
                if(isset($sendemail)){
                    
              
                
                  ?>
                
                  <?php echo "<span> A notification has been forwarded to your email :  ".($appointment->emailaddress)."</span>";?>
                  
                  
                  </pre>
                  <div  id="preventsubmit" style="display: none;"></div>
                  <?php
                
                }
                else{
                    
                  ?>
                
                  <?php echo "<span> Unable to forward notification to your email :  ".($appointment->emailaddress)."</span>";?>
                 
                  </pre>
                  <div  id="preventsubmit" style="display: none;"></div>
                  <?php
                    
                }
                
            }
            
            $dbh->commit();
            $sth = null;
            $dbh = null;

        }
        catch(PDOException $e){
            //var_dump($e);
            $dbh->rollBack();
            echo "Failed: " . $e->getMessage();
        } 
                           
    }

    
?> 