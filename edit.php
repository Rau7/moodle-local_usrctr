<?php

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