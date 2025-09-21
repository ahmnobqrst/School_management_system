<div class="container-fluid">
    <div class="row">

        @if(Auth('web')->check())
        @include('Dashboard.layouts.garded-sidebar.admin-main-sidebar')
        @endif

        @if(Auth('teacher')->check())
        @include('Dashboard.layouts.garded-sidebar.teacher-main-sidebar')
        @endif

        @if(Auth('student')->check())
        @include('Dashboard.layouts.garded-sidebar.student-main-sidebar')
        @endif

        @if(Auth('parent')->check())
        @include('Dashboard.layouts.garded-sidebar.parent-main-sidebar')
        @endif

    </div>
</div>
<!-- Left Sidebar End-->

<!--=================================