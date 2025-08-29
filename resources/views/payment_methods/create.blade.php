@extends('layouts.app')

@section('content')
<div class="container">
  <h3>Create Payment Methods</h3>
  <form action="{{ route('payment_methods.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      @error('name')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <button class="btn btn-primary">Save</button>
    <a href="{{ route('payment_methods.index') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection
