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
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('greeting', 'local_helloworld'));

// Initialize controller for handling requests
$controller = new \local_helloworld\controller;

// Process POST request if available
$message = optional_param('message', '', PARAM_TEXT);
if($message != '') {
    $controller->store($message);
}

// Retrieve messages from the database
$messages = $controller->index();

echo $OUTPUT->header();

// Render the message submission form
echo html_writer::start_tag('form', [
    'method' => 'post',
    'action' => $PAGE->url,
]);
echo html_writer::label(get_string('instructions', 'local_helloworld'), 'message');
echo html_writer::tag('br', '');
echo html_writer::tag('textarea', '', [
    'id' => 'message',
    'name' => 'message',
    'class' => 'form-control',
    'style' => 'margin-bottom:1em',
    'placeholder' => get_string('messageplaceholder', 'local_helloworld')
]);
echo html_writer::tag('input', '', [
    'type' => 'submit',
    'value' => get_string('submit'),
    'class' => 'btn btn-secondary',
    'style' => 'margin-bottom:2em'
]);
echo html_writer::end_tag('form');

// Render the messages from the database
echo html_writer::start_div('card-columns');
foreach($messages as $message) {
    $user = $DB->get_record('user', ['id' => $message->userid]);

    echo html_writer::start_div('card');
    echo html_writer::tag('p', $message->message, [
        'class' => 'card-text',
    ]);
    echo html_writer::tag('p', fullname($user), [
        'class' => 'card-attribution'
    ]);
    echo html_writer::tag('p', 'Submitted at ' . userdate($message->timecreated));
}
echo html_writer::end_div();

echo $OUTPUT->footer();