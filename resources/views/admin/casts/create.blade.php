@extends('admin.layout')

@section('title', 'Add Cast Member')

@section('content')
  <div class="panel panel-default" style="max-width:550px;">
    <div class="panel-heading"><b>Add Cast Member</b> <a href="{{ route('admin.casts.index') }}" class="btn btn-default btn-xs pull-right">&laquo; Back to Cast Members</a></div>
    <div class="panel-body">
      <form action="{{ route('admin.casts.store') }}" method="post">
        @csrf
        @include('admin.casts._form')
        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
      </form>
    </div>
  </div>
@endsection
