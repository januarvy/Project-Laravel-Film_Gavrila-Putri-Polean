@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
  <div class="row">
    <div class="col-sm-2 col-xs-6" style="margin-bottom:15px;">
      <div class="panel panel-default" style="text-align:center;">
        <div class="panel-body">
          <h2 style="margin:0;">{{ $counts['films'] }}</h2>
          <p style="margin:0; color:#888;">Film</p>
        </div>
      </div>
    </div>
    <div class="col-sm-2 col-xs-6" style="margin-bottom:15px;">
      <div class="panel panel-default" style="text-align:center;">
        <div class="panel-body">
          <h2 style="margin:0;">{{ $counts['genres'] }}</h2>
          <p style="margin:0; color:#888;">Genre</p>
        </div>
      </div>
    </div>
    <div class="col-sm-2 col-xs-6" style="margin-bottom:15px;">
      <div class="panel panel-default" style="text-align:center;">
        <div class="panel-body">
          <h2 style="margin:0;">{{ $counts['casts'] }}</h2>
          <p style="margin:0; color:#888;">Pemeran</p>
        </div>
      </div>
    </div>
    <div class="col-sm-2 col-xs-6" style="margin-bottom:15px;">
      <div class="panel panel-default" style="text-align:center;">
        <div class="panel-body">
          <h2 style="margin:0;">{{ $counts['users'] }}</h2>
          <p style="margin:0; color:#888;">Pengguna</p>
        </div>
      </div>
    </div>
    <div class="col-sm-2 col-xs-6" style="margin-bottom:15px;">
      <div class="panel panel-default" style="text-align:center;">
        <div class="panel-body">
          <h2 style="margin:0;">{{ $counts['kritiks'] }}</h2>
          <p style="margin:0; color:#888;">Kritik</p>
        </div>
      </div>
    </div>
    <div class="col-sm-2 col-xs-6" style="margin-bottom:15px;">
      <div class="panel panel-warning" style="text-align:center;">
        <div class="panel-body">
          <h2 style="margin:0;">&#9733; {{ $avgRating }}</h2>
          <p style="margin:0; color:#888;">Rata-rata Rating</p>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading"><b>Film Terbaru</b> <a class="btn btn-primary btn-xs pull-right" href="{{ route('admin.films.index') }}">Kelola Film</a></div>
        <div class="panel-body">
          <table class="table table-striped table-hover">
            <thead><tr><th></th><th>Film</th><th>Tahun</th></tr></thead>
            <tbody>
              @forelse ($latestFilms as $film)
                <tr>
                  <td style="width:46px;"><img class="img-responsive" style="width:42px; height:56px; object-fit:cover;" src="{{ asset($film->poster) }}" alt=""></td>
                  <td>{{ $film->title }}</td>
                  <td>{{ $film->year }}</td>
                </tr>
              @empty
                <tr><td colspan="3">Belum ada film.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading"><b>Kritik Terbaru</b> <a class="btn btn-primary btn-xs pull-right" href="{{ route('admin.kritiks.index') }}">Kelola Kritik</a></div>
        <div class="panel-body">
          <table class="table table-striped table-hover">
            <thead><tr><th>Komentar</th><th>Film</th><th>User</th><th>Rating</th></tr></thead>
            <tbody>
              @forelse ($latestKritiks as $kritik)
                <tr>
                  <td>{{ Str::limit($kritik->comment, 40) }}</td>
                  <td>{{ $kritik->film->title ?? '-' }}</td>
                  <td>{{ $kritik->user->name ?? '-' }}</td>
                  <td style="color:#f5a623;">&#9733; {{ $kritik->rating }}</td>
                </tr>
              @empty
                <tr><td colspan="4">Belum ada kritik.</td></tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
