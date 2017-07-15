<div class="divwrap">

<?php

    require_once 'creds/creds.php';
    require_once("dbscripts/dbconnection.php");
    


      try {
            $sql = 'SELECT fullname , college, curposition, appposition, dateolp, dateoap, dateofint, publications
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
                    echo"<td><ul>";
                    
                    $puboccur = substr_count($tabledata['publications'],"__");
                    //var_dump($puboccur);
                    $postest = 0;
                    $checkstr = $tabledata['publications'];
                    for ($i=1;$i<=$puboccur+1;$i++){//To loop through publications
                        
                        if( ($x_pos = strpos($checkstr,"__")) !== FALSE )
                            {
                                
                                $source_str = substr($checkstr,$postest, $x_pos);
                                //var_dump($source_str);
                                echo "<li>".$source_str."</li>";
                                $checkstr = substr($checkstr,$x_pos+2,strlen($checkstr));
                                
                                
                                
                            }
                            
                            
                        }
                    echo "</ul></td>";
                    
                    echo"<td>&nbsp</td>";
                    echo "</tr>";
                    
                    
                }
                echo"</table>";
            }
        



?>

</div>