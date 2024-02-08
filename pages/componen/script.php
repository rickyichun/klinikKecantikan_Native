<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- jQuery UI -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/fullcalendar/main.js"></script>
<!-- PAGE PLUGINS -->
<!-- date-range-picker -->
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- jQuery Mapael -->
<script src="../../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../../plugins/raphael/raphael.min.js"></script>
<script src="../../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../../plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../dist/js/pages/dashboard2.js"></script>
<!-- sweetalert 2 -->
<script src="../../plugins/node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
<!-- selectize -->
<script src="../../plugins/node_modules/@selectize/selectize/dist/js/selectize.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script>
$(document).ready(function() {
    $(".selectize").selectize();
})
</script>

<!-- Page specific script -->
<script>
$(function() {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
        ele.each(function() {

            // create an Event Object (https://fullcalendar.io/docs/event-object)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            }

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject)

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1070,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            })

        })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    // var containerEl = document.getElementById('external-events');
    // var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    // new Draggable(containerEl, {
    //     itemSelector: '.external-event',
    //     eventData: function(eventEl) {
    //         return {
    //             title: eventEl.innerText,
    //             backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue(
    //                 'background-color'),
    //             borderColor: window.getComputedStyle(eventEl, null).getPropertyValue(
    //                 'background-color'),
    //             textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
    //         };
    //     }
    // });


    // data jadwal
    var jadwal = [<?php $jadwal=mysqli_query($conn, "SELECT * from jadwal WHERE status!='cancel' order by id desc"); 
                        while($data=mysqli_fetch_array($jadwal)){
                            if($data['status']=='booked'){
                                $bgcolor='#0073b7';
                            }else if($data['status']=='done'){
                                $bgcolor='#00a65a';
                            }else if($data['status']=='proses'){
                                $bgcolor='#f39c12';
                            };
                            
                            if($data['idpasien']==0){
                                $nomo=$data['nama'];
                            } else { 
                                $idp=$data['idpasien'];
                                $qpasien=mysqli_query($conn, "SELECT * from pasien WHERE id='$idp'"); 
                                $pasien=mysqli_fetch_array($qpasien);
                                $nomo=$pasien['nama'];
                            }
                            
                            ?> {
            title: '<?=$nomo?>',
            start: '<?=$data['tgl']?>',
            backgroundColor: '<?=$bgcolor?>',
            borderColor: '<?=$bgcolor?>',
            allDay: true
        },
        <?php
                        }
    ?>
    ]
    console.log(jadwal);
    var calendar = new Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap',
        //Random default events
        events: jadwal,

    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function(e) {
        e.preventDefault()
        // Save color
        currColor = $(this).css('color')
        // Add color effect to button
        $('#add-new-event').css({
            'background-color': currColor,
            'border-color': currColor
        })
    })
    $('#add-new-event').click(function(e) {
        e.preventDefault()
        // Get value and make sure it is not null
        var val = $('#new-event').val()
        if (val.length == 0) {
            return
        }

        // Create events
        var event = $('<div />')
        event.css({
            'background-color': currColor,
            'border-color': currColor,
            'color': '#fff'
        }).addClass('external-event')
        event.text(val)
        $('#external-events').prepend(event)

        // Add draggable funtionality
        ini_events(event)

        // Remove event from text input
        $('#new-event').val('')
    })
});
</script>
<!-- Page specific script -->
<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
</script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<!-- Page specific script -->
<script>
$(function() {
    bsCustomFileInput.init();
});
</script>
<!-- Alert -->
<?php 
error_reporting(0);
if($_SESSION['alert']=="berhasil"){?>
<script>
Swal.fire({
    icon: 'success',
    title: '<h3 style="color:white">Berhasil!</h3>',
    html: '<h5 style="color:white"><?= $_SESSION["pesan"]?></h5>',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    iconColor: 'white',
    customClass: {
        popup: 'bg-success'
    },
})
</script>
<?php
unset($_SESSION['alert']);
unset($_SESSION['pesan']);
} ?>
<?php
error_reporting(0);
if($_SESSION['alert']=="gagal"){?>
<script>
Swal.fire({
    icon: 'error',
    title: '<h3 style="color:white">Gagal!</h3>',
    html: '<h5 style="color:white"><?= $_SESSION["pesan"]?></h5>',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    iconColor: 'white',
    customClass: {
        popup: 'bg-danger'
    },
})
</script>
<?php
unset($_SESSION['alert']);
unset($_SESSION['pesan']);
} ?>
<?php
error_reporting(0);
if($_SESSION['alert']=="warning"){?>
<script>
Swal.fire({
    icon: 'warning',
    title: '<h3>Peringatan!</h3>',
    html: '<h5><?= $_SESSION["pesan"]?></h5>',
    showConfirmButton: true,
    confirmButtonText: 'Kembali'
})
</script>
<?php
unset($_SESSION['alert']);
unset($_SESSION['pesan']);
} ?>
<?php
error_reporting(0);
if($_SESSION['alert']=="checkin"){?>
<script>
Swal.fire({
    icon: 'warning',
    title: '<h3>Peringatan!</h3>',
    html: '<h5><?= $_SESSION["pesan"]?></h5>',
    showCancelButton: true,
    showConfirmButton: true,
    confirmButtonText: 'Checkin'
}).then(function(result) {
    if (result.isConfirmed) {
        window.location = '../transaksi/inputabsen.php';
    }
})
</script>
<?php
unset($_SESSION['alert']);
unset($_SESSION['pesan']);
} ?>
<?php
error_reporting(0);
if($_SESSION['alert']=="dosis"){?>
<script>
Swal.fire({
    icon: 'warning',
    title: '<h3>Peringatan!</h3>',
    html: '<h5><?= $_SESSION["pesan"]?></h5>',
    showConfirmButton: true,
    confirmButtonText: 'Kembali',
}).then(function(result) {
    window.location = '../transaksi/history_trx.php';
})
</script>
<?php
unset($_SESSION['alert']);
unset($_SESSION['pesan']);
} ?>