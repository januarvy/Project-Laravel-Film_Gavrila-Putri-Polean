@extends('admin.layout')

@section('title', 'Review Moderation')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <b>Review Moderation ({{ $kritiks->total() }})</b>
      <form class="form-inline pull-right" method="get">
        <input type="text" class="form-control input-sm" name="s" value="{{ request('s') }}" placeholder="Search reviews...">
        <button class="btn btn-default btn-sm" type="submit">Search</button>
      </form>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table class="table table-striped table-hover">
        <thead>
          <tr><th>Film</th><th>User</th><th>Review</th><th>Rating</th><th>Date</th><th style="width:80px;">Actions</th></tr>
        </thead>
        <tbody>
          @forelse ($kritiks as $kritik)
            <tr>
              <td>{{ $kritik->film->title ?? '-' }}</td>
              <td>{{ $kritik->user->name ?? '-' }}</td>
              <td>{{ Str::limit($kritik->comment, 60) }}</td>
              <td style="color:#f5a623;">&#9733; {{ $kritik->rating }}</td>
              <td>{{ $kritik->created_at->format('d/m/Y H:i') }}</td>
              <td>
                <form action="{{ route('admin.kritiks.destroy', $kritik) }}" method="post" style="display:inline;" onsubmit="return confirm('Delete this review?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-xs" type="submit">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="6">No reviews found.</td></tr>
          @endforelse
        </tbody>
      </table>
      <div class="text-center">{{ $kritiks->links() }}</div>
    </div>
  </div>
@endsection
