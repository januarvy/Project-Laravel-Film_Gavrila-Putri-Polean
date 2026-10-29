@extends('admin.layout')

@section('title', 'Detail Film')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <b>Detail Film: {{ $film->title }}</b>
      <span class="pull-right">
        <a href="{{ route('admin.films.edit', $film) }}" class="btn btn-primary btn-xs">Edit</a>
        <a href="{{ route('admin.films.index') }}" class="btn btn-default btn-xs">&laquo; Kembali</a>
      </span>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-sm-3">
          <img class="img-responsive" src="{{ asset($film->poster) }}" alt="">
        </div>
        <div class="col-sm-9">
          <table class="table table-striped">
            <tr><th style="width:110px;">Judul</th><td>{{ $film->title }}</td></tr>
            <tr><th>Genre</th><td>{{ $film->genre->name ?? '-' }}</td></tr>
            <tr><th>Tahun</th><td>{{ $film->year }}</td></tr>
            <tr><th>Sinopsis</th><td>{{ $film->sinopsis }}</td></tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading"><b>Peran Film ({{ $film->perans->count() }})</b></div>
    <div class="panel-body">
      <table class="table table-striped table-hover">
        <thead><tr><th>Peran</th><th>Pemeran</th></tr></thead>
        <tbody>
          @forelse ($film->perans as $peran)
            <tr>
              <td>{{ $peran->actor }}</td>
              <td>{{ $peran->cast->name ?? '-' }}</td>
            </tr>
          @empty
            <tr><td colspan="2">Belum ada peran.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading"><b>Kritik Film ({{ $film->kritiks->count() }})</b></div>
    <div class="panel-body">
      <table class="table table-striped table-hover">
        <thead><tr><th>User</th><th>Komentar</th><th>Rating</th></tr></thead>
        <tbody>
          @forelse ($film->kritiks as $kritik)
            <tr>
              <td>{{ $kritik->user->name ?? '-' }}</td>
              <td>{{ $kritik->comment }}</td>
              <td style="color:#f5a623;">&#9733; {{ $kritik->rating }}</td>
            </tr>
          @empty
            <tr><td colspan="3">Belum ada kritik.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
