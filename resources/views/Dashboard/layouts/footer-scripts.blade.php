<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript"> var plugin_path = '{{asset('assets/js')}}/';</script>

<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>


<script>
    $(document).ready(function() {
        $('#table_id').DataTable();
    } );
</script>

<script>

$('select[name="Grade_id"]').on('change', function () {
    var Grade_id = $(this).val();
   if (Grade_id) {
        $.ajax({
            url: "{{ URL::to('classes') }}/" + Grade_id,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $('select[name="Class_id"]').empty();
                //$('select[name="Class_id"]').append('<option value="Choose">Select State</option>');
                $.each(data, function (key, value) {
                    $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                });
            },
        });
    } else {
      console.log('AJAX load did not work');
    }
});

$('select[name="grade_id"]').on('change', function () {
    var Grade_id = $(this).val();
   if (Grade_id) {
        $.ajax({
            url: "{{ URL::to('classes') }}/" + Grade_id,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $('select[name="classroom_id"]').empty();
                $('select[name="classroom_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                
                $.each(data, function (key, value) {
                    $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                });
            },
        });
    } else {
      console.log('AJAX load did not work');
    }
});

$('select[name="classroom_id"]').on('change', function () {
    var Classroom_id = $(this).val();
   if (Classroom_id) {
        $.ajax({
            url: "{{ URL::to('sections') }}/" + Classroom_id,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $('select[name="section_id"]').empty();
                //$('select[name="Class_id"]').append('<option value="Choose">Select State</option>');
                $('select[name="section_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                $.each(data, function (key, value) {
                    $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                });
            },
        });
    } else {
      console.log('AJAX load did not work');
    }
});

$('select[name="Grade_id_new"]').on('change', function () {
    var Grade_id = $(this).val();
   if (Grade_id) {
        $.ajax({
            url: "{{ URL::to('classes') }}/" + Grade_id,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $('select[name="Classroom_id_new"]').empty();
                $('select[name="Classroom_id_new"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                
                $.each(data, function (key, value) {
                    $('select[name="Classroom_id_new"]').append('<option value="' + key + '">' + value + '</option>');
                });
            },
        });
    } else {
      console.log('AJAX load did not work');
    }
});

$('select[name="Classroom_id_new"]').on('change', function () {
    var Classroom_id = $(this).val();
   if (Classroom_id) {
        $.ajax({
            url: "{{ URL::to('sections') }}/" + Classroom_id,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $('select[name="section_id_new"]').empty();
                //$('select[name="Class_id"]').append('<option value="Choose">Select State</option>');
                $('select[name="section_id_new"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                $.each(data, function (key, value) {
                    $('select[name="section_id_new"]').append('<option value="' + key + '">' + value + '</option>');
                });
            },
        });
    } else {
      console.log('AJAX load did not work');
    }
});






<!-- Js for add Section -->


</script>

