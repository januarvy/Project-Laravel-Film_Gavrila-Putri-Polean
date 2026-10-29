@extends('admin.layout')

@section('title', 'Edit Film')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading"><b>Edit Film: {{ $film->title }}</b> <a href="{{ route('admin.films.index') }}" class="btn btn-default btn-xs pull-right">&laquo; Kembali</a></div>
    <div class="panel-body">
      <form action="{{ route('admin.films.update', $film) }}" method="post" enctype="multipart/form-data" class="form-horizontal" style="max-width:650px;">
        @csrf
        @method('PUT')
        @include('admin.films._form')
        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan Perubahan</button>
      </form>
    </div>
  </div>
@endsection
