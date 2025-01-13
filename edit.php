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
 * Edit user counter entry page.
 *
 * @package    local_usrctr
 * @copyright  2024 Alp Toker <tokeralp@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->dirroot.'/local/usrctr/classes/form/edit.php');

global $DB;


$PAGE->set_url(new moodle_url('/local/usrctr/edit.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title('Edit');


if(is_siteadmin()){
	$mform = new edit();



	//Form processing and displaying is done here
	if ($mform->is_cancelled()) {
	    //Handle form cancel operation, if cancel button is present on form
	    
	    redirect($CFG->wwwroot . '/local/usrctr/manage.php', 'Cancelled Counter Update');

	} else if ($fromform = $mform->get_data()) {
	  //In this case you process validated data. $mform->get_data() returns data posted in form.

		$recordtoupdate = new stdClass();
		$recordtoupdate->id = 1;
		$recordtoupdate->usrctr = $fromform->usrctr;
		if($fromform->suspended == ''){
			$recordtoupdate->allow_suspended = 0;
			
		}
		else {
			$recordtoupdate->allow_suspended = 1;
		}
		if($fromform->deleted == ''){
			$recordtoupdate->allow_deleted = 0;
		}
		else {
			$recordtoupdate->allow_deleted = 1;
		}
		

		$DB->update_record('usrctr',$recordtoupdate, $bulk = false);

		redirect($CFG->wwwroot . '/local/usrctr/edit.php', 'User Counter Successfully Set To ' . $fromform->usrctr);
	}

	echo $OUTPUT->header(); 
	$mform->display();
	echo $OUTPUT->footer();

}
else {
	redirect($CFG->wwwroot . '/login/');
}