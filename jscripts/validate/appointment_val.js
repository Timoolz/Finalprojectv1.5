
 $.noConflict();
  jQuery( document ).ready(function( $ ) {    
    $.validator.setDefaults({//what to do when submit is clicked
		submitHandler: function() {
			//alert("submitted!");
            /**windows.open("?p=approval");**/
            //$("#ffg").load("approval.php") 
             
            if($('#preventsubmit').length){//To ensure it doesn't submit twice
                $('#submit').attr( 'disabled', true); 
                alert("This application has already been Submitted");               
             }
             else{
                loadpage(); 
             }
                              
		}
	});

    function loadpage(){
                
        $("#load").css("display", "block");// show loading image        
                
    
        $.ajax({
         url: 'scopus-api/search-for-author.php',
         type: 'POST',
         data: $("#apform").serialize(),  //it will serialize the form data
                dataType: 'html'
            })
            .done(function(data){
             $('#ffg').fadeOut('slow', function(){
                  $('#ffg').fadeIn('slow').html(data);
                  $("#load").css("display", "none");// remove loading image                  
                });
             
            })
            .fail(function(){
         alert('Ajax Submit Failed ...'); 
            });
    };



    $.validator.messages.max = jQuery.validator.format("Your totals mustn't exceed {0}!");

//	$.validator.addMethod("scopus", function(value, element) {
//		return !this.optional(element) && !this.optional($(element).parent().prev().children("text")[0]);
//	}, "Please add a publication");

	$().ready(function() {
	   
       
       
        
        $("#apform").validate({
    			rules: {
    				fname: "required",
    				lname: "required",
    				
    				emailad: {
    					required: true,
    					email: true
    				},
                    phoneno: {
                        required: false,
                        minlength: 11,
                        maxlength: 11
                    },
                    colname: "required",
                    curposition: "required",
                    appposition: "required"
    			},
    			messages: {
    				fname: "Please enter your firstname",
    				lname: "Please enter your lastname",
    				
    				phoneno: {
    					minlength: "Your number should be 11 digits",
                        maxlength: "Your number should be 11 digits",
    					integer: "Please enter a valid nuber"
    				},
    				emailad: "Please enter a valid email address",
                    colname: "Please select your department",
                    curposition: "Please select your current position",
                    appposition: "Please select the position  you are applying for"
    				
    			}
    		});
       
       
	//	$("#apform").validate({
//			errorPlacement: function(error, element) {
//				error.appendTo(element.parent().next());
//			},
//			highlight: function(element, errorClass) {
//				$(element).addClass(errorClass).parent().prev().children("text").addClass(errorClass);
//			}
//		});

		var template = jQuery.validator.format($.trim($("#template").val()));
        
        var i = 1;
        var j = 0;
                
		function addRow() {// Function for adding new Publication Rows
            if (i>25){
                
                alert("Maximum number of publications is 25")
            }
            else{
			$(template(i++)).appendTo("#tbapform .scopadd");
            //console.log(template(i));
             j = i-1;
             }
		};
        
        function removeRow() {//Function to remove Publication rows
            if (j<1){
                alert("There is no Publication to remove")
            }
            else{
                
              $("#tbr"+j).remove();
              $("#tbr"+j+"h").remove();
              
              i = j;
              j--;
              //console.log("tbr"+j);
            }
            
        };
        
        
        
        
        

		
		// start with one row
		//addRow();
        
        
		// add more rows on click
		$("#addpub").click(addRow);
        
        // remove rows on click
        $("#removepub").click(removeRow);

        
        // To ensure no two eid fields are the same
        // Also to check Scopus for existence
        
        
         $(document).on( 'change', ".scopus", function () {
            
            
            var thisname = this.id;
            
            thisname = thisname.trim();
            var thisnamelen = thisname.length;
           
            
            var curincre = thisname.substr(6,thisnamelen);
            
            var fname = $("#fname").val().trim();
            var lname = $("#lname").val().trim();                        
            var pubeid = $("#pubeid"+curincre).val().trim();
            
            var dataString = 'pubeid='+ pubeid+'&curincre='+ curincre+'&fname='+ fname+'&lname='+ lname;
            
            var counter = true ;
            
            var size = $('.scopus').length;
            for(i = 1;i<=size;i++){
                
               var curr = $('#pubeid'+i).val().trim();
               curr = curr.toLocaleLowerCase().replace("/\s/g","");
               for(j = 1;j<=size;j++){
                    if(i != j){
                        var compare = $('#pubeid'+j).val().trim();
                        compare = compare.toLocaleLowerCase().replace("/\s/g","");
                        if(curr!=""||compare!=""){
                            if(curr === compare){
                                //console.log(curr);
                                //console.log(compare);
                                
                                counter = false;
                            }
                            
                        }
                    }
                
               }
                
            }
            
            if(counter ===false){
                alert("No two publications can be the same")
                $('#submit').attr( 'disabled', true);
            }
            else{
                
                                
                
                $("#load"+curincre).css("display", "block");// show loading image
               
                $('#submit').attr( 'disabled', false);
                // Check for existence
                $("#tbr"+curincre+"h").show();
                $.ajax({
                 url: 'scopus-api/get-publication-data.php',
                 type: 'POST',
                 data: dataString,  //it sends the specific data
                        dataType: 'html'
                    })
                    .done(function(data){
                     $("#load"+curincre).css("display", "none");//remove loading image
                     $('#scpscr'+curincre+'').fadeOut('slow', function(){
                          $('#scpscr'+curincre+'').fadeIn('slow').html(data);
                        });
                    })
                    .fail(function(){
                 alert('Ajax Submit Failed ...'); 
                    });
                
            }
            
 
            
            
        });
        //When each check button is clicked
                  
//         $(document).on( 'click', ".chkscop", function () { 
//           
//            
//            var thisname = this.id;
//            
//            thisname = thisname.trim();
//            thisnamelen = thisname.length;
//            
//            //console.log(thisnamelen);
//            
//            var curincre = thisname.substr(9,thisnamelen);
//            
//            var pubeid = $("#pubeid"+curincre+"").val();
//            
//            var dataString = 'pubeid='+ pubeid+'&curincre='+ curincre;
//            
//            //console.log(curincre);
//            
//            
//            $("#tbr"+curincre+"h").show();
//            $.ajax({
//             url: 'scopus-api/get-publication-data.php',
//             type: 'POST',
//             data: dataString,  //it sends the specific data
//                    dataType: 'html'
//                })
//                .done(function(data){
//                 $('#scpscr'+curincre+'').fadeOut('slow', function(){
//                      $('#scpscr'+curincre+'').fadeIn('slow').html(data);
//                    });
//                })
//                .fail(function(){
//             alert('Ajax Submit Failed ...'); 
//                });
//         
//          });
          
       

//	// check keyup on quantity inputs to update totals field
//		$("#apform").validateDelegate("input.quantity", "keyup", function(event) {
//			var totals = 0;
//			$("#tbapform input.quantity").each(function() {
//				totals += +this.value;
//			});
//			$("#pubs").attr("value", totals).valid();
//		});

	
    
     });   
 });
  