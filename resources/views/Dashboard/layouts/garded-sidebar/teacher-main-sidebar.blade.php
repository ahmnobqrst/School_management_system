<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Elements-->
                    <li>
                        <a href="{{ url('/dashboard') }}">
                            <div class="pull-left"><i class="ti-home"></i><span
                                    class="right-nav-text">{{trans('Students_trans.Dashboard_teacher')}}</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>



                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.Grades')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('getgrade')}}">{{trans('sidebar_trans.Grade_list')}}</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.Departments')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('getclasses')}}">{{trans('sidebar_trans.classrooms')}}</a> </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#section-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.Sections')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="section-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('getsections')}}">{{trans('sidebar_trans.Section')}}</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span class="right-nav-text">
                                    {{trans('sidebar_trans.students')}}</span></div>
                            <div class="pull-right">
                                <i class="ti-plus"></i>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="students-menu" class="collapse">
                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse"
                                    data-target="#Student_information">{{trans('sidebar_trans.Student_information')}}
                                    <div class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="Student_information" class="collapse">
                                    <li> <a
                                            href="{{route('getstds')}}">{{trans('sidebar_trans.students_list')}}</a>
                                    </li>
                                </ul>
                            </li>

                            <!-- <li>
                                <a href="javascript:void(0);" data-toggle="collapse"
                                    data-target="#Students_upgrade">{{trans('sidebar_trans.Promotions')}}<div
                                        class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="Students_upgrade" class="collapse">
                                    <li> <a
                                            href="{{route('promotions.index')}}">{{trans('sidebar_trans.Promotions')}}</a>
                                    </li>
                                    <li> <a
                                            href="{{route('promotions.create')}}">{{trans('sidebar_trans.Promotions_management')}}</a>
                                    </li>
                                </ul>
                            </li> -->

                            <!-- <li>
                                <a href="javascript:void(0);" data-toggle="collapse"
                                    data-target="#Graduate students">{{trans('sidebar_trans.Graduate_students')}}<div
                                        class="pull-right"><i class="ti-plus"></i></div>
                                    <div class="clearfix"></div>
                                </a>
                                <ul id="Graduate students" class="collapse">
                                    <li> <a
                                            href="{{route('graduates.create')}}">{{trans('sidebar_trans.add_Graduate')}}</a>
                                    </li>
                                    <li> <a
                                            href="{{route('graduates.index')}}">{{trans('sidebar_trans.list_Graduate')}}</a>
                                    </li>
                                </ul>
                            </li> -->
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#font-icon">
                            <div class="pull-left"><i class="ti-home"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.Parents')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="font-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('add_parent')}}">{{trans('sidebar_trans.Parent_list')}}</a> </li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#custom-page">
                            <div class="pull-left"><i class="ti-file"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.Apperance')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="custom-page" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('attendence')}}">{{trans('sidebar_trans.Apperance_list')}}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#custom-page1">
                            <div class="pull-left"><i class="ti-file"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.Apperance_report')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="custom-page1" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('attendence_section')}}">{{trans('sidebar_trans.Apperance_report')}}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#subject">
                            <div class="pull-left"><i class="ti-file"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.Subject')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="subject" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('getsubject')}}">{{trans('sidebar_trans.subject_list')}}</a> </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#authentication">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.Exams')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="authentication" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('quizz.create')}}">{{trans('sidebar_trans.create_quiz')}}</a> </li>
                            <li> <a href="{{route('quizz.index')}}">{{trans('sidebar_trans.Exam_list')}}</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#questions">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.question')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="questions" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('question_section')}}">{{trans('sidebar_trans.question')}}</a> </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse"
                            data-target="#error">{{trans('sidebar_trans.lecture')}}
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="error" class="collapse">
                            <li> <a href="{{route('online_classes.index')}}">{{trans('sidebar_trans.lecture')}}</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#liberaries">
                            <div class="pull-left"><i class="ti-id-badge"></i><span
                                    class="right-nav-text">{{trans('sidebar_trans.Liberary')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="liberaries" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('liberary.index')}}">{{trans('sidebar_trans.Liberary_book')}}</a>
                            </li>
                            <!-- <li> <a href="{{route('questions.index')}}">{{trans('sidebar_trans.question')}}</a> </li> -->
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Left Sidebar End-->

<!--=================================