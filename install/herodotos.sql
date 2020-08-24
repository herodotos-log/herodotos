-- 
-- HERODOTOS - 1.0.0 - a7c083b337fec7683509299d7edb8d2a
-- ]-----------------------------------------------------------------------------[
-- | Copyright (C) 2020 HERODOTOS                                                |
-- |                                                                             |
-- | This program is free software; you can redistribute it and/or               |
-- | modify it under the terms of the GNU Affero General Public License          |
-- | as published by the Free Software Foundation; either version 2              |
-- | of the License, or (at your option) any later version.                      |
-- |                                                                             |
-- | This program is distributed in the hope that it will be useful,             |
-- | but WITHOUT ANY WARRANTY; without even the implied warranty of              |
-- | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the               |
-- | GNU Affero General Public License for more details.                         |
-- |                                                                             |
-- | You should have received a copy of the GNU Affero General Public License    |
-- | along with this program.  If not, see https://www.gnu.org/licenses.         |
-- ]-----------------------------------------------------------------------------[
-- | HERODOTOS: Easier Reading Logs                                              |
-- ]-----------------------------------------------------------------------------[
-- | This code is designed, written, and maintained by dpkg.ch. See              |
-- | about.php and/or the CREDITS file for specific developer information.       |
-- ]-----------------------------------------------------------------------------[
-- | https://dpkg.ch                                                             |
-- ]-----------------------------------------------------------------------------[
-- 
DROP TABLE IF EXISTS herodotos_user, herodotos_log, herodotos_var;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- 
-- Database: `herodotos`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `herodotos_log`
-- 

CREATE TABLE `herodotos_log` (
  `log_id` int(11) NOT NULL,
  `log_name` varchar(64) NOT NULL,
  `log_desc` varchar(255) NOT NULL,
  `log_filename` varchar(64) NOT NULL,
  `log_path` varchar(255) NOT NULL,
  `log_refresh` tinyint(1) NOT NULL DEFAULT '5',
  `log_entries` tinyint(2) NOT NULL DEFAULT '100',
  `log_regex` text NOT NULL,
  `log_firstChar` char(1) NOT NULL DEFAULT '[',
  `log_direction` varchar(7) NOT NULL DEFAULT 'reverse',
  `log_color` char(7) NOT NULL,
  `log_match` json NOT NULL,
  `log_types` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Logs data table';

-- --------------------------------------------------------

-- 
-- Table structure for table `herodotos_user`
-- 

CREATE TABLE `herodotos_user` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(16) NOT NULL,
  `user_password` varchar(32) NOT NULL,
  `user_change_password` tinyint(1) NOT NULL DEFAULT '0',
  `user_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `user_role` varchar(6) NOT NULL DEFAULT 'reader',
  `user_last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_last_change` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_last_fail` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_fails` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Users table';

-- --------------------------------------------------------

-- 
-- Table structure for table `herodotos_var`
-- 

CREATE TABLE `herodotos_var` (
  `var_name` varchar(32) NOT NULL,
  `var_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Variables called by herodotos_var()';

-- 
-- Indexes for dumped tables
-- 

-- 
-- Indexes for table `herodotos_log`
-- 
ALTER TABLE `herodotos_log`
  ADD PRIMARY KEY (`log_id`),
  ADD UNIQUE KEY `log_name` (`log_name`),
  ADD KEY `log_id` (`log_id`),
  ADD KEY `log_name_2` (`log_name`);

-- 
-- Indexes for table `herodotos_user`
-- 
ALTER TABLE `herodotos_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_username` (`user_username`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_password` (`user_password`),
  ADD KEY `user_username_2` (`user_username`);

-- 
-- Indexes for table `herodotos_var`
-- 
ALTER TABLE `herodotos_var`
  ADD PRIMARY KEY (`var_name`),
  ADD KEY `var_name` (`var_name`),
  ADD KEY `var_value` (`var_value`);

-- 
-- AUTO_INCREMENT for dumped tables
-- 

-- 
-- AUTO_INCREMENT for table `herodotos_log`
-- 
ALTER TABLE `herodotos_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

-- 
-- AUTO_INCREMENT for table `herodotos_user`
-- 
ALTER TABLE `herodotos_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;