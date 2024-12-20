<?php
// This file is part of Moodle - http://moodle.org/
//
defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {
    // Create settings page
    $settings = new admin_settingpage('local_usrctr', get_string('pluginname', 'local_usrctr'));
    $ADMIN->add('localplugins', $settings);

    // Add settings
    $settings->add(new admin_setting_configtext(
        'local_usrctr/userlimit',
        get_string('userlimit', 'local_usrctr'),
        get_string('userlimitdesc', 'local_usrctr'),
        1000, // default value
        PARAM_INT
    ));

    $settings->add(new admin_setting_configcheckbox(
        'local_usrctr/include_suspended',
        get_string('include_suspended', 'local_usrctr'),
        get_string('include_suspended_desc', 'local_usrctr'),
        0  // default to unchecked
    ));

    $settings->add(new admin_setting_configcheckbox(
        'local_usrctr/include_deleted',
        get_string('include_deleted', 'local_usrctr'),
        get_string('include_deleted_desc', 'local_usrctr'),
        0  // default to unchecked
    ));
}
