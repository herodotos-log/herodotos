<?php
/**
* HERODOTOS - 1.0.0 - a7c083b337fec7683509299d7edb8d2a
* ]-----------------------------------------------------------------------------[
* | Copyright (C) 2020 HERODOTOS                                                |
* |                                                                             |
* | This program is free software; you can redistribute it and/or               |
* | modify it under the terms of the GNU Affero General Public License          |
* | as published by the Free Software Foundation; either version 2              |
* | of the License, or (at your option) any later version.                      |
* |                                                                             |
* | This program is distributed in the hope that it will be useful,             |
* | but WITHOUT ANY WARRANTY; without even the implied warranty of              |
* | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               |
* | GNU Affero General Public License for more details.                         |
* |                                                                             |
* | You should have received a copy of the GNU Affero General Public License    |
* | along with this program.  If not, see https://www.gnu.org/licenses.         |
* ]-----------------------------------------------------------------------------[
* | HERODOTOS: Easier Reading Logs                                              |
* ]-----------------------------------------------------------------------------[
* | This code is designed, written, and maintained by dpkg.ch. See              |
* | about.php and/or the CREDITS file for specific developer information.       |
* ]-----------------------------------------------------------------------------[
* | https://dpkg.ch                                                             |
* ]-----------------------------------------------------------------------------[
*/
//=============================================================================
// REQUIREMENTS
//=============================================================================
//
require_once("config/core.php");
require_once(PATH['lib'] . "functions.php");
//=============================================================================

// Logs for sidebar
$logs = db_fetch_assoc("SELECT log_id, log_name, log_filename FROM herodotos_log");

?>
<!DOCTYPE html>
<!-- Begin html -->
<html>

    <!-- Begin head -->
    <head>
        <?php require_once(PATH['templates'] . "head.php"); ?>
    </head>
    <!-- End head -->
    
    <!-- Begin body -->
    <body id="page-top" class="bg-gradient-success">
        
        <!-- Begin wrapper -->
        <div id="wrapper">
        
            <!-- Begin sidebar -->
            <?php require_once(PATH['templates'] . "sidebar.php"); ?>
            <!-- End sidebar -->
            
            <!-- Begin content-wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                
                <!-- Begin content -->
                <div id="content">
                    
                    <!-- Begin topbar -->
                    <?php require_once(PATH['templates'] . "topbar.php"); ?>
                    <!-- End topbar -->
                    
                    <!-- Begin main -->
                    <div id="main" class="container-fluid">
                        
                        <?php
                        var_dump(tail_file(1));
                        /*    foreach(tail_file(1) as $value)
                            {
                                echo $value;
                                echo "<br>";
                            }
                        */
                        ?>
                        
                    </div>
                    <!-- End main -->
                    
                </div>
                <!-- End content -->
                
                <!-- Begin footer -->
                <?php require_once(PATH['templates'] . "footer.php"); ?>
                <!-- End footer -->
            </div>
            <!-- End content-wrapper -->
        </div>
        <!-- End wrapper -->
        
        <!-- Begin scroll-to-top -->
        <!-- End scroll-to-top -->
        
        <!-- Begin bottom -->
        <?php require_once(PATH['templates'] . "bottom.php"); ?>
        <!-- End bottom -->
        
    </body>
    <!-- End body -->

</html>
<!-- End html -->