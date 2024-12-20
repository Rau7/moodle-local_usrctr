<?php
// This file is part of Moodle - http://moodle.org/
//
defined('MOODLE_INTERNAL') || die();

function xmldb_local_usrctr_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2024011900) {
        // Transfer existing limit to new config
        if ($record = $DB->get_record('usrctr', ['id' => 1])) {
            set_config('userlimit', $record->usrctr, 'local_usrctr');
        }

        // Drop old table if it exists
        $table = new xmldb_table('usrctr');
        if ($dbman->table_exists($table)) {
            $dbman->drop_table($table);
        }

        upgrade_plugin_savepoint(true, 2024011900, 'local', 'usrctr');
    }

    return true;
}
