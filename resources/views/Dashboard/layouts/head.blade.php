<!-- Title -->
<title>@yield("title")</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon" />

<!-- Font -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

<link href="{{ URL::asset('css/wizard.css') }}" rel="stylesheet" id="bootstrap-css">



<link href="{{ URL::asset('css/wizard.css') }}" rel="stylesheet">
<style>
.language-dropdown .dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 6px 12px;
    border-radius: 30px;
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    transition: all 0.3s ease-in-out;
}

.language-dropdown .dropdown-toggle:hover {
    background-color: rgb(12, 130, 248);
}

.language-dropdown .dropdown-menu {
    min-width: 180px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    padding: 8px 0;
}

.language-dropdown .dropdown-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    font-size: 14px;
    transition: background-color 0.2s;
}

.language-dropdown .dropdown-item:hover {
    background-color: #f1f1f1;
}

.language-dropdown img {
    border-radius: 4px;
}

.lang {
    color: black;
}
</style>



@yield('css')
<!--- Style css -->


<style>
th,
td,
th {
    border-color: #96D4D4;
    width: 200px;
}
</style>

<!--- Style css -->
@if (App::getLocale() == 'en')
<link href="{{ URL::asset('assets/css/ltr.css') }}" rel="stylesheet">
@else
<link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">
@endif

<!-- @section('js')
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap4.min.js"></script>
    <script>
      // $(document).ready(function(){
      //     $('#table_id').DataTable({
      //       processing: true,
      //     });
      //   });
    </script>
@endsection -->