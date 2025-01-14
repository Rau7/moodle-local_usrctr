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

namespace local_usrctr\local;

defined('MOODLE_INTERNAL') || die();

/**
 * Event observer class.
 */
class observer {
    /**
     * Handle user created event.
     *
     * @param \core\event\user_created $event The event.
     * @return void
     */
    public static function user_created(\core\event\user_created $event) {
        global $DB;
        self::check_user_limit();
    }

    /**
     * Handle user deleted event.
     *
     * @param \core\event\user_deleted $event The event.
     * @return void
     */
    public static function user_deleted(\core\event\user_deleted $event) {
        global $DB;
        self::check_user_limit();
    }

    /**
     * Handle user updated event.
     *
     * @param \core\event\user_updated $event The event.
     * @return void
     */
    public static function user_updated(\core\event\user_updated $event) {
        global $DB;
        self::check_user_limit();
    }

    /**
     * Check if user limit has been exceeded.
     *
     * @throws \moodle_exception
     * @return void
     */
    private static function check_user_limit() {
        global $DB;

        $config = get_config('local_usrctr');
        if (empty($config->userlimit)) {
            return;
        }

        $params = ['deleted' => 0];
        if (!empty($config->include_suspended)) {
            $params['suspended'] = 1;
        }
        if (!empty($config->include_deleted)) {
            $params['deleted'] = 1;
        }

        $usercount = $DB->count_records_select('user', 'deleted = :deleted', $params);
        if ($usercount > $config->userlimit) {
            throw new \moodle_exception('userlimitexceeded', 'local_usrctr',
                '', ['current' => $usercount, 'limit' => $config->userlimit]);
        }
    }

    /**
     * Handle bulk user upload
     *
     * @param \tool_uploaduser\event\uploaduser_started $event The event.
     * @return void
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
        if ($uploadcount > 0 && self::check_user_limit_upload($uploadcount)) {
            self::show_limit_error($uploadcount);
        }
    }

    /**
     * Check if user limit has been exceeded for upload.
     *
     * @param int $newusers
     * @return bool
     */
    private static function check_user_limit_upload($newusers) {
        global $DB;

        $config = get_config('local_usrctr');
        if (empty($config->userlimit)) {
            return false;
        }

        $params = ['deleted' => 0];
        if (!empty($config->include_suspended)) {
            $params['suspended'] = 1;
        }
        if (!empty($config->include_deleted)) {
            $params['deleted'] = 1; // Fixing array assignment syntax
        }

        $usercount = $DB->count_records_select('user', 'deleted = :deleted', $params);
        return ($usercount + $newusers) > $config->userlimit;
    }

    /**
     * Show error message
     *
     * @param int $newusers
     * @return void
     */
    private static function show_limit_error($newusers = 1) {
        global $DB;

        // Get user limit and count for message
        $config = get_config('local_usrctr');
        $params = ['deleted' => 0];
        if (!empty($config->include_suspended)) {
            $params['suspended'] = 1;
        }
        if (!empty($config->include_deleted)) {
            $params['deleted'] = 1;
        }
        $usercount = $DB->count_records_select('user', 'deleted = :deleted', $params);

        $error = new \stdClass();
        $error->limit = $config->userlimit;
        $error->current = $usercount;
        $error->adding = $newusers;
        
        throw new \moodle_exception('userlimitexceeded', 'local_usrctr', '', $error);
    }

    /**
     * Triggered before HTTP headers are sent.
     *
     * @param \core\event\before_http_headers $event The event.
     * @return void
     */
    public static function before_http_headers(\core\event\before_http_headers $event) {
        // Check user limit
        local_usrctr_before_http_headers();
    }

    /**
     * Triggered when standard HTML head is requested.
     *
     * @param \core\event\standard_html_head_requested $event The event.
     * @return void
     */
    public static function before_standard_html_head(\core\event\standard_html_head_requested $event) {
        // Modify upload user form if needed
        local_usrctr_before_standard_html_head();
    }
}
