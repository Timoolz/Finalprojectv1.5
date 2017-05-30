<?php
/////////

function mod($a,$b){
  $x1=(int) abs($a/$b);
  $x2=$a/$b;
  return $a-($x1*$b);    
 }    
 
 
function send_email($to = array(),$subject,$message){
    
    
    require_once 'PHPMailer-master/PHPMailerAutoload.php';
                 
                $results_messages = array();
                 
                $mail = new PHPMailer(true);
                $mail->CharSet = 'utf-8';
                ini_set('default_charset', 'UTF-8');
                 
                class phpmailerAppException extends phpmailerException {}
                 
                try {
                
                
              
                if(!PHPMailer::validateAddress($to)) {
                  throw new phpmailerAppException("Email address " . $to . " is invalid -- aborting!");
                }
                $mail->isSMTP();
                $mail->SMTPDebug  = 2;
                $mail->Host       = "smtp.gmail.com";
                $mail->Port       = "465";
                $mail->SMTPSecure = "ssl";
                $mail->SMTPAuth   = true;
                $mail->isHtml();
                $mail->Username   = "olamide.laleye@stu.cu.edu.ng";
                $mail->Password   = "laleye123";
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
                  $mail->send();
                  $results_messages[] = "Message has been sent using SMTP";
                }
                catch (phpmailerException $e) {
                  throw new phpmailerAppException('Unable to send to: ' . $to. ': '.$e->getMessage());
                }
                }
                catch (phpmailerAppException $e) {
                  $results_messages[] = $e->errorMessage();
                }
                 
                if (count($results_messages) > 0) {
                  echo "<h2>Run results</h2>\n";
                  echo "<ul>\n";
                foreach ($results_messages as $result) {
                  echo "<li>$result</li>\n";
                }
                echo "</ul>\n";
                }
                
    
    
    
}
 
function int_connection(){
    $connection = @fsockopen("www.google.com", 80);
    if($connection){
        $is_conn = true;
        fclose($connection);
    }
    else{
        $is_conn = false;
    }
    
    return $is_conn;
}

function getcurrentdate(){
    $currdate = getdate();
    $currday  = $currdate['mday'];
    $currmon  = $currdate['mon'];
    if ($currday <= 9) {
     $currday = ("0". $currday);
    }
    else {
     $currday = $currday;
    }
    if ($currmon <= 9) {
     $currmon = ("0". $currmon);
    }
    else {
     $currmon = $currmon;
    }
    $curryear = $currdate['year'];
    
    $currdate = $curryear.'-'.$currmon.'-'.$currday;
    
    return $currdate;
    
    
}
function date_difference($a,$b){
    
    $ya= substr($a,0,4);
    $ma= substr($a,5,2);
    $da= substr($a,8,2);
    
    $yb= substr($b,0,4);
   
    $mb= substr($b,5,2);
    $db= substr($b,8,2);
    
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
   
   
    
    if($db<$da){// day difference
        $db+=$mbtot;
        $mb--;
        $diffd=$db - $da;

    }
    else{
        $diffd = $db-$da;
    }
    
    if($mb<$ma){// month difference
        $mb+=12;
        $yb--;
        $diffm=$mb - $ma;

    }
    else{
        $diffm = $mb-$ma;
    }
    
    
    $diffy = $yb-$ya; //year difference
    
    $diff  = $diffy;
    return $diff;
    
}
?>