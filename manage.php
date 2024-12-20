<?php

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