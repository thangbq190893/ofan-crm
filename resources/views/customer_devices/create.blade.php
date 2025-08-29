@extends('layouts.app')

@section('content')
<div class="container">
  <h3>Create Customer Devices</h3>
  <form action="{{ route('customer_devices.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      @error('name')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <button class="btn btn-primary">Save</button>
    <a href="{{ route('customer_devices.index') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection
