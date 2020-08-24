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
set_error_handler("herodotos_log");             // Errors redirection
set_exception_handler("herodotos_exception");   // Exceptions redirection
require_once(PATH['lib'] . "error.php");        // Include error library
require_once(PATH['lib'] . "database.php");     // Include DB library

//=================================================================================================================
// HERODOTOS LOG
//=============================================================================
// Writing logs for Herodotos only
//
// @param   string  $msg:   Message Content
// @param   string  $level: Logging Level   | Default: 'error'
// @param   string  $type:  Service Type    | Default: ''
// @param   string  $line:  Line Number     | Default: ''
// @return  null
//
function herodotos_log($type, $msg, $file, $line, $context=null)
{   // Line formatting
    switch($type)
    {
        case E_ERROR:
        case E_CORE_ERROR:
        case E_COMPILE_ERROR:
        case E_USER_ERROR:
        case E_RECOVERABLE_ERROR:
            $type = 'error';
            break;
        case E_WARNING:
        case E_CORE_WARNING:
        case E_COMPILE_WARNING:
        case E_USER_WARNING:
            $type = 'warning';
            break;
        case E_NOTICE:
        case E_USER_NOTICE:
            $type = 'notice';
            break;
        case E_PARSE:
            $type = 'parse';
            break;
        case E_STRICT:
            $type = 'strict';
            break;
        case E_DEPRECATED:
        case E_USER_DEPRECATED:
            $type = 'deprecated';
            break;
        default:
            break;
    }
    $log = "[" . date('d-M-Y H:i:s e') . "] " . strtoupper($type) . ": " . $msg . " | at " . $file . " on line " . $line . PHP_EOL;
    // Verify if file exists and create it if not
    if(@!file_exists(PATH['log'] . "herodotos.log")) 
    {
        touch(PATH['log'] . "herodotos.log");
        set_var("time_log", time());
    }
    else if((time() - intval(get_var("time_log"))) > 86400)
    {   // If creation date is 1d old > rename file and recreate it
        rename(PATH['log'] . 'herodotos.log', PATH['log'] . "herodotos-" . time() . ".log");
        touch(PATH['log'] . "herodotos.log");
        set_var("time_log", time());
    }
    // Append the log message in file
    file_put_contents(PATH['log'] . "herodotos.log", $log, FILE_APPEND);
    return;
}
//=============================================================================

//=============================================================================
// HERODOTOS EXCEPTION
//=============================================================================
// Writing logs for Herodotos only
//
// @param   string  $msg:   Message Content
// @param   string  $level: Logging Level   | Default: 'error'
// @param   string  $type:  Service Type    | Default: ''
// @param   string  $line:  Line Number     | Default: ''
// @return  null
//
function herodotos_exception()
{
    $e = new Exception();
    $trace = explode("\n", $e->getTraceAsString());
    // reverse array to make steps line up chronologically
    $trace = array_reverse($trace);
    array_shift($trace); // remove {main}
    array_pop($trace); // remove call to this method
    $length = count($trace);
    $result = array();
}

//=============================================================================

//=================================================================================================================
// FILES
//=============================================================================

//=============================================================================
// TAIL FILE
//=============================================================================
// Create the herodotos.log file
// and add the creation date as 1st line
//
function tail_file(int $id)
{    
    $id = 1;
    $fileInfos = db_fetch_assoc("SELECT 
        log_id, log_path, log_filename, 
        log_entries, log_firstChar, log_regex, 
        log_direction FROM herodotos_log WHERE log_id=" . $id);
    if($fileInfos === false) return false;
    
    //$interval = $entries;
    $page       = 1;
    $entries    = 100; //$fileInfos['log_entries'];
    $nbLines    = count(file($fileInfos['log_path']));
    if($nbLines === 0) return "empty";
    
    $totalPages = ceil($nbLines / $entries);
    
    if($fileInfos['log_direction'] == 'reverse')
    {
        $begin      = ($nbLines - ($page * $entries) < 0) ? 0 : $nbLines - ($page * $entries);
        $end        = ($nbLines - (($page-1) * $entries) < 0) ? $nbLines : $nbLines - (($page-1) * $entries);
    }
    else
    {
        $begin  = ($page-1) * $entries;
        $end    = $page * $entries;
    }
    
    echo "ENTRIES: $entries | PAGE: $page | BEGIN: $begin | END: $end <br>";
    //echo mb_strlen($begin, '8bit');
    

    // Buffer
    $buffer = ($entries < 2 ? 64 : ($entries < 10 ? 512 : 4096));
    
    //
    // CHECK IF ACCESS, PERMISSIONS...
    //
    // Open file
    //$file   = new SplFileInfo($fileInfos['log_path']);
    try {
        $file = new aLimitIterator(
            new SplFileObject($fileInfos['log_path']),
            $begin,
            $end
        );
    } catch (Exception $e) {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
    
    $output = array();
    
    foreach($file as $line)
    {
        if($line !== '') $output[] = $line;
    }
    if($fileInfos['log_direction'] === 'reverse') $output = array_reverse($output);
    return $output;
    
    /*
    --> si ligne contient pas '###' > 
    |       $currentLine = $fileStream->fgets();
    |
    |       --> si counter commencé > 
    |       |       --> si la ligne commence par firstChar > 
    |       |       |       
    |       |       |
    |       |       --> $currentLine .= $content;
    |       |       
    |       --> si counter pas commencé > $counter = 1;
    |
    |-> $end++;
    */
}
//=============================================================================



//=================================================================================================================
// SERVER VARIABLES
//=============================================================================

//=============================================================================
// SET VARIABLES
//=============================================================================
//
function set_var(string $name, string $value)
{
    $params = array(
        "types"     => array('s', 's'),
        "values"    => array($name, $value)
    );
    $query = db_query("REPLACE INTO herodotos_var (var_name, var_value) VALUES (?, ?)", $params);
}
//=============================================================================

//=============================================================================
// GET VARIABLES
//=============================================================================
//
function get_var(string $name)
{
    $params = array(
        "types"     => array('s'),
        "values"    => array($name)
    );
    $result = db_fetch_row("SELECT var_value FROM herodotos_var WHERE var_name = ?", $params);
    if($result === false) return "none";
    return $result[0];
}
//=============================================================================

function getRequest(string $name, $default='')
{
    if(isset($_GET[$name])) {
        return $_GET[$name];
    }
    else {
        return $return;
    }
}
?>