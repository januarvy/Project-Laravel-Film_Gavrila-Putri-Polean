@extends('admin.layout')

@section('title', 'Tambah Film')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading"><b>Tambah Film</b> <a href="{{ route('admin.films.index') }}" class="btn btn-default btn-xs pull-right">&laquo; Kembali</a></div>
    <div class="panel-body">
      <form action="{{ route('admin.films.store') }}" method="post" enctype="multipart/form-data" class="form-horizontal" style="max-width:650px;">
        @csrf
        @include('admin.films._form')
        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
      </form>
    </div>
  </div>
@endsection
