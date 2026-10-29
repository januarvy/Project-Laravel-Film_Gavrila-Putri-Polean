@extends('admin.layout')

@section('title', 'Tambah Genre')

@section('content')
  <div class="panel panel-default" style="max-width:550px;">
    <div class="panel-heading"><b>Tambah Genre</b> <a href="{{ route('admin.genres.index') }}" class="btn btn-default btn-xs pull-right">&laquo; Kembali</a></div>
    <div class="panel-body">
      <form action="{{ route('admin.genres.store') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="name">Nama Genre</label>
          <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>
        </div>
        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
      </form>
    </div>
  </div>
@endsection
