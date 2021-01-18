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

require(__DIR__ . '/../../config.php');

$PAGE->set_context(context_system::instance());
$PAGE->set_url(new moodle_url('/local/helloworld/index.php'));
$PAGE->set_title(get_string('pluginname', 'local_helloworld'));
$PAGE->set_pagelayout('admin');

$name = optional_param('name', get_string('defaultgreeting', 'local_helloworld'), PARAM_ALPHA);
$name = trim($name) == '' ? get_string('defaultgreeting', 'local_helloworld') : $name;

$PAGE->set_heading(get_string('greeting', 'local_helloworld', $name));

echo $OUTPUT->header();

echo html_writer::tag('h1', get_string('greeting', 'local_helloworld', $name));

if($name != 'world') {
    $siteHomeUrl = new moodle_url('/');
    $pluginHomeUrl = new moodle_url('/local/helloworld');

    echo html_writer::start_tag('ul');
    echo html_writer::start_tag('li');
    echo html_writer::link($siteHomeUrl, get_string('backtositehome', 'local_helloworld'));
    echo html_writer::end_tag('li');
    echo html_writer::start_tag('li');
    echo html_writer::link($pluginHomeUrl, get_string('backtopluginhome', 'local_helloworld'));
    echo html_writer::end_tag('li');
    echo html_writer::end_tag('ul');
} else {
    echo html_writer::start_tag('form', [
        'method' => 'get',
        'action' => $PAGE->url,
    ]);
    echo html_writer::label(get_string('nameprompt', 'local_helloworld'), 'name',);
    echo html_writer::tag('br', '');
    echo html_writer::tag('input', '', [
        'type' => 'text',
        'id' => 'name',
        'name' => 'name',
        'placeholder' => get_string('nameplaceholder', 'local_helloworld')
    ]);
    echo html_writer::tag('input', '', [
        'type' => 'submit',
        'value' => get_string('submit')
    ]);
    echo html_writer::end_tag('form');
}

echo $OUTPUT->footer();