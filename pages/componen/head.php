<?php 
include "../control/basisdata.php" ;
include "../control/cek-login.php" ;
$fullname = $_SESSION['fullname'];
ini_set('date.timezone', 'Asia/Jakarta'); 
$role= $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klinik Demo</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../dist/img/favicon.ico">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="../../dist/img/favicon.ico">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="../../plugins/fullcalendar/main.css">
    <!-- selectize -->
    <link rel="stylesheet" href="../../plugins/node_modules/@selectize/selectize/dist/css/selectize.bootstrap3.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <style>
    .fc-prev-button,
    .fc-next-button,
    .fc-today-button,
    .fc-dayGridMonth-button,
    .fc-timeGridWeek-button,
    .fc-timeGridDay-button {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }

    .fc-dayGridMonth-button,
    .fc-timeGridWeek-button,
    .fc-timeGridDay-button {
        display: none;
    }

    #calendar {
        height: 100vh;
    }
    </style>

</head>