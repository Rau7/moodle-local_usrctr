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
 * Event observer for user counter plugin.
 *
 * @package    local_usrctr
 * @copyright  2024 Alp Toker <tokeralp@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_usrctr;

defined('MOODLE_INTERNAL') || die();

/**
 * Event observer class
 */
class observer {
    /**
     * Check if user limit is exceeded
     */
    private static function is_limit_exceeded($newusers = 1) {
        global $DB;

        // Get user limit from config
        $limit = get_config('local_usrctr', 'userlimit');
        if (empty($limit)) {
            return false;
        }

        // Build conditions based on settings
        $conditions = array();
        if (!get_config('local_usrctr', 'include_suspended')) {
            $conditions['suspended'] = 0;
        }
        if (!get_config('local_usrctr', 'include_deleted')) {
            $conditions['deleted'] = 0;
        }

        // Count users
        $usercount = $DB->count_records('user', $conditions);
        
        // Check if adding new users would exceed limit
        return ($usercount + $newusers) > $limit;
    }

    /**
     * Show error message
     */
    private static function show_limit_error($newusers = 1) {
        global $DB;

        // Get user limit and count for message
        $limit = get_config('local_usrctr', 'userlimit');
        $conditions = array();
        if (!get_config('local_usrctr', 'include_suspended')) {
            $conditions['suspended'] = 0;
        }
        if (!get_config('local_usrctr', 'include_deleted')) {
            $conditions['deleted'] = 0;
        }
        $usercount = $DB->count_records('user', $conditions);

        $error = new \stdClass();
        $error->limit = $limit;
        $error->current = $usercount;
        $error->adding = $newusers;
        
        throw new \moodle_exception('userlimitexceeded', 'local_usrctr', '', $error);
    }

    /**
     * Handle single user creation
     */
    public static function user_created(\core\event\user_created $event) {
        if (self::is_limit_exceeded(1)) {
            self::show_limit_error(1);
        }
    }

    /**
     * Handle bulk user upload
     */
    public static function uploaduser_started(\tool_uploaduser\event\uploaduser_started $event) {
        global $SESSION;

        // Get the number of users to be added
        $uploadcount = 0;
        if (isset($SESSION->uploaduser['uutype']) && $SESSION->uploaduser['uutype'] === UU_USER_ADDNEW) {
            // Count lines in the CSV file (excluding header)
            $uploadcount = count($SESSION->uploaduser['userlist']) - 1;
        }

        // If we're adding new users, check the limit
        if ($uploadcount > 0 && self::is_limit_exceeded($uploadcount)) {
            self::show_limit_error($uploadcount);
        }
    }

    /**
     * Triggered before HTTP headers are sent.
     */
    public static function before_http_headers(\core\event\before_http_headers $event) {
        // Check user limit
        local_usrctr_before_http_headers();
    }

    /**
     * Triggered when standard HTML head is requested.
     */
    public static function before_standard_html_head(\core\event\standard_html_head_requested $event) {
        // Modify upload user form if needed
        local_usrctr_before_standard_html_head();
    }
}
