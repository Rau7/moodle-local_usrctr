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
 * Manage user counter entries page.
 *
 * @package    local_usrctr
 * @copyright  2024 Alp Toker <tokeralp@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
global $DB;

        
$PAGE->set_url(new moodle_url('/local/usrctr/manage.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Change User Count');

$usrctr_number = $DB->get_records('usrctr')[1]->usrctr;


echo $OUTPUT->header();

$templatecontext = (object)[
	'heading' => 'Change User Limit',
	'explanation' => 'Limit # of users that can enter the platform',
	'user_counter' => $usrctr_number,
	'edit_url' => new moodle_url('/local/usrctr/edit.php'),
];

echo $OUTPUT->render_from_template('local_usrctr/usrctr', $templatecontext);

echo $OUTPUT->footer();