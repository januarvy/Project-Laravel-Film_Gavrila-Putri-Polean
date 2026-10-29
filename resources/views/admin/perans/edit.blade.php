@extends('admin.layout')

@section('title', 'Edit Film Role')

@section('content')
  <div class="panel panel-default" style="max-width:550px;">
    <div class="panel-heading"><b>Edit Film Role</b> <a href="{{ route('admin.perans.index') }}" class="btn btn-default btn-xs pull-right">&laquo; Back to Roles</a></div>
    <div class="panel-body">
      <form action="{{ route('admin.perans.update', $peran) }}" method="post">
        @csrf
        @method('PUT')
        @include('admin.perans._form')
        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Changes</button>
      </form>
    </div>
  </div>
@endsection
