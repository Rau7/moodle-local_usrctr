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
 * Plugin strings are defined here.
 *
 * @package     local_edwiserreports
 * @category    string
 * @copyright   2019 wisdmlabs <support@wisdmlabs.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use function Complex\ln;

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'User Limit Control';
$string['error'] = 'Error';
$string['limit'] = 'You have reached the limit!';
$string['userlimit'] = 'User limit';
$string['userlimitdesc'] = 'Maximum number of active users allowed in the system';
$string['userlimit_desc'] = 'Maximum number of users allowed';
$string['userlimitexceeded'] = 'User limit exceeded. Current users: {$a->current}, Limit: {$a->limit}';
$string['userlimitexceeded_title'] = 'User Limit Reached';
$string['include_suspended'] = 'Include suspended users';
$string['include_suspended_desc'] = 'Include suspended users in the count';
$string['include_deleted'] = 'Include deleted users';
$string['include_deleted_desc'] = 'Include deleted users in the count';
$string['usrctr:manage'] = 'Manage user limit settings';