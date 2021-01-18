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

/**
 * Insert a link to index.php on the site front navigation menu
 * 
 * @param navigation_node $frontpage Node representing the front page in the navigation tree
 */
function local_helloworld_extend_navigation_frontpage(navigation_node $frontpage) {
    if(get_config('local_helloworld', 'showinnavigation') == 1) {
        $frontpage->add(
            get_string('pluginname', 'local_helloworld'),
            new moodle_url('/local/helloworld/index.php')
        );
    }
}