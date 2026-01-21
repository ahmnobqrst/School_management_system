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
$(document).ready(function () {
    $('select[name="Grade_id"]').on('change', function () {
        var grade_id = $(this).val();

        if (grade_id) {
            $.ajax({
                url: "{{ url('get-classes') }}/" + grade_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="Class_id"]').empty();
                    $('select[name="Class_id"]').append('<option disabled selected>{{trans('Parent_trans.Choose')}}..</option>');
                    $.each(data, function (key, value) {
                        $('select[name="Class_id"]').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        } else {
            $('select[name="Class_id"]').empty();
            $('select[name="teacher_id[]"]').empty();
        }
    });

    $('select[name="Class_id"]').on('change', function () {
        var class_id = $(this).val();

        if (class_id) {
            $.ajax({
                url: "{{ url('teachers-section') }}/" + class_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('select[name="teacher_id[]"]').empty();
                    $('select[name="teacher_id[]"]').append('<option disabled selected>{{trans('Parent_trans.Choose')}}..</option>');
                    $.each(data, function (key, value) {
                        $('select[name="teacher_id[]"]').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        } else {
            $('select[name="Class_id"]').empty();
            $('select[name="teacher_id[]"]').empty();
        }
    });
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

$(document).ready(function() {
    $('select[name="grad_id"]').on('change', function() {
        var Grade_id = $(this).val();
        if (Grade_id) {
            $.ajax({
                url: "{{ URL::to('teacher/dashboard/classes_for_grade') }}/" + Grade_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="class_id"]').empty();
                    $('select[name="class_id"]').append("<option selected disabled >{{trans('Students_trans.Choose')}}...</option>");
                    $.each(data, function(key, value) {
                        $('select[name="class_id"]').append('<option value="' +
                            key + '">' + value + '</option>');
                            console.log("this is id For Classroom : ",key);
                    });
                },
            });
            
        } else {
            console.log('AJAX load did not work');
        }
    });
});

$('select[name="class_id"]').on('change', function() {
    var Classroom_id = $(this).val();
    if (Classroom_id) {
        $.ajax({
            url: "{{ URL::to('teacher/dashboard/sections_for_grade') }}/" + Classroom_id,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('select[name="sect_id"]').empty();
                // $('select[name="Class_id"]').append('<option value="Choose">Select State</option>');
                $('select[name="sect_id"]').append("<option selected disabled >{{trans('Students_trans.Choose')}}...</option>");
                $.each(data, function(key, value) {
                    $('select[name="sect_id"]').append('<option value="' + key + '">' +
                        value + '</option>');
                });
            },
        });
    } else {
        console.log('AJAX load did not work');
    }
});


$(document).ready(function() {
    $('select[name="grade_id"]').on('change', function() {
        var Grade_id = $(this).val();
        if (Grade_id) {
            $.ajax({
                url: "{{ URL::to('classes') }}/" + Grade_id,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('select[name="classroom_id"]').empty();
                    $('select[name="classroom_id"]').append("<option selected disabled >{{trans('Students_trans.Choose')}}...</option>");
                    $.each(data, function(key, value) {
                        $('select[name="classroom_id"]').append('<option value="' +
                            key + '">' + value + '</option>');
                            console.log("this is id For Classroom : ",key);
                    });
                },
            });
            
        } else {
            console.log('AJAX load did not work');
        }
    });
});

$('select[name="classroom_id"]').on('change', function() {
    var Classroom_id = $(this).val();
    if (Classroom_id) {
        $.ajax({
            url: "{{ URL::to('sections') }}/" + Classroom_id,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $('select[name="section_id"]').empty();
                // $('select[name="Class_id"]').append('<option value="Choose">Select State</option>');
                $('select[name="section_id"]').append("<option selected disabled >{{trans('Students_trans.Choose')}}...</option>");
                $.each(data, function(key, value) {
                    $('select[name="section_id"]').append('<option value="' + key + '">' +
                        value + '</option>');
                });
            },
        });
    } else {
        console.log('AJAX load did not work');
    }
});



</script>

