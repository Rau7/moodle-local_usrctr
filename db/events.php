<?php
// This file is part of Moodle - http://moodle.org/
//
defined('MOODLE_INTERNAL') || die();

$observers = array(
    array(
        'eventname' => '\core\event\user_created',
        'callback' => '\local_usrctr\observer::user_created',
        'includefile' => '/local/usrctr/classes/observer.php',
        'internal' => false,
        'priority' => 9999,
        'callbackfile' => '/local/usrctr/classes/observer.php'
    ),
    // Kullanıcı oluşturma formundan önce
    array(
        'eventname' => '\core\event\user_created',
        'callback' => '\local_usrctr\observer::user_created',
        'includefile' => '/local/usrctr/classes/observer.php',
        'internal' => true,
        'priority' => 9999,
        'callbackfile' => '/local/usrctr/classes/observer.php'
    ),
    array(
        'eventname' => '\tool_uploaduser\event\user_uploaded',
        'callback' => '\local_usrctr\observer::user_uploaded',
        'includefile' => '/local/usrctr/classes/observer.php',
        'internal' => false,
        'priority' => 9999,
        'callbackfile' => '/local/usrctr/classes/observer.php'
    ),
    array(
        'eventname' => '\core\event\user_created',
        'callback' => '\local_usrctr\observer::user_created',
        'priority' => 9999
    ),
    array(
        'eventname' => '\tool_uploaduser\event\uploaduser_started',
        'callback' => '\local_usrctr\observer::uploaduser_started',
        'priority' => 9999
    ),
    array(
        'eventname' => '\core\event\before_http_headers',
        'callback' => '\local_usrctr\observer::before_http_headers',
        'priority' => 9999
    ),
    array(
        'eventname' => '\core\event\standard_html_head_requested',
        'callback' => '\local_usrctr\observer::before_standard_html_head',
        'priority' => 9999
    )
);
