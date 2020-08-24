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
*
* ]-----------------------------------------------------------------------------[
* | The MIT License (MIT)                                                       |
* |                                                                             |
* | Copyright (c) 2013-2020 Start Bootstrap LLC                                 |
* |                                                                             |
* | Permission is hereby granted, free of charge, to any person obtaining       |
* | a copy of this software and associated documentation files                  |
* | (the "Software"), to deal                                                   |
* | in the Software without restriction, including without limitation           |
* | the rights to use, copy, modify, merge, publish, distribute, sublicense,    |
* | and/or sell copies of the Software, and to permit persons to whom           |
* | the Software is furnished to do so, subject to the following conditions:    |
* |                                                                             |
* | The above copyright notice and this permission notice shall be included in  |
* | all copies or substantial portions of the Software.                         |
* |                                                                             |
* | THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR  |
* | IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,    |
* | FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE |
* | AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER      |
* | LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE,             |
* | ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE          |
* | OR OTHER DEALINGS IN THE SOFTWARE.                                          |
* ]-----------------------------------------------------------------------------[
*/
?>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
            <span class="icn-herodotos icn-4x"></span>
        </div>
        <div class="sidebar-brand-text mx-3" style="font-family: 'Quattrocento', serif; l">
            HERODOTOS
        </div>
    </a>

    <!-- Divider -->
     <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span><?php echo _("Dashboard"); ?></span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="far fa-file-alt"></i>
            <span><?php echo _("Logs"); ?></span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded text-center">
                <?php
                    if(sizeof($logs) == 0)
                    {
                        print '<p style="margin:0 0.5rem; color:#3a3b45;">' . _("No existing logs") . '</p>';
                        print '<button type="button" id="createLog" class="btn btn-primary">' . _("Create an entry") . '</button>';
                    }
                    else
                    {
                        foreach($logs as $element)
                        {
                            print '<a class="collapse-item" href="index.php?log=' . $element["log_id"] . '">' . $element['log_filename'] . '</a>';
                        }
                    }
                ?>
            </div>
        </div>
    </li>
       
    <!-- Nav Item - Settings -->
    <li class="nav-item">
        <a class="nav-link" href="index.php?action=settings">
            <i class="fas fa-sliders-h"></i>
            <span><?php echo _("Settings"); ?></span></a>
    </li>
        
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
        
    <!-- Nav Item - Documentation -->
    <li class="nav-item">
        <a class="nav-link" href="https://github.com/huglijonas/herodotos" target="_blank">
            <i class="fab fa-github"></i>
            <span><?php echo _("Documentation"); ?></span></a>
    </li>    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    </ul>
    <!-- End of Sidebar -->