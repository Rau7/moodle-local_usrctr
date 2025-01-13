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
 * Form for editing user counter entries.
 *
 * @package    local_usrctr
 * @copyright  2024 Alp Toker <tokeralp@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

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