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
// GENERAL
//=============================================================================
//  Contains all basic informations
//
// UTILITIES        | DEFAULT VALUES
// -----------------------------------
// Install status   | true (enable)
// Session name –   | 'herodotos' >>> DO NOT CHANGE THIS VALUE
// Log events       | true
//
$config = array(
    "installation"  =>  false,
    "session"       =>  "herodotos",
    "log"           =>  true
);
defined('CONFIG') or define('CONFIG', $config);

//=============================================================================
// PATH
//=============================================================================
//  Contains all basic paths
//
// UTILITIES
// -----------
// Root of 'herodotos'
// Data (JSON)
// Config files
// Ressources (js, css...)
// Installation
// Functions
// Languages
// HTML templates
//
$path = array(
    "base"      =>  basename(".")           .   "/",
    "config"    =>  basename("config")      .   "/",
    "include"   =>  basename("include")     .   "/",
    "install"   =>  basename("install")     .   "/",
    "lib"       =>  basename("lib")         .   "/",
    "log"       =>  basename("log")         .   "/",
    "locale"    =>  basename("locale")      .   "/",
    "templates" =>  basename("templates")   .   "/"
);
defined('PATH') or define('PATH', $path);

//=============================================================================
// GENERAL
//=============================================================================
// All general informations for HTML
//
// UTILITIES                    | EXAMPLES
// -----------------------------------------
// Website URL                  | https://github.com/huglijonas/herodotos
// Website sitename             | Herodotos
// Website description          | Easier Reading Files
// Website author               | Jonas Huegli
// Chosen or default language   | EN (fr_FR, de_DE, it_IT)
// Web Title                    | Herodotos – 
//
$general = array(
    "url"           =>  "http://localhost:8888",
    "sitename"      =>  "Herodotos",
    "description"   =>  "Easier Reading Logs",
    "author"        =>  "Jonas H.",
    "language"      =>  "en",
    "title"         =>  "Herodotos | "
);
defined('GENERAL') or define('GENERAL', $general);

//=============================================================================
// LANGUAGE
//=============================================================================
// Set language depending WEB['language']
//
putenv("LANG=" . GENERAL['language']);
setlocale(LC_ALL, GENERAL['language']);
bindtextdomain("herodotos", PATH['locale']);
textdomain("herodotos");

//=============================================================================
// DATABASE
//=============================================================================
// All informations about the Database
// MySQL only
//
// UTILITIES        | EXAMPLES
// -----------------------------
// Server address   | 127.0.0.1
// Username         | root
// Password         | root
// Database name    | herodotos
// Port number      | 3306 
//
$db = array(
    "addr"  =>  "127.0.0.1",
    "user"  =>  "root",
    "pass"  =>  "root",
    "name"  =>  "herodotos",
    "port"  =>  "8889"
);
defined('DB') or define('DB', $db);
?>