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
 * English language strings for local_usrctr
 *
 * @package    local_usrctr
 * @copyright  2024 Alp Toker <tokeralp@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use function Complex\ln;

defined('MOODLE_INTERNAL') || die();

// Plugin strings
$string['pluginname'] = 'User Counter';
$string['pluginname_desc'] = 'User Counter plugin allows you to track and limit the number of users in your Moodle site.';

// Settings strings
$string['settings'] = 'User Counter Settings';
$string['userlimit'] = 'User limit';
$string['userlimit_desc'] = 'Maximum number of users allowed in the system';
$string['userlimitdesc'] = 'Set the maximum number of active users allowed in your Moodle site';
$string['include_suspended'] = 'Include suspended users';
$string['include_suspended_desc'] = 'If enabled, suspended users will be counted towards the user limit';
$string['include_deleted'] = 'Include deleted users';
$string['include_deleted_desc'] = 'If enabled, deleted users will be counted towards the user limit';

// Error messages
$string['error'] = 'Error';
$string['error_limit_reached'] = 'User limit has been reached. Please contact your administrator.';
$string['error_upload_limit'] = 'Cannot upload users: user limit would be exceeded.';
$string['userlimitexceeded'] = 'User limit exceeded. Current users: {$a->current}, Limit: {$a->limit}';
$string['userlimitexceeded_title'] = 'User Limit Reached';
$string['userlimitexceeded_upload'] = 'User limit exceeded. You can only update existing users.';

// Status messages
$string['status_active'] = 'Active';
$string['status_suspended'] = 'Suspended';
$string['status_deleted'] = 'Deleted';
$string['total_users'] = 'Total Users';
$string['remaining_slots'] = 'Remaining Slots';

// Capability strings
$string['usrctr:manage'] = 'Manage user counter settings';
$string['usrctr:view'] = 'View user counter statistics';

// Privacy
$string['privacy:metadata'] = 'The User Counter plugin does not store any personal data.';