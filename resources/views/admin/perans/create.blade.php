@extends('admin.layout')

@section('title', 'Add Film Role')

@section('content')
  <div class="panel panel-default" style="max-width:550px;">
    <div class="panel-heading"><b>Add Film Role</b> <a href="{{ route('admin.perans.index') }}" class="btn btn-default btn-xs pull-right">&laquo; Back to Roles</a></div>
    <div class="panel-body">
      <form action="{{ route('admin.perans.store') }}" method="post">
        @csrf
        @include('admin.perans._form')
        <button class="btn btn-primary" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save</button>
      </form>
    </div>
  </div>
@endsection
