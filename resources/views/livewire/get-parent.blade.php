<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <table class="table table-striped table-bordered" id="table_id">
                    <thead>
                        <tr class="table-success text-center">
                            <th>#</th>
                            <th>{{ trans('Students_trans.name') }}</th>
                            <th>{{ trans('Parent_trans.Email') }}</th>
                            <th>{{ trans('Parent_trans.Name_Father') }}</th>
                            <th>{{ trans('Parent_trans.National_ID_Father') }}</th>
                            <th>{{ trans('Parent_trans.Phone_Father') }}</th>
                            <th>{{ trans('Parent_trans.Job_Father') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $index => $my_parent)
                            <tr class="text-center">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $my_parent->name }}</td>
                                <td>{{ $my_parent->email }}</td>
                                <td>{{ $my_parent->Parents->name_of_father }}</td>
                                <td>{{ $my_parent->Parents->father_ID }}</td>
                                <td>{{ $my_parent->Parents->father_phone }}</td>
                                <td>{{ $my_parent->Parents->father_job }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No parents found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
