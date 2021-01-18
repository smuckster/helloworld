<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

defined('MOODLE_INTERNAL') || die();

function xmldb_local_helloworld_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2021011700) {

        // Define field userid to be added to local_helloworld.
        $table = new xmldb_table('local_helloworld');
        $field = new xmldb_field('userid', XMLDB_TYPE_INTEGER, '10', null, null, null, null, 'timecreated');

        // Conditionally launch add field userid.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Define key userid-id (foreign) to be added to local_helloworld.
        $table = new xmldb_table('local_helloworld');
        $key = new xmldb_key('userid-id', XMLDB_KEY_FOREIGN, ['userid'], 'user', ['id']);

        // Launch add key userid-id.
        $dbman->add_key($table, $key);

        // Helloworld savepoint reached.
        upgrade_plugin_savepoint(true, 2021011700, 'local', 'helloworld');
    } 

    return true;
}