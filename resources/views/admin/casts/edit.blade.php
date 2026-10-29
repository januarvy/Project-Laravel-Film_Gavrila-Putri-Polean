@extends('admin.layout')

@section('title', 'Edit Cast Member')

@section('content')
  <div class="panel panel-default" style="max-width:550px;">
    <div class="panel-heading"><b>Edit Cast Member</b> <a href="{{ route('admin.casts.index') }}" class="btn btn-default btn-xs pull-right">&laquo; Back to Cast Members</a></div>
    <div class="panel-body">
      <form action="{{ route('admin.casts.update', $cast) }}" method="post">
        @csrf
        @method('PUT')
        @include('admin.casts._form')
        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Changes</button>
      </form>
    </div>
  </div>
@endsection
