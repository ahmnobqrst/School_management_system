<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="formaddparent" type="button">{{ trans('Parent_trans.Add_parent') }}</button><br><br>

<div class="table-responsive">


<table class="table" class="table table-striped table-dark" id="table_id" >

<thead>
        <tr class="table-success">
            <th>#</th>
            <th>{{ trans('Parent_trans.Email') }}</th>
            <th>{{ trans('Parent_trans.Name_Father') }}</th>
            <th>{{ trans('Parent_trans.National_ID_Father') }}</th>
            <th>{{ trans('Parent_trans.Phone_Father') }}</th>
            <th>{{ trans('Parent_trans.Job_Father') }}</th>
            <th>{{ trans('Parent_trans.Processes') }}</th>
        </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($my_parents as $my_parent)
            <tr>
            <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $my_parent->email }}</td>
                <td>{{ $my_parent->name_of_father }}</td>
                <td>{{ $my_parent->father_ID }}</td>
                <td>{{ $my_parent->father_phone }}</td>
                <td>{{ $my_parent->father_job }}</td>
                <td>
                    <button wire:click="edit({{ $my_parent->id }})" title="{{ trans('grades_trans.Edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $my_parent->id }})" title="{{ trans('grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
</tbody>
</table>
</div>

   

</div>

