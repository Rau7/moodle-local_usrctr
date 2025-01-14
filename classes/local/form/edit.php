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
 * Form for editing user counter settings.
 *
 * @package    local_usrctr
 * @copyright  2024 Alp Toker <tokeralp@gmail.com>
 * @license    http://www.gnu.org/licenses/gpl.html GNU GPL v3 or later
 */

namespace local_usrctr\local\form;

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/formslib.php');

/**
 * User counter edit form class.
 */
class edit extends \moodleform {
    /**
     * Form definition.
     */
    protected function definition() {
        global $CFG;
        global $DB;

        $usrctr = $DB->get_records('usrctr')[1];
        $usrctrnumber = $usrctr->usrctr;
        $sus = $usrctr->allow_suspended;
        $del = $usrctr->allow_deleted;

        $mform = $this->_form;

        // Add user counter field.
        $mform->addElement('text', 'usrctrnumber', get_string('usrctrnumber', 'local_usrctr'));
        $mform->setType('usrctrnumber', PARAM_INT);
        $mform->addRule('usrctrnumber', get_string('required'), 'required', null, 'client');

        // Add checkboxes for suspended and deleted users.
        $mform->addElement('advcheckbox', 'suspended', "İptal Edilmiş Kullanıcıları İçersin");
        $mform->setDefault('suspended', $sus);

        $mform->addElement('advcheckbox', 'deleted', "Silinmiş Kullanıcıları İçersin");
        $mform->setDefault('deleted', $del);

        $this->add_action_buttons();
    }

    /**
     * Load in existing data as form defaults.
     *
     * @param \stdClass $defaultvalues Object containing default values
     * @return void
     */
    public function set_data($defaultvalues) {
        if (!empty($defaultvalues->id)) {
            $usrctrnumber = $defaultvalues->usrctrnumber;
            $defaultvalues->usrctrnumber = $usrctrnumber;
        }
        parent::set_data($defaultvalues);
    }

    /**
     * Form validation.
     *
     * @param array $data Array of form data
     * @param array $files Array of form files
     * @return array Array of validation errors
     */
    public function validation($data, $files) {
        return array();
    }
}