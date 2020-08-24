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
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <!-- Counter - Messages -->
                    <span class="badge badge-danger badge-counter">7</span>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">
                        <?php echo _("Alerts Center"); ?>
                    </h6>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3" style="color:orange;">
                            <i class="fas fa-exclamation-circle fa-3x"></i>
                            <!--<div class="status-indicator bg-success"></div>-->
                        </div>
                        <div class="font-weight-bold">
                            <div class="text-truncate">[TYPE] FILE – Type error</div>
                            <div class="small text-gray-500">Timestamp ago</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3" style="color:red;">
                            <i class="fas fa-exclamation-circle fa-3x"></i>
                            <!--<div class="status-indicator"></div>-->
                        </div>
                        <div>
                            <div class="text-truncate">[ERROR] PHP_ERROR.LOG – Unexpected syntax</div>
                            <div class="small text-gray-500">1d ago</div>
                        </div>
                    </a>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <div class="dropdown-list-image mr-3" style="color:green;">
                            <i class="fas fa-exclamation-circle fa-3x"></i>
                            <!--<div class="status-indicator bg-warning"></div>-->
                        </div>
                        <div>
                            <div class="text-truncate">[ERROR] APACHE.LOG – 404</div>
                            <div class="small text-gray-500">2d ago</div>
                        </div>
                    </a>
                    <a class="dropdown-item text-center small text-gray-500" href="#">Read More</a>
                </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Jonas Hügli</span>
                    <!--<img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
                    <i class="fas fa-user-circle fa-2x"></i>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        <?php echo _("Profile"); ?>
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fas fa-wrench fa-sm fa-fw mr-2 text-gray-400"></i>
                        <?php echo _("Settings"); ?>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        <?php echo _("Logout"); ?>
                    </a>
                </div>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->