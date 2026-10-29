@extends('admin.layout')

@section('title', 'Data Genre')

@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <b>Data Genre</b>
      <a href="{{ route('admin.genres.create') }}" class="btn btn-primary btn-sm pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Tambah Genre</a>
      <div class="clearfix"></div>
    </div>
    <div class="panel-body">
      <table class="table table-striped table-hover">
        <thead>
          <tr><th style="width:70px;">ID</th><th>Nama</th><th>Jumlah Film</th><th style="width:130px;">Aksi</th></tr>
        </thead>
        <tbody>
          @forelse ($genres as $genre)
            <tr>
              <td>{{ $genre->id }}</td>
              <td>{{ $genre->name }}</td>
              <td>{{ $genre->films_count }}</td>
              <td>
                <a href="{{ route('admin.genres.edit', $genre) }}" class="btn btn-primary btn-xs">Edit</a>
                <form action="{{ route('admin.genres.destroy', $genre) }}" method="post" style="display:inline;" onsubmit="return confirm('Hapus genre ini?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-xs" type="submit">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="4">Belum ada genre.</td></tr>
          @endforelse
        </tbody>
      </table>
      <div class="text-center">{{ $genres->links() }}</div>
    </div>
  </div>
@endsection
