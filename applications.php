<div class="divwrap">

<?php

    require_once 'creds/creds.php';
    require_once("dbscripts/dbconnection.php");
    


      try {
            $sql = 'SELECT fullname , college, curposition, appposition, dateolp, dateoap, dateofint, publications, publications_url
                    FROM appointments
                    WHERE approval_status = 1 ';
            $sth = $dbh->prepare($sql);
            
            $ress = $sth->execute();
            
        }
          catch (PDOException $e) {
            print $e->getMessage();
          }
            
            if($ress == true){
                
                $data = $sth->fetchAll();
                
                //var_dump($data);
                echo"<table>";
                ?>
                <tr>
                <td>&nbsp;</td>
                    <td width="12%">
                    Name of Applicant
                    
                    </td>
                    <td width="11%">
                    College
                    
                    </td>
                    <td width="11%">
                    Current Position
                    
                    </td>
                    <td width="10%">
                    Position for Application
                    
                    </td>
                    <td width="8%">
                    Date of last Promotion
                    
                    </td>
                    <td width="8%">
                    Date applied
                    
                    </td>
                    <td width="8%">
                    Date of Interview
                    
                    </td>
                    <td width="">
                    Publications
                    
                    </td>
                    <td>&nbsp;</td>

                </tr>
                
                <?php
                foreach($data as $tabledata){
                    echo "<tr>";
                    echo"<td>&nbsp</td>";
                    echo"<td>".$tabledata['fullname']."</td>";
                    echo"<td>".$tabledata['college']."</td>";
                    echo"<td>".$tabledata['curposition']."</td>";
                    echo"<td>".$tabledata['appposition']."</td>";
                    echo"<td>".$tabledata['dateolp']."</td>";
                    echo"<td>".$tabledata['dateoap']."</td>";
                    echo"<td>".$tabledata['dateofint']."</td>";
                    echo"<td><div class = 'pubdiv'><ul>";
                    
                    $puboccur = substr_count($tabledata['publications'],"__");
                    $puburloccur = substr_count($tabledata['publications_url'],"__"); 
                    $postest = 0;
                    $posturltest = 0;
                    $checkstr = $tabledata['publications'];
                    $checkurlstr = $tabledata['publications_url'];
                    
                    for ($i=1;$i<=$puboccur+1;$i++){//To loop through publications and publicaions url
                        
                        if(( ($x_pos = strpos($checkstr,"__")) !== FALSE ) &&( ($x_posurl = strpos($checkurlstr,"__")) !== FALSE ))
                            {
                                
                                $source_str = substr($checkstr,$postest, $x_pos);
                                $sourceurl_str = substr($checkurlstr,$posturltest, $x_posurl);
                                //var_dump($source_str);
                                echo "<li><a href = '".$sourceurl_str."' target = '_blank'>".$source_str."</a></li>";
                                $checkstr = substr($checkstr,$x_pos+2,strlen($checkstr));
                                $checkurlstr = substr($checkurlstr,$x_posurl+2,strlen($checkurlstr));
                                
                                
                                
                            }
                            
                            
                        }
                        //var_dump($tabledata['publications_url']);
                       
                    
                    
                    
                        
                        
                    echo "</ul></div></td>";
                    
                    //echo"<td>&nbsp</td>";
                    echo "</tr>";
                    
                    
                }
                echo"</table>";
            }
        



?>

</div>