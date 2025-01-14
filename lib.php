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
 * Library functions for local_usrctr.
 *
 * @package    local_usrctr
 * @copyright  2024 Alp Toker <tokeralp@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Check if we're trying to add a new user
 */
function local_usrctr_is_new_user_page() {
    global $PAGE;

    // Get the current URL path.
    $url = $PAGE->url->get_path();
    
    // Check if we're on a user edit page.
    if (strpos($url, '/user/editadvanced.php') !== false || 
        strpos($url, '/user/edit.php') !== false) {
        
        // Get the user id parameter.
        $userid = optional_param('id', 0, PARAM_INT);
        
        // Consider it a new user page if:
        // - id is 0 (explicitly new user)
        // - id is negative (implicitly new user)
        // - id parameter is missing
        return $userid <= 0;
    }
    
    return false;
}

/**
 * Check if user limit is exceeded
 */
function local_usrctr_is_limit_exceeded() {
    global $DB;

    // Get user limit from config.
    $limit = get_config('local_usrctr', 'userlimit');
    if (empty($limit)) {
        return false;
    }

    // Build conditions based on settings.
    $conditions = array();
    if (!get_config('local_usrctr', 'include_suspended')) {
        $conditions['suspended'] = 0;
    }
    if (!get_config('local_usrctr', 'include_deleted')) {
        $conditions['deleted'] = 0;
    }

    // Count users.
    $usercount = $DB->count_records('user', $conditions);
    return $usercount >= $limit;
}

/**
 * Show error message without redirect
 */
function local_usrctr_show_limit_message() {
    global $DB, $OUTPUT;

    // Get user limit and count for message.
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
    
    $message = get_string('userlimitexceeded', 'local_usrctr', $error);
    
    // Add custom styling.
    $style = html_writer::tag('style', '
        .userlimit-error-message {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            margin: 10px 0;
            border-radius: 4px;
            font-size: 14px;
            line-height: 1.5;
            text-align: center;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            font-weight: bold;
        }
    ');
    
    $error_div = html_writer::div($message, 'userlimit-error-message');
    return $style . $error_div;
}

/**
 * Show error message and redirect
 */
function local_usrctr_show_limit_error() {
    global $DB, $OUTPUT, $CFG;

    // Get user limit and count for message.
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
    
    $message = get_string('userlimitexceeded', 'local_usrctr', $error);
    
    // Add custom styling.
    $style = html_writer::tag('style', '
        .userlimit-error {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            margin: 10px 0;
            border-radius: 4px;
            font-size: 14px;
            line-height: 1.5;
            text-align: center;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
    ');
    
    $error_div = html_writer::div($message, 'userlimit-error');
    \core\notification::add($style . $error_div, \core\output\notification::NOTIFY_ERROR);
    
    redirect($CFG->wwwroot . '/admin/user.php');
}

/**
 * Check user limit before loading any page
 */
function local_usrctr_before_http_headers() {
    global $PAGE;

    // Initialize $PAGE if not done yet.
    if (!isset($PAGE) || !$PAGE->has_set_url()) {
        return;
    }

    // Check if we're trying to add a new user.
    if (local_usrctr_is_new_user_page()) {
        if (local_usrctr_is_limit_exceeded()) {
            local_usrctr_show_limit_error();
        }
    }
}

/**
 * Modify upload user form if limit is exceeded
 */
function local_usrctr_before_standard_html_head() {
    global $PAGE, $OUTPUT, $DB;

    // Check if we're on the upload user page.
    if (strpos($PAGE->url->get_path(), '/admin/tool/uploaduser/index.php') !== false) {
        if (local_usrctr_is_limit_exceeded()) {
            // Get user limit and count for message.
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
            
            $message = get_string('userlimitexceeded', 'local_usrctr', $error);
            $uploadMessage = get_string('userlimitexceeded_upload', 'local_usrctr');
            
            // Add custom styling.
            $style = "
                <style>
                    .userlimit-error-message {
                        background-color: #f8d7da !important;
                        border: 1px solid #f5c6cb !important;
                        color: #721c24 !important;
                        padding: 15px !important;
                        margin: 10px 0 20px 0 !important;
                        border-radius: 4px !important;
                        font-size: 14px !important;
                        line-height: 1.5 !important;
                        text-align: center !important;
                        font-weight: bold !important;
                        display: block !important;
                        width: 100% !important;
                    }

                    .userlimit-error-message.small {
                        font-size: 12px !important;
                        padding: 8px !important;
                        margin: 5px 0 !important;
                    }
                </style>
            ";
            
            // Add JavaScript to handle upload type dropdown.
            $js = "
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Get the upload type select element.
                        var uploadTypeSelect = document.querySelector('select[name=\"uutype\"]');
                        if (uploadTypeSelect) {
                            // Add warning message near the dropdown.
                            var warningMessage = document.createElement('div');
                            warningMessage.className = 'userlimit-error-message small';
                            warningMessage.innerHTML = " . json_encode($uploadMessage) . ";
                            uploadTypeSelect.parentNode.insertBefore(warningMessage, uploadTypeSelect.nextSibling);

                            // Disable 'Add new only' and 'Add all' options.
                            Array.from(uploadTypeSelect.options).forEach(function(option) {
                                // 0 = Add new only, 2 = Add all / Update if exists
                                if (option.value === '0' || option.value === '2') {
                                    option.disabled = true;
                                }
                            });

                            // If a disabled option is currently selected, change to 'Update existing only'.
                            if (uploadTypeSelect.value === '0' || uploadTypeSelect.value === '2') {
                                uploadTypeSelect.value = '1'; // 1 is typically the value for 'Update existing only'
                            }
                        }
                    });
                </script>
            ";
            
            // Output style and error message.
            echo $style;
            echo \html_writer::div($message, 'userlimit-error-message alert alert-danger');
            echo $js;
        }
    }
}

/**
 * Prevent access to user creation pages
 */
function local_usrctr_after_config() {
    // Check if we're trying to add a new user.
    if (local_usrctr_is_new_user_page()) {
        if (local_usrctr_is_limit_exceeded()) {
            local_usrctr_show_limit_error();
        }
    }
}

/**
 * Extend user navigation.
 *
 * @param \navigation_node $navigation The navigation node to extend
 * @param \stdClass $user The user object
 * @param \context_user $usercontext The user context
 * @param \stdClass $course The course object
 * @param \context_course $coursecontext The course context
 * @return void
 */
function local_usrctr_extend_navigation_user(\navigation_node $navigation, \stdClass $user, \context_user $usercontext, \stdClass $course, \context_course $coursecontext) {
    // If limit exceeded, remove "Add a new user" link.
    if (local_usrctr_is_limit_exceeded()) {
        $nodes = $navigation->get_children_key_list();
        foreach ($nodes as $node) {
            if (strpos($node, 'adduser') !== false) {
                $navigation->remove($node);
            }
        }
    }
}

/**
 * Check before form display
 */
function local_usrctr_before_require_login() {
    // Check if we're trying to add a new user.
    if (local_usrctr_is_new_user_page()) {
        if (local_usrctr_is_limit_exceeded()) {
            local_usrctr_show_limit_error();
        }
    }
}

// Get the current user counter value.
$currentusrctr = $DB->get_field('local_usrctr', 'usrctr', array('id' => 1));