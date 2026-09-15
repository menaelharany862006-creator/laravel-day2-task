@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="mb-4">
        <h1>📋 Database Tables Manager</h1>
        <p class="text-muted">Manage all database tables with full CRUD operations</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
