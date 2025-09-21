@extends('Dashboard.layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.list_students')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.list_students')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <!-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#Rollback_All">
                                   {{trans('Students_trans.Rollback')}}
                                </button>
                                <br><br> -->

                                <button  id="Rollback_all_selected" type="submit" class="btn btn-danger" data-toggle="modal"
                                 data-target="#Rollback_All">
                                 {{trans('Students_trans.Rollback')}}
                                </button><br><br><br>


                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);" class="select_promotions"/></th>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{trans('Students_trans.name')}}</th>
                                            <th class="alert-danger">{{trans('Students_trans.old_grade')}}</th>
                                            <th class="alert-danger">{{trans('Students_trans.old_academic')}}</th>
                                            <th class="alert-danger">{{trans('Students_trans.old_classroom')}}</th>
                                            <th class="alert-danger">{{trans('Students_trans.old_section')}}</th>
                                            <th class="alert-success">{{trans('Students_trans.current_grade')}}</th>
                                            <th class="alert-success">{{trans('Students_trans.new_academic')}}</th>
                                            <th class="alert-success">{{trans('Students_trans.current_classroom')}}</th>
                                            <th class="alert-success">{{trans('Students_trans.current_section')}}</th>
                                            <th>{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($promotions as $promotion)
                                            <tr>
                                                <td><input type="checkbox" name="check" id="check1" value="{{$promotion->id}}" class="select_promotion"/></td>
                                                <td>{{ $loop->index+1 }}</td>
                                                <td>{{$promotion->Students->name}}</td>
                                                <td>{{$promotion->From_Grade->name}}</td>
                                                <td>{{$promotion->academic_year}}</td>
                                                <td>{{$promotion->From_Classroom->name}}</td>
                                                <td>{{$promotion->From_Section->section_name}}</td>
                                                <td>{{$promotion->To_Grade->name}}</td>
                                                <td>{{$promotion->academic_year_new}}</td>
                                                <td>{{$promotion->To_Classroom->name}}</td>
                                                <td>{{$promotion->To_Section->section_name}}</td>
                                                <td>
                                                   <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Graduated{{ $promotion->id }}" 
                                                   title="{{trans('Students_trans.Delete')}}">
                                                    {{trans('Students_trans.Graduate')}}</button>
                                                </td>
                                            </tr>



<!-------------------------------------------------- Modal for Graduated student --------------------------------------------->

<div class="modal" id="Graduated{{$promotion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <form class="modal-content" action="{{route('promotions.update','test')}}" method="POST">
            <div class="modal-header" >{{trans('Students_trans.Graduated_student')}}</h1>
            </div>
            <div class="modal-header">                      
                    <h4 class="modal-title">{{trans('Students_trans.Graduated_student')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <p>{{trans('Students_trans.Are you Sure Graduated!?')}}</p>
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="promotion_id"  value="{{$promotion->id}}">
                    <input type="hidden" name="student_id"  value="{{$promotion->Students->id}}">
                    <input type="text" readonly name="student_name"  value="{{$promotion->Students->name}}">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">{{trans('class_trans.close')}}</button>
                <button class="btn btn-danger">{{trans('Students_trans.Graduate')}}</button>
                </div>
            
            
        </form>
        </div>
    </div>
</div>

<!------------------------------------------------------ End modal For Graduated student -------------------------->

                                  
                                        @endforeach
                                    </table>
                                </div>


<!------------------------------------------------------- Modal For Rollback ----------------------------------------------------------->

<div class="modal" id="Rollback_All" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <form class="modal-content" action="{{route('promotions.destroy','test')}}" method="POST">
            <div class="modal-header" >{{trans('Students_trans.Rollback')}}</h1>
            </div>
            <div class="modal-header">                      
                    <h4 class="modal-title">{{trans('Students_trans.Are you Sure!?')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <p>{{trans('Students_trans.Are you Sure!?')}}</p>
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="Rollback_All_id" id="Rollback_All_id" value="">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">{{trans('class_trans.close')}}</button>
                <button class="btn btn-danger" type="submit" onclick>{{trans('Students_trans.Rollback')}}</button>
                </div>
            
            
        </form>
    </div>
</div>


<!----------------------------------------------- End Modal For Rollback ----------------------------------------------------------->


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script>

function check_uncheck_checkbox(isChecked) {
	if(isChecked) {
		$('input[name="check"]').each(function() { 
			this.checked = true; 
		});
	} else {
		$('input[name="check"]').each(function() {
			this.checked = false;
		});
	}
}
</script>

<script type="text/javascript">
    $(function(){
  $("input[type='checkBox']").change(function(){
    var len = $("input[type='checkBox']:checked").length;
    if(len == 0)
      $("button[type='submit']").prop("disabled", true);
    else
      $("button[type='submit']").removeAttr("disabled");
  });
  $("input[type='checkBox']").trigger('change');
});
</script>

<script>
  $(function(){
    $('#Rollback_all_selected').click(function(){
      var selectedItems = new Array();
      $("#datatable input[type='checkbox']:checked").each(function(){
        selectedItems.push(this.value);
      });

      if(selectedItems.length > 0){
        $('input[id="Rollback_All_id"]').val(selectedItems);
      }
    });
  });
</script>
@endsection