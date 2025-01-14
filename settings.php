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
 * Settings for local_usrctr.
 *
 * @package    local_usrctr
 * @copyright  2024 Alp Toker <tokeralp@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    // Create settings page
    $settings = new admin_settingpage('local_usrctr', get_string('pluginname', 'local_usrctr'));
    $ADMIN->add('localplugins', $settings);

    // Add settings
    $settings->add(new admin_setting_configtext(
        'local_usrctr/userlimit',
        get_string('userlimit', 'local_usrctr'),
        get_string('userlimitdesc', 'local_usrctr'),
        1000, // default value
        PARAM_INT
    ));

    $settings->add(new admin_setting_configcheckbox(
        'local_usrctr/include_suspended',
        get_string('include_suspended', 'local_usrctr'),
        get_string('include_suspended_desc', 'local_usrctr'),
        0  // default to unchecked
    ));

    $settings->add(new admin_setting_configcheckbox(
        'local_usrctr/include_deleted',
        get_string('include_deleted', 'local_usrctr'),
        get_string('include_deleted_desc', 'local_usrctr'),
        0  // default to unchecked
    ));
}
