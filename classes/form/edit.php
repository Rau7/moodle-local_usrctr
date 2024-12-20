<?php

//moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");

class edit extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
        global $DB;

        $usrctr = $DB->get_records('usrctr')[1];
        $usrctr_number = $usrctr->usrctr;
        $sus = $usrctr->allow_suspended;
        $del = $usrctr->allow_deleted;
        

        $mform = $this->_form; // Don't forget the underscore! 

        $mform->addElement('text', 'usrctr', 'User Counter'); // Add elements to your form.
        $mform->setType('usrctr', PARAM_INT);                   // Set type of element.
        $mform->setDefault('usrctr', $usrctr_number);        // Default value.

        $mform->addElement('checkbox', 'suspended', "İptal Edilmiş Kullanıcıları İçersin");
        $mform->setDefault('suspended', $sus); 

        $mform->addElement('checkbox', 'deleted', "Silinmiş Kullanıcıları İçersin");
        $mform->setDefault('deleted', $del); 

        $this->add_action_buttons();
        
    }
    //Custom validation should be added here
    function validation($data, $files) {
        return array();
    }
}