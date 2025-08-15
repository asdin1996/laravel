@extends('layouts.app')

@section('title', 'Editar Libro')

@section('content')
<h1 class="mb-4">Editar Libro</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('books.update', $book) }}" method="POST" class="needs-validation" novalidate>
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="title" class="form-label">Título <span class="text-danger">*</span></label>
        <input type="text" name="title" id="title"
               class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title', $book->title) }}" required>
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @else
        <div class="invalid-feedback">Por favor, ingresa el título.</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="contact_id" class="form-label">Contacto Asociado</label>
        <select name="contact_id" id="contact_id" class="form-select @error('contact_id') is-invalid @enderror">
            <option value="" selected>-- Selecciona un contacto (opcional) --</option>
            @foreach ($contacts as $contact)
            <option value="{{ $contact->id }}" {{ (old('contact_id', $book->contact_id) == $contact->id) ? 'selected' : '' }}>
                {{ $contact->name }}
            </option>
            @endforeach
        </select>
        @error('contact_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Libro</button>
    <a href="{{ route('books.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
</form>

<script>
(() => {
