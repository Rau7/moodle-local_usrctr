<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * Version information.
 *
 * @package   local_usrctr
 * @copyright Alp Toker
 * @author    Alp Toker <tokeralp@gmail.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->component = 'local_usrctr';
$plugin->version   = 2024011900;  // Version: Year (2024) Month (01) Day (19) Sequence (00).
$plugin->requires  = 2023100900;
$plugin->maturity  = MATURITY_STABLE;
$plugin->release   = '1.0.0';  // Version number.

// Add AMD support.
$plugin->dependencies = [];
