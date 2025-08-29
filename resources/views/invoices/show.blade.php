@extends('layouts.app')

@section('content')
<div class="container">
  <h3>Show Invoices</h3>
  <div class="card">
    <div class="card-body">
      <p><strong>ID:</strong> {{ $item->id }}</p>
      <p><strong>Name/Code:</strong> {{ $item->name ?? $item->code ?? '' }}</p>
      <p><strong>Branch:</strong> {{ $item->branch_id ?? '' }}</p>
    </div>
  </div>
  <a href="{{ route('invoices.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
