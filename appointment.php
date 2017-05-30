<?php
    $dropmenu = new dropdownmenu;


?>
<!-- Form Validation scripts -->
    <script src="jscripts/validate/appointment_val.js"></script>
    <script type="text/javascript">
    
    </script>
<body>
  <div class="divwrap">
   <form name="apform" id="apform" method="post" action="">
    <table id="tbapform" >
      <tr>
        <td>&nbsp;</td>
        <td colspan="4">
        </td>
        <td>&nbsp;</td>  
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="25%"><label for="fname"> First Name</label></td>
        <td ><input name="fname" id="fname" type="text"  />
        </td>
        <td><label for="lname"> Last Name</label></td>
        <td ><input name="lname" id="lname" type="text"  />
        </td>
        <td>&nbsp;</td>  
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><label for="emailad"> E-mail</label></td>
        <td ><input name="emailad" id="emailad" type="text"  />
        </td>
        <td><label for="phoneno"> Phone Number</label></td>
        <td ><input name="phoneno" id="phoneno" type="text"  />
        </td>
        <td>&nbsp;</td>  
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><label for="colname"> College</label></td>
        <td colspan="3">
            <?php
            
            $arrcoll = array(
                'College of SCience and Technologyy'=>'CST',
                'College of Business Studies'       =>'CBSS',
                'College of Leadership development' =>'CLDS',
                'College of Engineering'            =>'CENG'
            
            );
            
            
            $dropmenu->anyarroptions='';
            $dropmenu->fillanyarr($arrcoll,'Select College');
            $dropmenu->SetName("colname","colname");
            $dropmenu->CreateBox($dropmenu->anyarroptions);
            
            
            ?>
        
        </td>
        <td>&nbsp;</td>  
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>
        <label for="curqualification"> Current Qualification</label>
        </td>
        <td colspan="3">
                <?php
                
                $dropmenu->qualoptions='';
                $dropmenu->fillqualification();
                $dropmenu->SetName("curqualification","curqualification");
                $dropmenu->CreateBox($dropmenu->qualoptions,'NONE');
                
                
                ?>
        </td>
        <td>&nbsp;</td>   
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>
        <label for="curposition"> Current Position</label>
        </td>
        <td colspan="3">
            <?php
            
            $dropmenu->lectoptions='';
            $dropmenu->filllectposition();
            $dropmenu->SetName("curposition","curposition");
            $dropmenu->CreateBox($dropmenu->lectoptions);
            
            
            ?>
       </td>
    <td>&nbsp;</td>   
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
        <label for="dtolp"> Date of last Promotion</label>
        </td>
        <td width="20%">
        
            <?php
            
            $dropmenu->doptions='';
            $dropmenu->fillmonthdays(1);
            $dropmenu->SetName("dolp","dolp");
            $dropmenu->CreateBox($dropmenu->doptions);
            
            
            ?>
       </td>
       <td width="25%">
        
            <?php
            
            $dropmenu->moptions='';
            $dropmenu->fillmonth();
            $dropmenu->SetName("molp","molp");
            $dropmenu->CreateBox($dropmenu->moptions);
            
            
            ?>
       </td>
       <td width="20%">
        
            <?php
            
            $dropmenu->doptions='';
            $dropmenu->fillyear(1,75,1);
            $dropmenu->SetName("yolp","yolp");
            $dropmenu->CreateBox($dropmenu->yoptions);
            
            
            ?>
       </td>
    <td>&nbsp;</td>   
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>
        <label for="appposition"> Position you are Applying for</label>
        </td>
        <td colspan="3">
            <?php
            
            $dropmenu->lectoptions='';
            $dropmenu->filllectposition();
            $dropmenu->SetName("appposition","appposition");
            $dropmenu->CreateBox($dropmenu->lectoptions,'NONE');
            
            
            ?>
       </td>
    <td>&nbsp;</td>   
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>    
    <td>&nbsp;</td>    
    </tr>    
        <textarea id="template" style="display: none;">
          <tr id="tbr{0}">
            <td>&nbsp;</td>
            <td>
            <label>Add Scopus publication ({0})</label>
            </td>
            <td colspan="3" >
            <input style="width: 95%;" class="scopus" type="text" name="pubeid{0}" id="pubeid{0}" placeholder="Enter Publication name"  required/>
            </td>
            <!--<td><input type="button" id="chkscopus{0}" class="chkscop" name="chkscopus{0}"   value="Check" /></td>-->
            <td>&nbsp;</td>
          </tr>
          
          <tr id="tbr{0}h" style=" display: none;" >
          <td>&nbsp;</td>
          <td colspan="4">
          <div class="loader" id="load{0}">
          <img src="cstylesheets/images/spin.gif" width="22px" height="22px" align="center" alt="Loading"  />
          </div>
          <div id="scpscr{0}" class="scpscr" style=" display: none;"> </div>
          
          </td>
          <td>&nbsp;</td>
          </tr>
        </textarea>
    <tbody class="scopadd"></tbody>
<!--    <tr>
    <td>&nbsp;</td>
    <td colspan="2">
	<label>Publications (max 25)</label>
	</td>
	<td class="pubs">
	<input id="pubs" name="pubs" value="0" max="25" readonly="readonly" size='4'/>
	</td>
	<td class="totals-error"></td>
    <td>&nbsp;</td>
	</tr>-->
    <!--<tr>
    <td>&nbsp;</td>
    <td colspan="2">
    <input type="button" id="addpub" value="Add  Publication" name="addpub" />
      
    </td>
    <td colspan="2">
    
    <input type="button" id="removepub" value="Remove last Publication" name="removepub" />   
    </td>
    <td>&nbsp;</td>
    </tr>-->
    <tr>
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
    <td>&nbsp;</td> 
       <td >
        <input id="submit" type="submit" value="Submit Application" />
       </td>
       
    <td>&nbsp;</td>    
    </tr>
</table>
</form>

<div id="ffg"> 
 <div class="loader" id="load">
 <img src="cstylesheets/images/spin.gif" width="400px" height="400px" align="center" alt="Loading"  />
 </div>
</div>
</div>
</body>