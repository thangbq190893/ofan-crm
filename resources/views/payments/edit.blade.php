@extends('layouts.app')

@section('content')
<div class="container">
  <h3>Edit Payments</h3>
  <form action="{{ route('payments.update', $item->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" value="{{ old('name', $item->name ?? $item->code ?? '') }}" required>
      @error('name')<div class="text-danger">{{ $message }}</div>@enderror
    </div>
    <button class="btn btn-primary">Save</button>
    <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
  </form>
</div>
@endsection
