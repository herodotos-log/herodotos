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

function custom_error(int $code, $file, $line)
{
    switch($code)
    {
        default:
            break;
    }
    herodotos_log($type, $msg, $file, $line);
    
    $error =
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
    ';
    
    return $error;
}
?>