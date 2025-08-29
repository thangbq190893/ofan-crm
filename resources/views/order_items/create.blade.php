@extends('layouts.app')

@section('content')
<div class="container">
  <h3>Create Order Items</h3>
  <form action="{{ route('order_items.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      @error('name')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <button class="btn btn-primary">Save</button>
    <a href="{{ route('order_items.index') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection
