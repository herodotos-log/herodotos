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
// INCLUDING
//=============================================================================
//
include_once("../config/core.php");
if(CONFIG['installation'] === true) include_once("./lang.php");

//=============================================================================
// REQUIREMENTS
//=============================================================================
//
function install_requirements() {
    $data = array(
        'title'     => _('Installation – Requirements'),
        'progress'  => 0,
        'fatal'     => false
    );
    
    // OS REQUIREMENT != "Win"
    $os_error = (strtoupper(substr(php_uname('s'), 0, 3)) === 'WIN')
        ? array(
        'status'    => 'error_fatal',
        'msg'       => _('OS is ' . php_uname('s') . ' – the package does not support Windows!')
        )
    
        : array(
        'status'    => 'ok',
        'msg'       => _(php_uname('s') . " – OK!")
        );
    
    // PHP REQUIREMENT < v5
    $php_error = (phpversion() < 5.5) 
        ? array(
        'status'    => 'error_fatal',
        'msg'       => _("PHP version is " . phpversion() . " – the PHP version must be at least 5.5!")
        )
        
        : array(
        'status'    => 'ok',
        'msg'       => _(phpversion() . " – OK!")
        );
    
    // SESSION REQUIREMENTS
    $_SESSION['loggme_session_install'] = 1;
    $session_error = (empty($_SESSION['loggme_session_install']))
        ? array(
        'status'    => 'error_fatal',
        'msg'       => _("PHP sessions must be enabled!")
        )
        
        : array(
        'status'    => 'ok',
        'msg'       => _("PHP sessions is enabled!")
        );
    
    // GETTEXT REQUIREMENTS
    $gettext_error = (!function_exists("gettext"))
        ? array(
        'status'    => 'error_fatal',
        'msg'       => _('Gettext must be supported!')
        )
        
        : array(
        'status'    => 'ok',
        'msg'       => _('Gettext is supported!')
        );
    
    // MySQL REQUIREMENT
    $output = shell_exec('mysql -V');
    preg_match('@[0-9]+\.[0-9]+\.[0-9]+@', $output, $version); 
    $mysqlVersion = @$version[0] ? $version[0] : -1;
    
    if($mysqlVersion < 5)
    {
        $mysql_error = ($mysqlVersion !== -1)
            ? array(
            'status'    => 'error_fatal',
            'msg'       => _("MySQL version is $mysqlVersion. Version 5 or newer is required!")
            )
            
            : array(
            'status'    => 'error',
            'msg'       => _("MySQL version will be check at the next step!")
            );
    }
    else $mysql_error = array(
    'status'    => 'ok',
    'msg'       => _("$mysqlVersion – OK!")
    );
    
    $data['data'] = array(
    _('Operating System')   => $os_error,
    _('PHP version')        => $php_error,
    _('PHP Session')        => $session_error,
    _('PHP Gettext')        => $gettext_error,
    _('MySQL version')      => $mysql_error
    );
    
    foreach($data['data'] as $key => $value)
    {
        if($value['status'] === 'error_fatal')
        {
            $data['fatal'] = true;
            break;
        }
    }
    
    return $data;
}

//=============================================================================
// MySQL
//=============================================================================
//
function install_mysql()
{
    $data = array(
        'title'     => 'Installation – MySQL',
        'progress'  => 25,
        'fatal'     => false
    );
    
    return $data;
}

//=============================================================================
// HTML CONTENT
//=============================================================================
//
?>
<!DOCTYPE HTML>
<!-- Begin HTML -->
<html>
    <!-- Begin head -->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="../include/images/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../include/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../include/images/favicon/favicon-16x16.png">
        <link rel="manifest" href="../include/images/favicon/site.webmanifest">
        <link rel="mask-icon" href="../include/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="shortcut icon" href="../include/images/favicon/favicon.ico">
        <meta name="msapplication-TileColor" content="#00a300">
        <meta name="msapplication-config" content="../include/images/favicon/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
        
        <!-- Custom fonts for this template-->
        <link href="../include/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="../include/css/dashboard.css" rel="stylesheet">

        <!-- jQuery -->
        <link href="../include/vendor/jquery/jquery.js" rel="stylesheet">
        
        <!-- Custom style -->
        <style>
            /*card-install*/
            #card-install {
                z-index: 1;
            }
            
            /*fieldsets*/
            #installForm fieldset{
                background: white;
                border: 0 none;
                border-radius: 0px;
                box-sizing: border-box;
                width: 100%;
                /*stacking fieldsets above each other*/
                position: relative;
            }
            
            /*Hide all except first fieldset*/
            #installForm fieldset:not(:first-of-type) {
                display: none;
            }
            
            /*progressbar*/
            #progressbar {
                padding-inline-start: 0;
                margin-bottom: 30px;
                overflow: hidden;
                /*CSS counters to number the steps*/
                counter-reset: step;
                text-align: center;
            }

            #progressbar li {
                list-style-type: none;
                text-transform: uppercase;
                font-size: 9px;
                width: 25%;
                float: left;
                position: relative;
                letter-spacing: 1px;
                color: black;
            }

            #progressbar li:before {
                content: counter(step);
                counter-increment: step;
                width: 24px;
                height: 24px;
                line-height: 26px;
                display: block;
                font-size: 12px;
                color: #FFF;
                background: #1cc88a;
                border-radius: 25px;
                margin: 0 auto 10px auto;
            }

            /*progressbar connectors*/
            #progressbar li:after {
                content: '';
                width: 100%;
                height: 4px;
                background: #1cc88a;
                position: absolute;
                left: -50%;
                top: 9px;
                z-index: -1; /*put it behind the numbers*/
            }

            #progressbar li:first-child:after {
                /*connector not needed before the first step*/
                content: none;
            }

            /*marking active/completed steps green*/
            /*The number of the step and the connector before it = green*/
            #progressbar li.active:before, #progressbar li.active:after {
                background: #006400;
                color: white;
            }
        </style>
    </head>
    <!-- End head -->
    
    <!-- Begin body -->
    <body id="install" class="bg-gradient-success">

        <div class="container">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div id="card-install" class="card-body p-0">
                <!-- Nested Row within Card Body -->
                            <div class="p-5">
                                
                                <?php
                                if(CONFIG['installation'] === false)
                                {
                                    print 
                                    '
                                    <div class="text-center alert alert-danger" role="alert">
                                        <h4 class="alert-heading"><strong>Installation disabled</strong></h4>
                                        <p>
                                            Installation is disabled at <strong>line n°40</strong> in <strong>/config/core.php</strong>!
                                            <br>
                                            You must activate it by replacing the value \'false\' by \'true\'.
                                        </p>
                                        <hr>
                                        <p class="mb-0">Need some help? Check out the complete guide <a class="alert-link" target="_blank" href="https://github.com/huglijonas/herodotos">on github</a>!</p>
                                    </div>
                            </div>
                </div>
            </div>
        </div>
    </body>
</html>
                                    ';
die();
                                }
                                ?>
                                
                                    <!-- Begin form -->
                                    <form class="user was-validated" id="installForm" method="POST" action="install.php" novalidate>
                                                
                                        <!-- Begin progress bar -->
                                        <ul id="progressbar">
                                            <li class="active"><?php echo _("Requirements") ?></li>
                                            <li><?php echo _("General") ?></li>
                                            <li>MySQL</li>
                                            <li>Credentials</li>
                                        </ul>
                                        <!-- End progress bar -->
                                                
                                        <!-- Begin Requirements -->
                                        <fieldset class="text-center">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900"><?php echo _("Install – Requirements") ?></h1>
                                                <p class="text-gray-900 mb-4"><?php echo _("General requirements"); ?></p>
                                            </div>
                                            
                                            <?php
                                                $requirements = install_requirements();
                                                foreach($requirements['data'] as $keyInit => $valueInit)
                                                {
                                                    print 
                                                    '
                                                    <div class="card shadow mb-4 ' . (($valueInit["status"] === "ok") ? "border-left-success border-bottom-success" : "border-left-danger border-bottom-danger") . '">
                                                        <div class="form-group row font-weight-bold text-gray-800">
                                                            <div class="text-center card-body col-sm-6 mb-3 mb-sm-0">'
                                                                . $keyInit .
                                                            '</div>
                                                            <div style="color:"' . (($valueInit["status"] === "ok") ? "green" : "red") . ';" class="text-center card-body col-sm-6 mb-3 mb-sm-0">'
                                                                . $valueInit["msg"] .
                                                            '</div>
                                                        </div>
                                                    </div>
                                                    ';
                                                }
                                                if($requirements['fatal'] === true)
                                                {
                                                    print
                                                    '
                                                    <button onclick="location.reload()" type="button" class="btn-icon-split btn btn-danger btn-user">
                                                        <span class="icon text-white-500">
                                                            <i class="fas fa-redo-alt"></i>
                                                        </span>
                                                        <span class="text">' . _("Reload") . '</span>
                                                    </button>
                                                    ';
                                                }
                                                print 
                                                '
                                                <button type="button" class="btn-icon-split btn btn-primary btn-user nextBtn" ' . (($requirements["fatal"] === true) ? "disabled" : "") . '>
                                                    <span class="text">' . _("Next") . '</span>
                                                    <span class="icon text-white-500">
                                                        <i class="fas fa-arrow-right"></i>
                                                    </span>
                                                </button>
                                                ';
                                            ?>

                                        </fieldset>
                                        <!-- End Requirements -->
                                        <!-- Begin General -->
                                        <fieldset class="text-center">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4"><?php echo _("Install – General"); ?></h1>
                                                <p class="text-gray-900 mb-4"><?php echo _("All basic informations"); ?></p>
                                            </div>
                                            <div class="form-group row" style="text-align:left;">
                                                <div class="col-sm-4 mb-3 mb-sm-0">
                                                    <label for="general_url"><?php echo _("Website URL (required)"); ?></label>
                                                    <input type="text" id="general_url" name="general_url" class="form-control form-control-user" value="<?php echo "http://$_SERVER[HTTP_HOST]" ?>" required pattern="(https?|ftp):\/\/(-\.)?([^\s\/?\.#-]+\.?)+(\/[^\s]*)?$" placeholder="https://herodotos.net/">
                                                    <div class="invalid-feedback"><?php echo _("Enter a valid URL"); ?></div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="general_webname"><?php echo _("Website Name (required)"); ?></label>
                                                    <input type="text" id="general_webname" name="general_webname" class="form-control form-control-user" required pattern="^[A-Za-z ,.'-]{4,32}$" placeholder="Herodotos" value="Herodotos">
                                                    <div class="invalid-feedback"><?php echo _("Only ASCII (max.: 32)"); ?></div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="general_desc"><?php echo _("Website Description (not required)"); ?></label>
                                                    <input type="text" id="general_desc" name="general_desc" class="form-control form-control-user" placeholder="Easier Reading Logs" pattern="[A-Za-zÀ-ÖØ-öø-ÿ0-9.,?! -]{0,128}">
                                                    <div class="invalid-feedback"><?php echo _("Alphanumericals and accented characters (max.: 128)"); ?></div>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="text-align:left;">
                                                <div class="col-sm-4">
                                                    <label for="general_author"><?php echo _("Author (required)"); ?></label>
                                                    <input type="text" id="general_author" name="general_author" class="form-control form-control-user" pattern="[A-Za-zÀ-ÖØ-öø-ÿ-. ]{2,32}" required placeholder="Jonas H.">
                                                    <div class="invalid-feedback"><?php echo _("Alphanumericals and accented characters (max.: 32)"); ?></div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="general_lang"><?php echo _("Language (required)"); ?></label>
                                                    <select id="general_lang" name="general_lang" class="form-control form-control-user" required>
                                                        <option value="">Choose a language</option>
                                                        <option <?php echo (($lang == 'en') ? 'selected' : ''); ?> value="en">English</option>
                                                        <option <?php echo (($lang == 'fr_FR') ? 'selected' : ''); ?> value="fr">Français</option>
                                                        <option <?php echo (($lang == 'de_DE') ? 'selected' : ''); ?>value="de">Deutsch</option>
                                                        <option <?php echo (($lang == 'it_IT') ? 'selected' : ''); ?>value="it">Italiano</option>
                                                    </select>
                                                    <div class="invalid-feedback"><?php echo _("You must choose a language!"); ?></div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="general_title"><?php echo _("Default Webpage Title (required)"); ?></label>
                                                    <input type="text" id="general_title" name="general_title" class="form-control form-control-user" pattern="[A-Za-zÀ-ÖØ-öø-ÿ- |]{2,16}" required placeholder="Herodotos | " value="Herodotos | ">
                                                    <div class="invalid-feedback"><?php echo _("Alphanumericals and accented characters (max.: 16)"); ?></div>
                                                </div>
                                            </div>
                                            
                                            <button type="button" class="btn-icon-split btn btn-primary btn-user previousBtn">
                                                <span class="icon text-white-500">
                                                    <i class="fas fa-arrow-left"></i>
                                                </span>
                                                <span class="text"><?php echo _("Previous"); ?></span>
                                            </button>
                                            <button type="button" class="btn-icon-split btn btn-primary btn-user nextBtn">
                                                <span class="text"><?php echo _("Next"); ?></span>
                                                <span class="icon text-white-500">
                                                    <i class="fas fa-arrow-right"></i>
                                                </span>
                                            </button>
                                        </fieldset>
                                        <!-- End General -->
                                        <!-- Begin MySQL -->
                                        <fieldset class="text-center">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4"><?php echo _("Install – MySQL"); ?></h1>
                                                <p class="text-gray-900 mb-4"><?php echo _("MySQL informations"); ?></p>
                                            </div>
                                            
                                            <div class="form-group row" style="text-align:left;">
                                                <div class="col-sm-4 mb-3 mb-sm-0">
                                                    <label for="db_addr"><?php echo _("Server address"); ?></label>
                                                    <input type="text" id="db_addr" name="db_addr" class="form-control form-control-user" placeholder="127.0.0.1" required pattern="^((([a-zA-Z]|[a-zA-Z][a-zA-Z0-9-]*[a-zA-Z0-9]).)*([A-Za-z]|[A-Za-z][A-Za-z0-9-]*[A-Za-z0-9])|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))$">
                                                    <div class="invalid-feedback"><?php echo _("Enter a valid IPv4 or hostname"); ?></div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="db_user"><?php echo _("Username"); ?></label>
                                                    <input type="text" id="db_user" name="db_user" class="form-control form-control-user" placeholder="root" required pattern="[\x00-\x7F]{1,32}">
                                                    <div class="invalid-feedback"><?php echo _("Only ASCII (max.: 32)"); ?></div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="db_pass"><?php echo _("Password"); ?></label>
                                                    <input type="text" id="db_pass" name="db_pass" class="form-control form-control-user" placeholder="root" required pattern="[\x00-\x7F]{4,}">
                                                    <div class="invalid-feedback"><?php echo _("Only ASCII (min.: 4)"); ?></div>
                                                </div>
                                            </div>
                                            <div class="form-group row" style="text-align:left;">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="db_port"><?php echo _("Port"); ?></label>
                                                    <input type="number" id="db_port" name="db_port" class="form-control form-control-user" placeholder="3306" required>
                                                    <div class="invalid-feedback"><?php echo _("Only integers (default: 3306)"); ?></div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="db_name"><?php echo _("Database's name (required)"); ?></label>
                                                    <input type="text" id="db_name" name="db_name" class="form-control form-control-user" placeholder="herodotos" value="herodotos" pattern="[A-Za-z-]{2,16}" required>
                                                    <div class="invalid-feedback"><?php echo _("Only latin characters (max.: 16)"); ?></div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" id="verifyMySQL" name="verifyMySQL" class="btn-icon-split btn btn-primary btn-user">
                                                    <span class="icon text-white-500">
                                                        <i id="iconMySQLVerify" class="fa fa-cog"></i>
                                                    </span>
                                                    <span class="text" id="textMySQLVerify">
                                                        <?php echo _("Try connection"); ?>
                                                    </span>
                                                </button>
                                            </div>
                                            <input type="hidden" id="secure" id="secure" value="bd1647ad4a665ec432b70205c4c57d9c7dc87a5a8193dbfe6a507b6b1e584af1ca796a15ab97c9465aa83fcdc4960d5a11855f062713bab4910032c9aa23e6cb">
                                            <br>
                                            <button type="button" class="btn-icon-split btn btn-primary btn-user previousBtn">
                                                <span class="icon text-white-500">
                                                    <i class="fas fa-arrow-left"></i>
                                                </span>
                                                <span class="text"><?php echo _("Previous"); ?></span>
                                            </button>
                                            <button type="button" class="btn-icon-split btn btn-primary btn-user nextBtn" disabled>
                                                <span class="text"><?php echo _("Next"); ?></span>
                                                <span class="icon text-white-500">
                                                    <i class="fas fa-arrow-right"></i>
                                                </span>
                                            </button>
                                        </fieldset>
                                        <!-- End MySQL -->
                                        <!-- Begin Credentials -->
                                        <fieldset class="text-center">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4"><?php echo _("Install – Credentials"); ?></h1>
                                                <p class="text-gray-900 mb-4"><?php echo _("Credential informations"); ?></p>
                                            </div>
                                            
                                            <div class="form-group row" style="text-align:left;">
                                                <div class="col-sm-6 mb-4">
                                                    <label for="cred_user"><?php echo _("Username (required)"); ?></label>
                                                    <input type="text" id="cred_user" name="cred_user" class="form-control form-control-user" pattern="^([a-zA-Z0-9]{2,16})$" placeholder="admin" required>
                                                    <div class="invalid-feedback"><?php echo _("Only alphanumericals (max.: 16)"); ?></div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="cred_pass"><?php echo _("Password (required)"); ?></label>
                                                    <input type="text" id="cred_pass" name="cred_pass" class="form-control form-control-user" pattern="[\x00-\x7F]{8,128}" required>
                                                    <div class="invalid-feedback"><?php echo _("Only ASCII (min.: 8 | max.: 128)"); ?></div>
                                                </div>
                                            </div>
                                            <button type="button" class="btn-icon-split btn btn-primary btn-user previousBtn">
                                                <span class="icon text-white-500">
                                                    <i class="fas fa-arrow-left"></i>
                                                </span>
                                                <span class="text"><?php echo _("Previous"); ?></span>
                                            </button>
                                            <button type="button" id="submitForm" class="btn-icon-split btn btn-success btn-user">
                                                <span class="text" id="submitBtnText"><?php echo _("Submit"); ?></span>
                                                <span class="icon text-white-500">
                                                    <i class="fas fa-reply fa-flip-vertical"></i>
                                                </span>
                                            </button>
                                        </fieldset>
                                        <!-- End Credentials -->
                                                
                                    </form>
                                    <!-- End form -->
                                
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="https://github.com/huglijonas/loggme" target="_blank"><i class="fab fa-github"></i> <?php echo _("Need help? Follow the instructions!"); ?></a>
                                </div>
                            </div>
                </div>
            </div>
        </div>
        
        <!-- Modal End Installation -->
        <div class="modal fade bg-gradient-success" id="installModal" tabindex="-1" role="dialog" aria-labelledby="installModalTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="text-align:center;" id="installModalTitle">Installation is completed!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <strong>You will be redirected in a few seconds</strong>
                    </div>
                </div>
            </div>
        </div>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Bootstrap core JavaScript-->
        <script src="../include/vendor/jquery/jquery.min.js"></script>
        <!-- Local script -->
        <script src="../include/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="../include/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../include/js/dashboard.min.js"></script>
        
        <script type="text/javascript">
            var currentFS, nextFS, previousFS;
            var left, opacity, scale;
            var flag;
            
            $(function() {
                $(".previousBtn").click(function(){
                    if(flag) return false;
                    flag = true;

                    currentFS = $(this).parent();
                    previousFS = $(this).parent().prev();

                    $("#progressbar li").eq($("fieldset").index(currentFS)).removeClass("active");
                    currentFS.hide();
                    previousFS.show();
                    currentFS.css({'position': 'absolute'});
                    
                    currentFS.animate({opacity: 0}, {
                        step: function(now, mx) {
                            scale = 0.8 + (1 - now) * 0.2;
                            opacity = 1 - now;
                            previousFS.css({'transform': 'scale('+scale+')', 'opacity': opacity});
                        }, 
                        duration: 800, 
                        complete: function(){
                            currentFS.hide();
                            currentFS.css({'position': 'relative'});
                            flag = false;
                        }
                    });
                });
                                                                         
                $(".nextBtn").click(function(){
                    if(flag) return false;
                    flag = true;
	
                    currentFS = $(this).parent();
                    nextFS = $(this).parent().next();
	
                    $("#progressbar li").eq($("fieldset").index(nextFS)).addClass("active");
                    currentFS.hide();
                    nextFS.show(); 
                    currentFS.css({'position': 'absolute'});
                    
                    currentFS.animate({opacity: 0}, {
                        step: function(now, mx) {
                            scale = 0.8 + (1 - now) * 0.2;
                            opacity = 1 - now;
                            nextFS.css({'transform': 'scale('+scale+')', 'opacity': opacity});
                        }, 
                        duration: 800, 
                        complete: function(){
                            currentFS.hide();
                            currentFS.css({'position': 'relative'});
                            flag = false;
                        }
                    });
                });
                
                $("#submitForm").click(function(){
                    var general_url     =   $("#general_url").val(),
                        general_webname =   $("#general_webname").val(),
                        general_desc    =   $("#general_desc").val(),
                        general_author  =   $("#general_author").val(),
                        general_lang    =   $("#general_lang").val(),
                        general_title   =   $("#general_title").val();
                    
                    var db_addr         =   $("#db_addr").val(),
                        db_user         =   $("#db_user").val(),
                        db_pass         =   $("#db_pass").val(),
                        db_port         =   $("#db_port").val(),
                        db_name         =   $("#db_name").val(),
                        secure          =   $("#secure").val();
                    
                    var cred_user       =   $("#cred_user").val(),
                        cred_pass       =   $("#cred_pass").val();
                    
                    var empty = false;
                    var inputs = $("#installForm input");
                    for(var i = 0; i < inputs.length; i++)
                    {
                        if(inputs[i]['name'] != "general_desc")
                        {
                            if(inputs[i]["value"].length == 0)
                            {
                                empty = true;
                                break;
                            }
                        }
                    }
                    if(empty == false)
                    {
                        $.ajax({
                            type:   "POST",
                            url:    "install.php",
                            data:   {
                                "action":           "install",
                                "general_url":      general_url,
                                "general_webname":  general_webname,
                                "general_desc":     general_desc,
                                "general_author":   general_author,
                                "general_lang":     general_lang,
                                "general_title":    general_title,
                                "db_addr":          db_addr,
                                "db_user":          db_user,
                                "db_pass":          db_pass,
                                "db_port":          db_port,
                                "db_name":          db_name,
                                "cred_user":        cred_user,
                                "cred_pass":        cred_pass,
                                "secure":           secure
                            },
                            success:    function(data) {
                                var json = JSON.parse(data);

                                if(json["status"] == "true" && json["msg"] == "ok")
                                {
                                    $('#installModal').modal('toggle');
                                    $('#installModal').modal('show');
                                    window.setTimeout(function(){
                                        document.location = "../index.php";
                                    }, 5000);
                                }
                                else if(json["status"] == "false")
                                {
                                    $("#submitForm").removeClass();
                                    $("#submitForm").addClass("btn-icon-split btn btn-danger btn-user");
                                    $("#submitBtnText").html(json['msg']);
                                }
                            }
                        });
                    }
                    else
                    {
                        $("#submitForm").removeClass();
                        $("#submitForm").addClass("btn-icon-split btn btn-danger btn-user");
                        $("#submitBtnText").html("<?php echo _("Submit – Empty field(s)"); ?>");
                    }
                });
                
                $("#verifyMySQL").click(function(){
                    /**
                     * Function mysqlVerify
                     * Send MySQL informations using "POST" Method
                     * with AJAX to install.php and verify
                     * if the connection has been established
                     */
                    var db_addr     = $("#db_addr").val();
                    var db_user     = $("#db_user").val();
                    var db_pass     = $("#db_pass").val();
                    var db_name     = $("#db_name").val();
                    var db_port     = $("#db_port").val();
                    var secure      = $("#secure").val();
                    var currentBtns = $(this).parent().parent().find(".btn:not(#verifyMySQL)"); // Select all buttons
                    var prevBtn     = $(this).parent().parent().find(".previousBtn");           // Select previousBtn
                    currentBtns.prop('disabled', true);                                         // Disable buttons
                    
    
                    if(!$("#iconMySQLVerify").hasClass("fa-spin")) 
                    {   // Loading icon
                        $("#iconMySQLVerify").removeClass();                                    // Erase the old icon
                        $("#verifyMySQL").removeClass();                                        // Erase the button classes
                        $("#iconMySQLVerify").addClass("fa fa-cog fa-spin");                    // Add the new icon
                        $("#verifyMySQL").addClass("btn-icon-split btn btn-primary btn-user");  // Add the new button classes
                        $("#textMySQLVerify").html("Loading");                                  // Change the text to "Loading"
                    }
    
                    $.ajax({
                        type:       "POST",             // Method
                        url:        "install.php",      // Destination script
                        data:       {
                            "action":"connect",         // Action
                            "server":db_addr,           // Refers to "db_addr" input
                            "username":db_user,         // Refers to "db_user" input
                            "password":db_pass,         // Refers to "db_pass" input
                            "port":db_port,             // Refers to "db_port" input
                            "database":db_name,         // Refers to "db_name" input
                            "secure":secure             // Refers to "secure" hidden input
                        },
                        success:    function(data) {
                            var json = JSON.parse(data);    // Result data is in JSON format

                            if(json["status"] == "true")
                            {   // Connection has been established

                                if($("#iconMySQLVerify").hasClass("fa-spin")) 
                                {   // Success icon & button  
                                    $("#iconMySQLVerify").removeClass();                                    // Erase the old icon
                                    $("#verifyMySQL").removeClass();                                        // Erase the button classes
                                    $("#iconMySQLVerify").addClass("fas fa-check");                         // Add the new icon
                                    $("#verifyMySQL").addClass("btn-icon-split btn btn-success btn-user");  // Add the new button classes
                                    $("#textMySQLVerify").html(json['msg']);                                // Change the text to "Success"
                                    currentBtns.prop('disabled', false);                                    // Enable all buttons
                                }
                            }
                            else if(json["status"] == "false")
                            {   // Connection has not been established
                                
                                if($("#iconMySQLVerify").hasClass("fa-spin")) 
                                {   // Error icon & button
                                    $("#iconMySQLVerify").removeClass();                                    // Erase the old icon
                                    $("#verifyMySQL").removeClass();                                        // Erase the button classes
                                    $("#iconMySQLVerify").addClass("fas fa-times");                         // Add the new icon
                                    $("#verifyMySQL").addClass("btn-icon-split btn btn-danger btn-user");   // Add the new button classes
                                    $("#textMySQLVerify").html(json["msg"]);                                // Change the text to the error message
                                    prevBtn.prop('disabled', false);                                        // Enable previousBtn
                                }
                            }
                        }
                    });
                });
            });
            
        </script>
    </body>
    <!-- END BODY -->
    
</html>
<!-- END HTML -->