
@php
    $sid = request()->sid ? '?sid=' . request()->sid : '';
@endphp

@if(isset($viewGate))
@can($viewGate)
    <a class="btn btn-xs btn-primary" href="{{ route( $crudRoutePart . '.show', $row->id . $sid) }}">
        <i title="View" class="fas fa-book"></i>
    </a>
@endcan
@endif

@if(isset($editGate))
@can($editGate)

    <a class="btn btn-xs btn-info" href="{{ route( $crudRoutePart . '.edit', $row->id) }}">
        <i title="Edit" class="fas fa-pencil-alt"></i>
    </a>`
@endcan
@endif

@if(isset($deleteGate))
<!-- @can($deleteGate)
    @php
        $url = isset(request()->test_id) ? route( $crudRoutePart . '.destroy', $row->id . $sid) . '?test_id=1' : route( $crudRoutePart . '.destroy', $row->id . $sid);
    @endphp

    <form action="{{ $url }}" id="{{ $crudRoutePart . $row->id }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
    </form>
@endcan -->
@endif
