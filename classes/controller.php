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

namespace local_helloworld;

/**
 * Controller class for incoming requests to Hello World plugin
 * 
 * @package     local_helloworld
 * @copyright   2021 onwards Sam Smucker
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class controller {
    /**
     * Retrieve all messages from the database
     * 
     * @return array An array of message objects
     */
    public function index() {
        global $DB;

        $records = $DB->get_records('local_helloworld');

        return $records;
    }

    /**
     * Store a submitted message in the database
     * 
     * @param string $message The message to be stored
     */
    public function store($message) {
        global $DB, $USER;

        $record = new \stdClass();
        $record->message = $message;
        $record->timecreated = time();
        $record->userid = $USER->id;

        $DB->insert_record('local_helloworld', $record);
    }
}

