@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="mb-0">Customer Devices</h3>
    <a href="{{ route('customer_devices.create') }}" class="btn btn-primary">Create</a>
  </div>
  @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
  <table class="table table-striped">
    <thead><tr><th>ID</th><th>Name</th><th>Branch</th><th>Actions</th></tr></thead>
    <tbody>
      @foreach($items as $item)
      <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->name ?? ($item->code ?? '') }}</td>
        <td>{{ $item->branch_id ?? '' }}</td>
        <td>
          <a href="{{ route('customer_devices.show', $item->id) }}" class="btn btn-sm btn-info">Show</a>
          <a href="{{ route('customer_devices.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('customer_devices.destroy', $item->id) }}" method="POST" style="display:inline">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $items->links() }}
</div>
@endsection
