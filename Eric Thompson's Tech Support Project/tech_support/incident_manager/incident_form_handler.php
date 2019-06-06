<?php

include '../model/database.php';
require('../model/incident_db.php');

$action = filter_input(INPUT_POST, 'action');

if ($action == 'edit_incident') {
    $incident['incidentID'] = filter_input(INPUT_POST, 'incidentID');
    $incident['customerID'] = filter_input(INPUT_POST, 'customerID');
    $incident['productCode'] = filter_input(INPUT_POST, 'productCode');
    $incident['techID'] = filter_input(INPUT_POST, 'techID');
    $incident['dateOpened'] = filter_input(INPUT_POST, 'dateOpened');
    $incident['dateClosed'] = filter_input(INPUT_POST, 'dateClosed');
    $incident['title'] = filter_input(INPUT_POST, 'title');
    $incident['description'] = filter_input(INPUT_POST, 'description');

    edit_incident($incident['incidentID'], $incident['customerID'], $incident['productCode'], $incident['techID'], $incident['dateOpened'], $incident['dateClosed'], $incident['title'], $incident['description']);
}

if ($action == 'technician_edit_incident') {
    $incident['incidentID'] = filter_input(INPUT_POST, 'incidentID');
    $incident['customerID'] = filter_input(INPUT_POST, 'customerID');
    $incident['productCode'] = filter_input(INPUT_POST, 'productCode');
    $incident['techID'] = filter_input(INPUT_POST, 'techID');
    $incident['dateOpened'] = filter_input(INPUT_POST, 'dateOpened');
    $incident['dateClosed'] = filter_input(INPUT_POST, 'dateClosed');
    $incident['title'] = filter_input(INPUT_POST, 'title');
    $incident['description'] = filter_input(INPUT_POST, 'description');

    technician_edit_incident($incident['incidentID'], $incident['customerID'], $incident['productCode'], $incident['techID'], $incident['dateOpened'], $incident['dateClosed'], $incident['title'], $incident['description']);
}

if ($action == 'add_incident') {
    $email = filter_input(INPUT_POST, 'email');
    $incident['incidentID'] = filter_input(INPUT_POST, 'incidentID');
    $incident['customerID'] = get_customerID_by_email($email);
    $incident['productCode'] = filter_input(INPUT_POST, 'productCode');
    $incident['techID'] = filter_input(INPUT_POST, 'techID');
    $incident['dateOpened'] = filter_input(INPUT_POST, 'dateOpened');
    $incident['dateClosed'] = filter_input(INPUT_POST, 'dateClosed');
    $incident['title'] = filter_input(INPUT_POST, 'title');
    $incident['description'] = filter_input(INPUT_POST, 'description');

    add_incident($incident['incidentID'], $incident['customerID'], $incident['productCode'], $incident['techID'], $incident['dateOpened'], $incident['dateClosed'], $incident['title'], $incident['description']);
}

if ($action == 'technician_add_incident') {
    $email = filter_input(INPUT_POST, 'email');
    $incident['incidentID'] = filter_input(INPUT_POST, 'incidentID');
    $incident['customerID'] = get_customerID_by_email($email);
    $incident['productCode'] = filter_input(INPUT_POST, 'productCode');
    $incident['techID'] = filter_input(INPUT_POST, 'techID');
    $incident['dateOpened'] = filter_input(INPUT_POST, 'dateOpened');
    $incident['dateClosed'] = filter_input(INPUT_POST, 'dateClosed');
    $incident['title'] = filter_input(INPUT_POST, 'title');
    $incident['description'] = filter_input(INPUT_POST, 'description');

    technician_add_incident($incident['incidentID'], $incident['customerID'], $incident['productCode'], $incident['techID'], $incident['dateOpened'], $incident['dateClosed'], $incident['title'], $incident['description']);
}

if ($action == 'assign_to_tech') {
    $incident['incidentID'] = filter_input(INPUT_POST, 'incidentID');
    $incident['techID'] = filter_input(INPUT_POST, 'techID');

    assign_to_tech($incident['incidentID'], $incident['techID']);
}

if ($action == 'unassign_to_tech') {
    $incident['incidentID'] = filter_input(INPUT_POST, 'incidentID');

    unassign_to_tech($incident['incidentID']);
}

if ($action == 'delete_incident') {
    $incident['incidentID'] = filter_input(INPUT_POST, 'incidentID');

    delete_incident($incident['incidentID']);
}