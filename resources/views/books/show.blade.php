@extends('layouts.app')

@section('title', 'Detalle del Libro')

@section('content')
<h1 class="mb-4">Detalle del Libro</h1>

<div class="card shadow-sm">
    <div class="card-body">
        <h3 class="card-title">{{ $book->title }}</h3>
        <p class="card-text">
            <strong>Contacto asociado:</strong>
            {{ $book->contact ? $book->contact->name : 'No asignado' }}
        </p>
        <p class="card-text">
            <strong>Creado el:</strong> {{ $book->created_at->format('d/m/Y H:i') }}
        </p>
        <p class="card-text">
            <strong>Última actualización:</strong> {{ $book->updated_at->format('d/m/Y H:i') }}
        </p>

        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning me-2">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Volver al listado</a>
    </div>
</div>
@endsection
