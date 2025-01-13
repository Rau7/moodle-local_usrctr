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
 * Event observers used in user counter.
 *
 * @package    local_usrctr
 * @copyright  2024 Alp Toker <tokeralp@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$observers = array(
    array(
        'eventname' => '\core\event\user_created',
        'callback' => '\local_usrctr\observer::user_created',
        'includefile' => '/local/usrctr/classes/observer.php',
        'internal' => false,
        'priority' => 9999,
        'callbackfile' => '/local/usrctr/classes/observer.php'
    ),
    // Kullanıcı oluşturma formundan önce
    array(
        'eventname' => '\core\event\user_created',
        'callback' => '\local_usrctr\observer::user_created',
        'includefile' => '/local/usrctr/classes/observer.php',
        'internal' => true,
        'priority' => 9999,
        'callbackfile' => '/local/usrctr/classes/observer.php'
    ),
    array(
        'eventname' => '\tool_uploaduser\event\user_uploaded',
        'callback' => '\local_usrctr\observer::user_uploaded',
        'includefile' => '/local/usrctr/classes/observer.php',
        'internal' => false,
        'priority' => 9999,
        'callbackfile' => '/local/usrctr/classes/observer.php'
    ),
    array(
        'eventname' => '\core\event\user_created',
        'callback' => '\local_usrctr\observer::user_created',
        'priority' => 9999
    ),
    array(
        'eventname' => '\tool_uploaduser\event\uploaduser_started',
        'callback' => '\local_usrctr\observer::uploaduser_started',
        'priority' => 9999
    ),
    array(
        'eventname' => '\core\event\before_http_headers',
        'callback' => '\local_usrctr\observer::before_http_headers',
        'priority' => 9999
    ),
    array(
        'eventname' => '\core\event\standard_html_head_requested',
        'callback' => '\local_usrctr\observer::before_standard_html_head',
        'priority' => 9999
    )
);
