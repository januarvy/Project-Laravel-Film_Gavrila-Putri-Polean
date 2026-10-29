@extends('admin.layout')

@section('title', 'Roles')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <b>Film Roles ({{ $perans->total() }})</b>
      <span class="pull-right">
        <form class="form-inline" method="get" style="display:inline;">
          <input type="text" class="form-control input-sm" name="s" value="{{ request('s') }}" placeholder="Search roles...">
          <button class="btn btn-default btn-sm" type="submit">Search</button>
        </form>
        <a href="{{ route('admin.perans.create') }}" class="btn btn-primary btn-sm" style="margin-left:8px;"><i class="fa fa-plus" aria-hidden="true"></i> Add Film Role</a>
      </span>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table class="table table-striped table-hover">
        <thead>
          <tr><th>Character / Role</th><th>Cast Member</th><th>Film</th><th style="width:130px;">Actions</th></tr>
        </thead>
        <tbody>
          @forelse ($perans as $peran)
            <tr>
              <td>{{ $peran->actor }}</td>
              <td>{{ $peran->cast->name ?? '-' }}</td>
              <td>{{ $peran->film->title ?? '-' }}</td>
              <td>
                <a href="{{ route('admin.perans.edit', $peran) }}" class="btn btn-primary btn-xs">Edit</a>
                <form action="{{ route('admin.perans.destroy', $peran) }}" method="post" style="display:inline;" onsubmit="return confirm('Delete this film role?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-xs" type="submit">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="4">No film roles found.</td></tr>
          @endforelse
        </tbody>
      </table>
      <div class="text-center">{{ $perans->links() }}</div>
    </div>
  </div>
@endsection
