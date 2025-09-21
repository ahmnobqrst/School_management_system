@extends('Dashboard.layouts.master')
@section('css')
<link rel="stylesheet" type="text/css" href="extensions/filter-control/bootstrap-table-filter-control.css">
@section('title')
{{trans('sidebar_trans.class_list')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="mb-0">{{trans('class_trans.classrooms')}}</h4>
        </div>
        <div class="col-sm-12">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{route('classrooms.index')}}" class="default-color">{{trans('Students_trans.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('sidebar_trans.class_list')}}</li>
            </ol>
        </div>
    </div>
</div>
@if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                           <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
             @endif

<!-- breadcrumb -->

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  {{trans('class_trans.add_classroom')}}
</button>


<button  id="delete_all_selected" type="submit" class="btn btn-danger" data-toggle="modal"
         data-target="#Delete_all">
{{trans('class_trans.remove_more_class')}}</button><br><br><br>





<!-- row -->

<!-- the form to filter the grade -->

<form action="{{route('filter_grade')}}" method="POST">
  {{csrf_field()}}


<select name="Grade_id" id="Grade_id"  class="form" required onchange="this.form.submit()" >
     <option value="" selected disabled>{{trans('class_trans.search_by_grade')}}</option>
       @foreach($grades as $grade)
          <option value="{{$grade->id}}">{{$grade->name}}</option>
       @endforeach
</select>

</form>

<!-- the form to filter the grade -->


<!-- Modal -->


<div class="table-responsive">


<table id="table_id" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">

  <thead>
    <tr>

     <th><input type="checkbox" name="checkall" id="checkall" onClick="check_uncheck_checkbox(this.checked);" class="select_classses"/></th>
  <!-- ده معناه ان انا اول ما اضغط عليه يعلم عليهم كلهم واول ما ادوس -->
      <th scope="col">#</th>
      <th scope="col">{{trans('class_trans.class_name')}}</th>
      <th scope="col">{{trans('class_trans.class_description')}}</th>
      <th scope="col">{{trans('class_trans.grade_name')}}</th>
      <th scope="col">{{trans('class_trans.Actions')}}</th>
    </tr>
  </thead>
  <tbody>

  @if(isset($details))

     <?php $list_classes =  $details; ?>

  @else
   
  <?php $list_classes =  $myclass; ?>

  @endif

  
  @if (is_array($list_classes) || is_object($list_classes))
    @foreach($list_classes as $myclasses)
    
    <tr>
      <td><input type="checkbox" name="check" id="check1" value="{{$myclasses->id}}" class="select_classes"/></td>
      <td scope="row">{{$myclasses->id}}</td>
      <td>{{$myclasses->name}}</td>
      <td>{{$myclasses->desc}}</td>
      <td>{{$myclasses->grades->name}}</td>
      <td>

        <a href="{{route('classrooms.edit',$myclasses)}}" class="edit btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
        <a href="{{route('delete.class',$myclasses->id)}}"  class="btn btn-danger" >{{trans('class_trans.Delete')}}</i></a>

      </td>

    </tr>
   
    @endforeach
  @endif
  </tbody>
</table>
</div>








@endsection


<!-- to add classroom -->
<div class="modal" tabindex="-1" role="dialog" id="exampleModal">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{trans('class_trans.class_list')}}</h5>
      </div>
      <div class="modal-body">
      <form class="form repeater-default" action="{{route('classrooms.store')}}" method="Post">
        @csrf
  <div data-repeater-list="class_list">
    <div data-repeater-item>
      <div class="row justify-content-between">
        <div class="col-md-6 col-sm-12 form-group">
          <label for="name_ar">{{trans('class_trans.class_name_ar')}} </label>
          <input type="text" class="form-control" name="name_ar" placeholder="{{trans('class_trans.class_name_ar')}}">
          @error('name_ar')
            <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
          @enderror 
        </div>
        <div class="col-md-6 col-sm-12 form-group">
          <label for="name_en">{{trans('class_trans.class_name_en')}} </label>
          <input type="text" class="form-control" name="name_en" placeholder="{{trans('class_trans.class_name_en')}}">
          @error('name_en')
            <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
          @enderror 
        </div>
        <div class="col-md-6 col-sm-12 form-group">
          <label for="description">{{trans('class_trans.class_description_ar')}}</label>
          <input type="text" class="form-control" name="desc_ar" placeholder="{{trans('class_trans.class_description_ar')}}">
          @error('desc_ar')
            <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
          @enderror 
        </div>
        <div class="col-md-6 col-sm-12 form-group">
          <label for="description">{{trans('class_trans.class_description_en')}}</label>
          <input type="text" class="form-control" name="desc_en" placeholder="{{trans('class_trans.class_description_en')}}">
          @error('desc_en')
            <span class="alert alert-danger alert-dismissible">{{ $message }}</span>
          @enderror 
        </div>
        <div class="col-md-6 col-sm-12 form-group">
          <label for="gender">{{trans('class_trans.grade_name')}}</label>
        
          <select name="grade_id" id="grade_id" class="form-control">
          @foreach($grades as $grade)
            <option value="{{$grade->id}}">{{$grade->name}}</option>
            @endforeach
          </select>
          
        </div>
        
        <div class="col-md-6 col-sm-12 form-group">
        <label for="description">{{trans('class_trans.Operation')}}:</label><br>
          <button class="btn btn-danger" data-repeater-delete type="button"> <i class="bx bx-x"></i>
          {{trans('class_trans.Delete')}}
          </button>
        </div>
      </div>
      <hr>
    </div>
  </div>
  <div class="form-group">
    <div class="col p-0">
      <button class="btn btn-primary" data-repeater-create type="button"><i class="bx bx-plus"></i>
        {{trans('class_trans.add')}}
      </button>
    </div>
  </div>

        
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">{{trans('class_trans.submit')}}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('class_trans.close')}}</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- to choose more than one elements -->


<div class="modal" id="Delete_all" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <form class="modal-content" action="{{route('delete_all')}}" method="POST">
            <div class="modal-header" >{{trans('class_trans.delete_all_classroom')}}</h1>
            </div>
            <div class="modal-header">                      
                    <h4 class="modal-title">{{trans('class_trans.delete_all_classroom')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <p>{{trans('class_trans.sure_delete_all')}}</p>
                    @csrf
                    <input type="hidden" name="delete_all_id" id="delete_all_id" value="">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">{{trans('class_trans.close')}}</button>
                <button class="btn btn-danger" type="submit" onclick>{{trans('class_trans.Delete_all')}}</button>
                </div>
            
            
        </form>
    </div>
</div>


@push('js')

<script src="extensions/filter-control/bootstrap-table-filter-control.js"></script>
<script>
$('.repeater-default').repeater({
  show: function () {
    $(this).slideDown();
  },
  hide: function (deleteElement) {
    if (confirm('Are you sure you want to delete this element?')) {
      $(this).slideUp(deleteElement);
    }
  }
});



</script>


@endpush


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



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

<!----------------------------- js for delete all classes that you choosed ---------------------->

<!-- <script>
$('#table_id tbody').on('click','#delete_all',function(argument){
   var selectItems = [];
   $('.select_classses:checked').each(function(){
    selectItems.push($(this).val());
   });

   if(selectItems.length === 0){
    alert('please select at least one item');
   }else{
    $('#delete_all_id').val(selectItems.join(','));
   }
 
})

</script> -->

<script>
  $(function(){
    $('#delete_all_selected').click(function(){
      var selectedItems = new Array();
      $("#table_id input[type='checkbox']:checked").each(function(){
        selectedItems.push(this.value);
      });

      if(selectedItems.length > 0){
        $('input[id="delete_all_id"]').val(selectedItems);
      }
    });
  });
</script>



<!----------------------------- js for End Delete all classes that you choosed ---------------------->



