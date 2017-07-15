<?php

    include("classes/generalclasses01.php");
    include("functions/generalfunctions01.php");    

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Appointments and Promotions </title>
    <!-- JQuery -->
    <script src="jscripts/jquery/jquery.js"></script>
    
    <!-- Bootstrap Core CSS -->
    <link href="cstylesheets/bootstrap/css/bootstrap.css" rel="stylesheet"/>
    
    <!-- Chosen scripts -->
    <link href="cstylesheets/chosen/chosen.css" rel="stylesheet"/>
    <script src="jscripts/chosen/chosen.jquery.js"></script>
    <script src="jscripts/chosen/init.js"></script>
    
    <!-- Form Validation scripts -->
    <script src="jscripts/jquery-validation/lib/jquery.js"></script>
    <script src="jscripts/jquery-validation/dist/jquery.validate.js"></script>
    
    
    <!-- Custom CSS -->
    <link href="cstylesheets/main.css" rel="stylesheet"/>

  
</head>

<body>

    <div class="wrapper">
    
        <!-- Sidebar -->
        <div class="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand <?php 
                if (isset($_REQUEST['p'])){
                    if ($_REQUEST['p']=='appointment'){
                    
                    echo" active";
                    }
                    }?>
                ">
                    <a href="?p=appointment">
                        Appointment &amp; Promotions 
                    </a>
                </li>
                <li class="sidebar-brand <?php 
                if (isset($_REQUEST['p'])){
                    if ($_REQUEST['p']=='applications'){
                    
                    echo" active";
                    }
                    }?>
                ">
                    <a href="?p=applications">
                        Applications
                    </a>
                </li>
               <!-- <li class="sidebar-brand  <?php 
                if (isset($_REQUEST['p'])){
                    if ($_REQUEST['p']=='promotion'){
                    
                    echo" active";
                    }
                    }?>
                ">
                    <a href="?p=promotion">Promotion</a>
                </li>-->
                
            </ul>
        </div>
        <!-- /.sidebar-wrapper -->
        
         <!-- Page Content -->
        <div class="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">


                            <?php
                            
                            /**
                             * @author Laleye Olamide
                             * 
                             * @copyright 2017
                             */
                            
                            
                             //var_dump($_REQUEST);
                             $mapping = array(
                                       'appointment'      => 'appointment',
                                       'applications'         => 'applications',
                                       'promotion'        => 'promotion',
                                       
                                       #....
                                    );
                                    
                             $page = isset($_REQUEST['p']) ? $_REQUEST['p'] : 'home';
                             $file = isset($mapping[$page]) ? $mapping[$page] : 'home';
                         
                             include($file.'.php');
                             
                            
                            
                            ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.page-content-wrapper -->
        
    </div>
    <!-- /.wrapper -->
    




    <!-- Bootstrap Core JavaScript -->
    <!--<script src="jscripts/bootstrap/bootstrap.min.js"></script>-->

    <!-- Menu Toggle Script -->
    <!--<script>
    $(".menu-toggle").click(function(e) {
        e.preventDefault();
        $(".wrapper").toggleClass("toggled");
    });
    </script>-->

</body>

</html>