@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <a href="{{ route('tables.index') }}" class="btn btn-secondary mb-2">
                ← Back to Tables
            </a>

            <h1>
                📄 Table: <code>{{ $tableName }}</code>
            </h1>

            <p class="text-muted">
                {{ $rows->total() }} total records
            </p>

        </div>

        <div>

            <a
                href="{{ route('tables.create', $tableName) }}"
                class="btn btn-success"
            >
                + Add Record
            </a>

            <a
                href="{{ route('tables.export', $tableName) }}"
                class="btn btn-warning"
            >
                📥 Export CSV
            </a>

        </div>

    </div>


    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show">

            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show">

            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>

    @endif


    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">Table Records</h5>
        </div>

        <div class="card-body">

            @if($rows->count() > 0)

                <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead>
                            <tr>

                                @foreach($rows->first()->getAttributes() as $column => $value)

                                    <th>{{ $column }}</th>

                                @endforeach

                                <th>Actions</th>

                            </tr>
                        </thead>

                        <tbody>

                            @foreach($rows as $row)

                                <tr>

                                    @foreach($row->getAttributes() as $value)

                                        <td>
                                            {{ $value }}
                                        </td>

                                    @endforeach

                                    <td>

                                        <a
                                            href="{{ route('tables.edit', [$tableName, $row->id]) }}"
                                            class="btn btn-sm btn-primary"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('tables.destroy', [$tableName, $row->id]) }}"
                                            method="POST"
                                            class="d-inline"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this record?')"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                <div class="mt-3">
                    {{ $rows->links() }}
                </div>

            @else

                <div class="alert alert-info text-center">
                    No records found in this table.
                </div>

            @endif

        </div>

    </div>

</div>

@endsection
