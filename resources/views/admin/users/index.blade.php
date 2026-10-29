@extends('admin.layout')

@section('title', 'Data Pengguna')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <b>Data Pengguna ({{ $users->total() }})</b>
      <form class="form-inline pull-right" method="get">
        <input type="text" class="form-control input-sm" name="s" value="{{ request('s') }}" placeholder="Cari nama/email...">
        <button class="btn btn-default btn-sm" type="submit">Cari</button>
      </form>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table class="table table-striped table-hover">
        <thead>
          <tr><th>Nama</th><th>Email</th><th>Telepon</th><th>Role</th><th style="width:130px;">Aksi</th></tr>
        </thead>
        <tbody>
          @forelse ($users as $user)
            <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->phone ?? '-' }}</td>
              <td><span class="label {{ $user->role_id == 2 ? 'label-danger' : 'label-success' }}">{{ $user->role->name ?? '-' }}</span></td>
              <td>
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-xs">Edit</a>
                <form action="{{ route('admin.users.destroy', $user) }}" method="post" style="display:inline;" onsubmit="return confirm('Hapus pengguna ini beserta kritiknya?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-xs" type="submit">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="5">Belum ada pengguna.</td></tr>
          @endforelse
        </tbody>
      </table>
      <div class="text-center">{{ $users->links() }}</div>
    </div>
  </div>
@endsection
