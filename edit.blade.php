@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <a href="{{ route('tables.show', $tableName) }}" class="btn btn-secondary mb-3">← Back</a>

            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h4>✏️ Edit Record in <code>{{ $tableName }}</code></h4>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Validation Errors:</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tables.update', [$tableName, $id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @foreach ($columns as $column)
                            <div class="mb-3">
                                <label for="{{ $column }}" class="form-label">
                                    {{ ucfirst(str_replace('_', ' ', $column)) }}
                                </label>

                                <input
                                    type="text"
                                    name="{{ $column }}"
                                    id="{{ $column }}"
                                    class="form-control"
                                    value="{{ old($column, $record->$column ?? '') }}"
                                >
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-warning">
                            💾 Update Record
                        </button>

                        <a href="{{ route('tables.show', $tableName) }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
