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
// VERIFICATION
//=============================================================================
//
if($_SERVER['REQUEST_METHOD'] !== 'POST') die();
else if(@!isset($_POST['secure'])) die();
else if($_POST['secure'] !== hash('sha3-512', '0b3d09244233ed695f5062dbfa6a5ada72040ed4250ee142b6c7c37900ee5d0b1c284ab65bb3d82fea92f333c7dcc78c44a9f63665b7a097e652191c4211a804')) die();
else if(@!isset($_POST['action'])) die();
else if(empty($_POST['action'])) die();

switch($_POST['action'])
{
    case 'connect':
        if((@!isset($_POST['server'])) || (@!isset($_POST['username'])) || (@!isset($_POST['password'])) || (@!isset($_POST['database'])) || (@!isset($_POST['port']))) die();
        if((empty($_POST['server'])) || (empty($_POST['username'])) || (empty($_POST['password'])) || (empty($_POST['database'])) || (empty($_POST['port'])))
        {
            echo json_encode(array('status' => 'false', 'msg' => 'Empty fields'));
            return;
        }
        $result = install_db_verification($_POST['server'], $_POST['username'], $_POST['password'], $_POST['database'],intval($_POST['port']));
        break;
    case 'install':
        $result = install_app($_POST);
        break;
    default:
        $result = array(
            'status'    =>  'false',
            'msg'       =>  _('Unauthorized access!')
        );
        break;
}
            
echo json_encode($result);
return;

//=============================================================================
// DATABASE VERIFICATION
//=============================================================================
//
function install_db_verification(string $server, string $username, string $password, string $database,int $port = 3306)
{
    $conn = @new mysqli($server, $username, $password, $database, $port);
    if($conn->connect_error)
    {
        $result['status']   = 'false';
        $result['msg']      = $conn->connect_error;
    }
    else
    {
        if($conn->server_info < 5)
        {
            $result['status'] = 'false';
            $result['msg']    = _('Version is ' . $conn->server_info . " – the MySQL version must be at least 5.x!");
        }
        else 
        {
            $result['status']   = 'true';
            $result['msg']      = _("Connected – Version is " . $conn->server_info . "!");
        }
        mysqli_close($conn);
    }
    return $result;
}

//=============================================================================
// CORE INSTALLATION
//=============================================================================
//
function install_app($POST)
{   
    $corePath       = "../config/core.php";
    $coreContent    = file_get_contents($corePath);
    
    //=============================
    // GENERAL
    //=============================
    //
    if((@!isset($POST['general_url'])) || 
       (@!isset($POST['general_webname'])) || 
       (@!isset($POST['general_desc'])) || 
       (@!isset($POST['general_author'])) || 
       (@!isset($POST['general_lang'])) || 
       (@!isset($POST['general_title']))
      ) return array('status' => 'false', 'msg' => _('Unauthorized access!'));
    if((empty($POST['general_url'])) ||
       (empty($POST['general_webname'])) ||
       (empty($POST['general_author'])) ||
       (empty($POST['general_lang'])) ||
       (empty($POST['general_title']))
      ) return array('status' => 'false', 'msg' => _('Invalid datas in "general" section!'));
    
    $coreContent = preg_replace("/\"url\"\s+=>\s+\"(.+|)\",/", '"url"           =>  "' . $POST['general_url'] . '",', $coreContent);
    $coreContent = preg_replace("/\"sitename\"\s+=>\s+\"(.+|)\",/", '"sitename"      =>  "' . $POST['general_webname'] . '",', $coreContent);
    $coreContent = preg_replace("/\"description\"\s+=>\s+\"(.+|)\",/", '"description"   =>  "' . $POST['general_desc'] . '",', $coreContent);
    $coreContent = preg_replace("/\"author\"\s+=>\s+\"(.+|)\",/", '"author"        =>  "' . $POST['general_author'] . '",', $coreContent);
    $coreContent = preg_replace("/\"language\"\s+=>\s+\"(.+|)\",/", '"language"      =>  "' . $POST['general_lang'] . '",', $coreContent);
    $coreContent = preg_replace("/\"title\"\s+=>\s+\"(|.+)\"/", '"title"         =>  "' . $POST['general_title'] . '"', $coreContent);
    //=============================
    
    //=============================
    // DATABASE
    //=============================
    //
    if((@!isset($POST['db_addr'])) || 
       (@!isset($POST['db_user'])) || 
       (@!isset($POST['db_pass'])) || 
       (@!isset($POST['db_port'])) || 
       (@!isset($POST['db_name']))
      ) return array('status' => 'false', 'msg' => _('Unauthorized access!'));
    if((empty($POST['db_addr'])) ||
       (empty($POST['db_user'])) ||
       (empty($POST['db_pass'])) ||
       (empty($POST['db_port'])) ||
       (empty($POST['db_name']))
      ) return array('status' => 'false', 'msg' => _('Invalid datas in "database" section!'));
    
    $coreContent = preg_replace("/\"addr\"\s+=>\s+\"(.+|)\",/", '"addr"  =>  "' . $POST['db_addr'] . '",', $coreContent); 
    $coreContent = preg_replace("/\"user\"\s+=>\s+\"(.+|)\",/", '"user"  =>  "' . $POST['db_user'] . '",', $coreContent); 
    $coreContent = preg_replace("/\"pass\"\s+=>\s+\"(.+|)\",/", '"pass"  =>  "' . $POST['db_pass'] . '",', $coreContent);
    $coreContent = preg_replace("/\"name\"\s+=>\s+\"(.+|)\",/", '"name"  =>  "' . $POST['db_name'] . '",', $coreContent);
    $coreContent = preg_replace("/\"port\"\s+=>\s+\"(.+|)\"/", '"port"  =>  "' . $POST['db_port'] . '"', $coreContent); 
    //=============================
    
    //=============================================================================
    // CREDENTIALS
    //=============================================================================
    //
    if((@!isset($POST['cred_user'])) || 
       (@!isset($POST['cred_pass']))   
      ) return array('status' => 'false', 'msg' => _('Unauthorized access!'));
    if((empty($POST['cred_user'])) ||
       (empty($POST['cred_pass'])) 
      ) return array('status' => 'false', 'msg' => _('Invalid datas in "credentials" section!'));
    
    //=============================================================================
    // DATABASE INITIALIZATION
    //=============================================================================
    //
    $conn = @new mysqli($POST['db_addr'], $POST['db_user'], $POST['db_pass'], $_POST['db_name'], $POST['db_port']);
    if($conn->connect_error) return array('status' => 'false', 'msg' => $conn->connect_error);
    
    // Initiate database
    $sqlQuery = '';
    $sqlFile = file("herodotos.sql");
    foreach($sqlFile as $line)
    {
        $start  = substr(trim($line), 0 ,2);
        $end    = substr(trim($line), -1 ,1);
        if(empty($line) || $start == '--' || $start == '//' || $start == '/*') continue;
        
        $sqlQuery = $sqlQuery . $line;
        if($end == ";")
        {
            if(!$conn->query($sqlQuery)) return array('status' => 'false', 'msg' => _('Error in query!'));
            $sqlQuery = '';
        }
	}
    
    // INSERTS
    $sqlInsert = "INSERT INTO `herodotos_user` (`user_username`, `user_password`, `user_change_password`, `user_enabled`, `user_role`, `user_last_login`, `user_last_change`, `user_last_fail`, `user_fails`) VALUES ('" . $POST['cred_user'] . "', MD5('" . $POST['cred_pass'] . "'), '0', '1', 'admin', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '0')";
    if(!$conn->query($sqlInsert)) return array('status' => 'false', 'msg' => $conn->error);
    mysqli_close($conn);
    //=============================
    
    $coreContent = preg_replace("/\"installation\"\s+=>\s+(|.+),/", '"installation"  =>  false,', $coreContent);
    file_put_contents($corePath, $coreContent);
    //=============================
    return array('status' => 'true', 'msg' => 'ok');
}
?>