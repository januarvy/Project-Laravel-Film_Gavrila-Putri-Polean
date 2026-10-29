@extends('admin.layout')

@section('title', 'Cast Members')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <b>Cast Members ({{ $casts->total() }})</b>
      <span class="pull-right">
        <form class="form-inline" method="get" style="display:inline;">
          <input type="text" class="form-control input-sm" name="s" value="{{ request('s') }}" placeholder="Search cast members...">
          <button class="btn btn-default btn-sm" type="submit">Search</button>
        </form>
        <a href="{{ route('admin.casts.create') }}" class="btn btn-primary btn-sm" style="margin-left:8px;"><i class="fa fa-plus" aria-hidden="true"></i> Add Cast Member</a>
      </span>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table class="table table-striped table-hover">
        <thead>
          <tr><th>Name</th><th>Age</th><th>Bio</th><th style="width:130px;">Actions</th></tr>
        </thead>
        <tbody>
          @forelse ($casts as $cast)
            <tr>
              <td>{{ $cast->name }}</td>
              <td>{{ $cast->age }} years</td>
              <td>{{ Str::limit($cast->bio, 50) }}</td>
              <td>
                <a href="{{ route('admin.casts.edit', $cast) }}" class="btn btn-primary btn-xs">Edit</a>
                <form action="{{ route('admin.casts.destroy', $cast) }}" method="post" style="display:inline;" onsubmit="return confirm('Delete this cast member?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-xs" type="submit">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="4">No cast members found.</td></tr>
          @endforelse
        </tbody>
      </table>
      <div class="text-center">{{ $casts->links() }}</div>
    </div>
  </div>
@endsection
