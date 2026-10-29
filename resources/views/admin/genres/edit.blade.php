@extends('admin.layout')

@section('title', 'Edit Genre')

@section('content')
  <div class="panel panel-default" style="max-width:550px;">
    <div class="panel-heading"><b>Edit Genre</b> <a href="{{ route('admin.genres.index') }}" class="btn btn-default btn-xs pull-right">&laquo; Kembali</a></div>
    <div class="panel-body">
      <form action="{{ route('admin.genres.update', $genre) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="name">Nama Genre</label>
          <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $genre->name) }}" required>
        </div>
        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan Perubahan</button>
      </form>
    </div>
  </div>
@endsection
