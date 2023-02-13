@extends('admin.layouts.main')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Users</h4>
                        <a href="{{ route("users.create") }}" type="submit" class="btn btn-outline-primary add-btn">Add New User</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ isset($user['name']) ? $user['name'] : '' }}</td>
                                    <td>{{ isset($user['email']) ? $user['email'] : '' }}</td>
                                    <td>
                                        @if(isset($user['roles']))
                                            @foreach($user['roles'] as $role)
                                                <span class="badge badge-info">{{ $role['title'] }}</span>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a title='View' href="{{ route('users.show', $user['id']) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-book"></i></a>                                            
                                            <a title='Edit' href="{{ route('users.edit', $user['id']) }}" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>

                                            <form action="{{ route('users.destroy', $user['id']) }}" id="{{ 'users' . $user['id'] }}" method="POST" onsubmit="return confirm('{{ trans('cruds.common.areYouSure') }}');" style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button class="btn btn-danger shadow btn-xs sharp me-1" type="submit"><i class='fa fa-trash'></i></button>                                                                                 </form>
                                        </div>
                                    </td>
                                </tr>                   
                                @endforeach                                                                                           
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('permission_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.permissions.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': "{{ csrf_token() }}"},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'asc' ]],
    pageLength: 10,
  });
  $('.datatable-Permission:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection
