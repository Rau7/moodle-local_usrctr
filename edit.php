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
 * Edit page for local_usrctr.
 *
 * @package    local_usrctr
 * @copyright  2024 Alp Toker <tokeralp@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/local/usrctr/classes/local/form/edit.php');

$id = optional_param('id', 0, PARAM_INT);
$returnurl = optional_param('returnurl', '/local/usrctr/manage.php', PARAM_LOCALURL);

require_login();
require_capability('local/usrctr:manage', context_system::instance());

$PAGE->set_context(context_system::instance());
$PAGE->set_url(new moodle_url('/local/usrctr/edit.php', ['id' => $id]));
$PAGE->set_heading($SITE->fullname);
$PAGE->set_title(get_string('edit', 'local_usrctr'));
$PAGE->navbar->add(get_string('pluginname', 'local_usrctr'), new moodle_url('/local/usrctr/manage.php'));
$PAGE->navbar->add(get_string('edit', 'local_usrctr'));

$mform = new \local_usrctr\local\form\edit();

if ($mform->is_cancelled()) {
    redirect(new moodle_url($returnurl));
} else if ($data = $mform->get_data()) {
    // Process form data.
    redirect(new moodle_url($returnurl), get_string('changessaved'));
}

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('edit', 'local_usrctr'));
$mform->display();
echo $OUTPUT->footer();