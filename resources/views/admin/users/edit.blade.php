@extends('admin.layout')

@section('title', 'Edit Pengguna')

@section('content')
  <div class="panel panel-default" style="max-width:550px;">
    <div class="panel-heading"><b>Edit Pengguna</b> <a href="{{ route('admin.users.index') }}" class="btn btn-default btn-xs pull-right">&laquo; Kembali</a></div>
    <div class="panel-body">
      <form action="{{ route('admin.users.update', $user) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="name">Nama</label>
          <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
        </div>
        <div class="form-group">
          <label for="phone">Telepon</label>
          <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}" required>
        </div>
        <div class="form-group">
          <label for="role_id">Role</label>
          <select id="role_id" class="form-control" name="role_id" required>
            @foreach ($roles as $role)
              <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
          </select>
        </div>
        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan Perubahan</button>
      </form>
    </div>
  </div>
@endsection
