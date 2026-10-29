@extends('admin.layout')

@section('title', 'Data Film')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <b>Data Film ({{ $films->total() }})</b>
      <span class="pull-right">
        <form class="form-inline" method="get" style="display:inline;">
          <input type="text" class="form-control input-sm" name="s" value="{{ request('s') }}" placeholder="Cari judul...">
          <button class="btn btn-default btn-sm" type="submit">Cari</button>
        </form>
        <a href="{{ route('admin.films.create') }}" class="btn btn-primary btn-sm" style="margin-left:8px;"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Film</a>
      </span>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table class="table table-striped table-hover">
        <thead>
          <tr><th></th><th>Judul</th><th>Genre</th><th>Tahun</th><th style="width:170px;">Aksi</th></tr>
        </thead>
        <tbody>
          @forelse ($films as $film)
            <tr>
              <td style="width:46px;"><img class="img-responsive" style="width:42px; height:56px; object-fit:cover;" src="{{ asset($film->poster) }}" alt=""></td>
              <td>{{ $film->title }}</td>
              <td>{{ $film->genre->name ?? '-' }}</td>
              <td>{{ $film->year }}</td>
              <td>
                <a href="{{ route('admin.films.show', $film) }}" class="btn btn-default btn-xs">Lihat</a>
                <a href="{{ route('admin.films.edit', $film) }}" class="btn btn-primary btn-xs">Edit</a>
                <form action="{{ route('admin.films.destroy', $film) }}" method="post" style="display:inline;" onsubmit="return confirm('Hapus film ini beserta kritik & perannya?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-xs" type="submit">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="5">Tidak ada film{{ request('s') ? ' pada pencarian "'.request('s').'"' : '' }}.</td></tr>
          @endforelse
        </tbody>
      </table>
      <div style="text-align:center;">{{ $films->links() }}</div>
    </div>
  </div>
@endsection
