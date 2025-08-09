@extends('layouts.app')

@section('title', 'Listado de Libros')

@section('content')
<h1 class="mb-4">Listado de Libros</h1>

@if($books->isEmpty())
    <p class="text-muted">No hay libros registrados todavía.</p>
    <a href="{{ route('books.create') }}" class="btn btn-primary">Crear Primer Libro</a>
@else
<table class="table table-striped table-hover align-middle">
    <thead class="table-primary">
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Contacto Asociado</th>
            <th>Creado</th>
            <th class="text-end">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($books as $book)
        <tr>
            <td>{{ $book->id }}</td>
            <td>
                <a href="{{ route('books.show', $book) }}" class="text-decoration-none">
                    {{ $book->title }}
                </a>
            </td>
            <td>{{ $book->contact ? $book->contact->name : '-' }}</td>
            <td>{{ $book->created_at->format('d/m/Y') }}</td>
            <td class="text-end">
                <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-outline-warning me-2" title="Editar">
                    <i class="bi bi-pencil"></i> Editar
                </a>

                <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('¿Seguro que quieres eliminar este libro?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                        <i class="bi bi-trash"></i> Borrar
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('books.create') }}" class="btn btn-primary">Crear Nuevo Libro</a>
@endif
@endsection
