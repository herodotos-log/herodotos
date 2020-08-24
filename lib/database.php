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
// CONNECTION
//=============================================================================
//  Connect to the database
//
global $mysqli;
$mysqli = @new mysqli(DB['addr'], DB['user'], DB['pass'], DB['name'], DB['port']);
if($mysqli->connect_error) die("ERROR CONNECT");
//=============================================================================

//=============================================================================
// QUERY
//=============================================================================
// Execute a query
//
// @param   string  $sql:       SQL Syntax              |
// @param   array   $params:    Parameters              | Default: empy array
// @return  array   @result:    Result of the SQL Query |
//
function db_query(string $sql, array $params = array())
{
    global $mysqli;
    
    if(($query = $mysqli->prepare($sql)) === false) return trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
    if(sizeof($params) > 0)
    {
        if(@!isset($params['types']) || @!isset($params['values'])) return "Error – Empty parameters!";
        if(count($params['types']) != count($params['values'])) return "Error – Invalid parameters!";
        $types  = implode("", $params['types']);
        $values = array_map(array($mysqli, 'real_escape_string'), $params['values']);
        if(@$query->bind_param($types, ...$values) === false)
        {
            return trigger_error('Wrong params - Error: ' . $mysqli->errno . ' ' . $mysqli->error, E_USER_ERROR);
        }
    }

    if(($query->execute()) === false) return trigger_error('Error: ' . $query->errno . ' ' . $query->error, E_USER_ERROR);
    $result = $query->get_result();
    
    return $result;
}
//=============================================================================

//=============================================================================
// COUNT
//=============================================================================
// Count the number of fetched elements
//
function db_count(string $sql, array $params = array())
{
    if(($sql = db_query($sql, $params)) === false) return false;
    $result = $sql->field_count();
    return $result;
}
//=============================================================================

//=============================================================================
// FETCH ALL
//=============================================================================
// Fetches all result rows as an associative array, a numeric array, or both
//
// @param   string  $sql:       SQL Syntax              |
// @param   array   $params:    Parameters              | Default: empy array
// @return  array   @result:s   Result of the fetching  |
//
function db_fetch_all(string $sql, array $params = array())
{
    if(($sql = db_query($sql, $params)) === false) return false;
    if($sql === null) return false;
    while($result = $sql->fetch_all()) $results[] = $result;
    if(sizeof($results) == 1) $results = $results[0];
    return $results;
}
//=============================================================================

//=============================================================================
// FETCH ARRAY
//=============================================================================
// Fetch a result row as an associative, a numeric array, or both
//
// @param   string  $sql:       SQL Syntax              |
// @param   array   $params:    Parameters              | Default: empy array
// @return  array   @result:s   Result of the fetching  |
//
function db_fetch_array(string $sql, array $params = array())
{
    if(($sql = db_query($sql, $params)) === false) return false;
    if($sql === null) return false;
    while($result = $sql->fetch_array()) $results[] = $result;
    if(sizeof($results) == 1) $results = $results[0];
    return $results;
}
//=============================================================================

//=============================================================================
// FETCH ASSOC
//=============================================================================
// Fetch a result row as an associative array
//
// @param   string  $sql:       SQL Syntax              |
// @param   array   $params:    Parameters              | Default: empy array
// @return  array   @result:s   Result of the fetching  |
//
function db_fetch_assoc(string $sql, array $params = array())
{
    $results = array();
    if(($sql = db_query($sql, $params)) === false) return false;
    if($sql === null) return false;
    while($result = $sql->fetch_assoc()) $results[] = $result;
    if(sizeof($results) == 1) $results = $results[0];
    return $results;
}
//=============================================================================

//=============================================================================
// FETCH FIELDS
//=============================================================================
// Returns an array of objects representing the fields in a result set
//
function db_fetch_fields(string $sql, array $params = array())
{
    $results = array();
    if(($sql = db_query($sql, $params)) === false) return false;
    if($sql === null) return false;
    while($result = $sql->fetch_fields()) $results[] = $result;
    if(sizeof($results) == 1) $results = $results[0];
    return $results;
}
//=============================================================================

//=============================================================================
// FETCH ROW
//=============================================================================
// Get a result row as an enumerated array
//
// @param   string  $sql:       SQL Syntax              |
// @param   array   $params:    Parameters              | Default: empy array
// @return  array   @result:s   Result of the fetching  |
//
function db_fetch_row(string $sql, array $params = array())
{
    $results = array();
    if(($sql = db_query($sql, $params)) === false) return false;
    if($sql === null) return false;
    while($result = $sql->fetch_row()) $results[] = $result;
    if(sizeof($results) == 1) $results = $results[0];
    return $results;
}
//=============================================================================

//=============================================================================
// CLOSE
//=============================================================================
// Close the connection to the database
//
function db_close()
{
    global $mysqli;
    $connection->close();
}
//=============================================================================
?>