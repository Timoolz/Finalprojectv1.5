
<?php
/*

scopus-api-scripts
http://www.github.com/braunsg/scopus-api-scripts

Copyright (c) 2015 Steven Braun
Created: 2015-06-08
Last updated: 2015-07-14

This script pulls data for publications based on known Scopus publication eIDs
using the Scopus search API


API base: http://api.elsevier.com/content/search/scopus
Script current as of API 2015-06-02 release
API documentation: http://api.elsevier.com/documentation/SCOPUSSearchAPI.wadl

This script is shared under an MIT License, which grants free use, modification, 
and distribution for all users. See LICENSE.md for more details.

//////////////////////////////////////////////////////////////////////////////////////////
///// NOTE

This script is adapted from scripts used to pull data for Manifold, the research impact 
analytics system developed by Steven Braun for the University of Minnesota Medical School

FOR MORE INFO, see

manifold-impact-analytics
http://www.github.com/braunsg/manifold-impact-analytics

////////////////////////////////////////////////////////////////////////////////////////*/
//Check if there is internet connection
include_once('../functions/generalfunctions01.php');

if( !int_connection()){
    echo"<label class ='my-error'>No Internet Connection\t\t\t  </label>";
    die();

}

$firstName = $_POST['fname'];
$lastName  = $_POST['lname'];

//Get details of call
$scoptitle   = $_POST['pubeid'];
$curincre    = $_POST['curincre'];
 


$myapikey = '27b57a8b189fc2b9ce579db63eecebbd';

//$publicationeid = '2-s2.0-'. $scopeid .'';
$publicationtitle =  $scoptitle ;
//$eidArray = array('2-s2.0-48049098734');

// Define an array of known Scopus publication eIDs to loop through;
// here, I'm using just one, but you can specify multiple


$eidArray = array($publicationtitle);

//$truescore = 3;
//$trueconf  = 1;
//var_dump($eidArray);
//
//                    echo"Publication Conference exists \n";
//                    
//                    echo"<span> Score </span>  <span>  = $truescore</span>  \n";
//                    
//                    
//                    echo"<input type='hidden' name='score".$curincre."' value='$truescore'/>  \n";
//                   // echo"<input type='hidden' name='conf".$curincre."' value='$trueconf'/>  \n";

//print "Obtaining publication data for...\n";
$thisCount = 0;
$continueCt = 0;
$eidCount = count($eidArray);

// Loop through each eID, one by one
foreach($eidArray as $eid) {
	$thisCount++;
					
	//print "eID: " . $eid . " (" . $thisCount . "/" . $eidCount . ")\n";

	// Define some parameters to control how many results are retrieved
	// The Scopus APIs have some limits as to how many results it will retrieve in a single API call;
	// also, it is easier to work with the returned data if the results set is smaller
	$offset = 0;
	$countTotal = 0;

	// Let's pull a maximum of 50 publication results per API call	
	$countIncrement = 5;
	$loopThrough = 1;
	$totalResults = null;
	$pubCtr = 0;
	
	// Let's loop through API calls as long as it keeps returning us results --
	// In this example, we are forming our query based on a known unique eID, and so the API
	// should return only a single result; in other situations, using different query parameters
	// might yield more results, making this looping more relevant	
	while($loopThrough == 1) {

		// Define the query string for the API in a variable. This string can be written in the
		// same way as an advanced search string on the Scopus online database, with some field names changed.
		// Here, I will do a Scopus search for the publication identified by the given eID.
		// NOTE: The query string must be URL-encoded
		$query = urlencode('TITLE-ABS-KEY(' . $eid . ')AND affil(covenant university)');
        //$query = urlencode( $eid ); // Edited by me to check directly for name        
		
		// Define the URL of the API to query. The API is RESTful and also allows other parameters beyond the query,
		// such as limiting which fields to return and the number of results to return, that are defined
		// in the API documentation		
		$url = 'http://api.elsevier.com/content/search/scopus?query=' . $query . '&view=COMPLETE&count=' . $countIncrement . '&start=' . $offset;
        //var_dump($url);
		// Since this script is written in PHP, the API call will be executed via cURL
		$openCurl = curl_init();

		curl_setopt_array($openCurl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_HEADER => 0,
			CURLOPT_URL => $url,
			CURLOPT_HTTPHEADER => array(
					// Specify the API key -- replace with your own once registered					
					'X-ELS-APIKey: '. $myapikey ,
					'Accept: application/json'
				)
		));

		// Store the data returned by the API in a variable $result
		$result = curl_exec($openCurl);
        //var_dump($result);
		$httpCode = curl_getinfo($openCurl, CURLINFO_HTTP_CODE); // Retrieve HTTP Response

		// If the cURL call returns an error...
		if($result === false) {
			echo "<label class ='my-error'>  Curl error: " . curl_error($openCurl)."</label>";

		// If the cURL call is successful, but returns an HTTP error code...
		} else if($httpCode !== 200) {
			print "<label class ='my-error'> HTTP Response Error - Code: " . $httpCode . "</label>\n ";

		// Otherwise, proceed with returned results
		} else {
			// The query response returns data in JSON format, but we need to encode it as such
			// so PHP can know how to read it.
			// You could print out the $json variable to see the returned data in its entirety
			$json = json_decode($result,true);

			// The query response returns a lot of different data in a structured format.
			// Here, we're defining a variable $pubs that holds all of the PUBLICATION data,
			// which is represented in the JSON under search-results -> entry
			$pubs = $json['search-results']['entry'];
			$pubsCount = count($pubs);
			$countTotal += count($pubs);
			
			
			if(is_null($totalResults)) {

				// Grab the total number of results returned from the query
				$totalResults = $json['search-results']['opensearch:totalResults'];

				if($totalResults == 0) {
					print "<label class ='my-error'> \tNo publications recorded with this ID in this University.\n </span>";

					// If the query returns 0 results, then quit looping through this publication eID
					$loopThrough  = 0;
					continue;
				} else {
					//print "\tTotal results: " . $totalResults . "\n";
				}
			}
		
			// Let's walk through each publication result stored in $pubs, one by one,
			// and display the returned data for each;
			// since the example here is performing the search by eID, the query should
			// only return one result
			foreach($pubs as $key => $pubInfo) {
				$pubCtr++;
				//print "\tPublication " . $pubCtr . "/" . $totalResults . "\n";

				// If the publication entry has an error...
				if(isset($pubInfo['error'])) {
					$thisError = $pubInfo['error'];
					if($thisError !== "Result set was empty") {
						print "Error message: " . $thisError . "\n";
					}

				// Otherwise, proceed with publication entry					
				} else {

					// This is where you'd take the JSON data and do what you want with it,
					// such as dump it into a database, do some analyses, echo it out, etc.
					// NOTE: See get-publication-data_mysql.php for an example of this
					
					//print_r($pubInfo);
                    //var_dump($pubInfo);
                    
                    
                    $realauth = false;
                    $mypubtype = '';                    
                    
                    
//                     var_dump($pubInfo['author']);
////                     var_dump($pubInfo['dc:creator']);
////                     var_dump($pubInfo['dc:title']);
////                     var_dump($pubInfo['prism:publicationName']);
////                     var_dump($pubInfo['affiliation']);
////                     var_dump($pubInfo['subtype']);
////                     var_dump($pubInfo['prism:aggregationType']);
////                     
                     foreach($pubInfo['author'] as $author){
                        
                        

                        if(strpos(strtolower($author['given-name']),strtolower($firstName)) !== false && strpos(strtolower($author['surname']),strtolower($lastName)) !== false){
                            $realauth = true;
                        }
                     }
                     
                     if($realauth==false){
                        echo"<label class ='my-error'> This is not your publication</label>";
                     }
                     else{
                        
                        $mypubtype  = $pubInfo['subtype'];
                        $mypubdate  = $pubInfo['prism:coverDate'];
                        $mypubowner = $pubInfo['dc:creator'];
                        
                        
                        switch($mypubtype){
                            
                            case "ar":
                                $truescore   = 3 ; //Score if the publication exists
                                echo"Article exists \n";
                            
                                echo"<span> Score </span>  <span>  = $truescore</span>  \n";
                             
                                echo"<input type='hidden' name='score".$curincre."' value='$truescore'/>  \n";
                                echo"<input type='hidden' name='owner".$curincre."' value='$mypubowner'/>  \n";
                                echo"<input type='hidden' name='date".$curincre."' value='$mypubdate'/>  \n";
                                
                                
                                
                                break;
                             
                             case "re":
                                $truescore   = 3 ; //Score if the publication exists
                                echo"Review exists \n";
                            
                                echo"<span> Score </span>  <span>  = $truescore</span>  \n";
                             
                                echo"<input type='hidden' name='score".$curincre."' value='$truescore'/>  \n";
                                echo"<input type='hidden' name='owner".$curincre."' value='$mypubowner'/>  \n";
                                echo"<input type='hidden' name='date".$curincre."' value='$mypubdate'/>  \n";
                                
                                
                                
                                break;
                            
                            case "cp":
                                $truescore   = 1 ; //Score if the publication exists
                                echo"Conference paper exists \n";
                            
                                echo"<span> Score </span>  <span>  = $truescore</span>  \n";
                             
                                echo"<input type='hidden' name='score".$curincre."' value='$truescore'/>  \n";
                                echo"<input type='hidden' name='conf".$curincre."' value='$truescore'/>  \n";// For conference only
                                echo"<input type='hidden' name='owner".$curincre."' value='$mypubowner'/>  \n";
                                echo"<input type='hidden' name='date".$curincre."' value='$mypubdate'/>  \n";
                                
                                break;
                            
                            
                            
                            default:
                                print "<label class ='my-error'> \tUnrecognised Publication type.\n </span>";
                            
                            
                        }
                        
                     }
                     
                    
                    

					
				} // End if($pubInfo['error']) structure

			} // End foreach($pubs) structure

		} // End if($result === false) structure

		// Check to see if we need to keep looping through this particular publication search
		// and retrieve additional records
		if($totalResults - $countTotal > 0) {
			$offset += $countIncrement;
		} else {
			$loopThrough = 0;
		}

	} // End LOOPTHROUGH control structure
	
	// Close the cURL connection	
	curl_close($openCurl);
}

?>