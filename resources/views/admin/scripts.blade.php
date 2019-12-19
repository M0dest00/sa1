   <script>
  $(document).on('click', '.delete',function(e){
  e.preventDefault();
  var url = ($(this).attr('href'));
    swal({
      title: "Are you sure you want to delete?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#F5D313",
      confirmButtonText: "Yes, delete it!",
      closeOnConfirm: false
    },
         function(){
          window.location=url;
    });
  });
</script>


  <!-- Date and time scripts -->
<script type="text/javascript">
  function DisableSpecificDates(date) {
    var now = new Date();
    if (date < now.setDate(now.getDate() - 1)  ) {
      return true;
    }
    else {
      return false;
    }
  }
  function DisablePreviousDates(date) {
    var now = new Date();
    if (date > now.setDate(now.getDate() - 1)  ) {
      return true;
    }
    else {
      return false;
    }
  }

  $('.datepicker').datepicker({
    autoclose: true,
    autoPick: true,
    format: 'yyyy-mm-dd',
    beforeShowDay: DisableSpecificDates,
  });
  $('.future-datepicker').datepicker({
    autoclose: true,
    autoPick: true,
    format: 'yyyy-mm-dd',
  });

  $(".datetimepicker").datetimepicker({
        format: 'YYYY-MM-DD hh:mm',
        minDate:new Date() ,
        // keepOpen: false,
        // todayBtn: true,
        // pickerPosition: "bottom-left"
    });

  $(".select2").select2();
  $(".datatable").DataTable();
</script>

<script type="text/javascript" src="{{asset('plugins/clockpicker/bootstrap-clockpicker.min.js')}}"></script>
<script>
  var input1 = $('#time_picker');
  input1.clockpicker({
      twelvehour: false,
      donetext: 'Done',
      placement: 'top',
  });
  </script>
  <!-- End Date and Time -->
