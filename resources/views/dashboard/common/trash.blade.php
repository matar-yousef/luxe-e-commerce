@extends('dashboard.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $title }}</h3>
                <div class="card-tools">
                    <a href="{{ route('dashboard.' . $type . '.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-list"></i> Back to List
                    </a>
                </div>
            </div>

            <div class="card-body table-responsive p-0">
                @if($items->count() > 0)
                <x-table :headers="$headers">
                    @foreach($items as $item)
                    <tr>
                        <td class="text-center align-middle" style="width: 5%">{{ $item->id }}</td>

                        <td class="align-middle" style="width: 45%"><strong>{{ $item->name }}</strong></td>

                        <td class="text-center align-middle" style="width: 20%">
                            <span class="badge badge-light text-danger p-2">
                                {{ $item->deleted_at->format('Y-m-d') }}
                            </span>
                        </td>

                        <td class="text-center align-middle" style="width: 30%">
                            <div class="d-inline-flex">
                                <form action="{{ route('dashboard.' . $type . '.restore', $item->id) }}" method="POST" class="mx-1">
                                    @csrf
                                    <button type="button" class="btn btn-success btn-sm btn-restore">
                                        <i class="fas fa-undo"></i> Restore
                                    </button>
                                </form>

                                <form action="{{ route('dashboard.' . $type . '.forceDelete', $item->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger btn-sm btn-force-delete">
                                        <i class="fas fa-times-circle"></i> Force Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </x-table>
                @else
                <div class="text-center p-5">
                    <i class="fas fa-trash fa-5x text-gray-200 mb-3"></i>
                    <h4 class="text-muted">Your trash is empty!</h4>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    $(document).ready(function() {
        $('.btn-restore').click(function(e) {
            let form = $(this).closest('form');
            Swal.fire({
                title: 'Restore this item?',
                text: "It will be moved back to the active list.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, restore it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        $('.btn-force-delete').click(function(e) {
            let form = $(this).closest('form');
            Swal.fire({
                title: 'Are you absolutely sure?',
                text: "This action is permanent and cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete forever!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush

@endsection