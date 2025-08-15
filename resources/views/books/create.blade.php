@extends('layouts.app')

@section('title', 'Crear Libro')

@section('content')
<h1 class="mb-4">Crear Libro</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('books.store') }}" method="POST" class="needs-validation" novalidate>
    @csrf

    <div class="mb-3">
        <label for="title" class="form-label">Título <span class="text-danger">*</span></label>
        <input type="text" name="title" id="title"
               class="form-control @error('title') is-invalid @enderror"
               value="{{ old('title') }}" required>
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
            <option value="{{ $contact->id }}" {{ old('contact_id') == $contact->id ? 'selected' : '' }}>
                {{ $contact->name }}
            </option>
            @endforeach
        </select>
        @error('contact_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Guardar Libro</button>
    <a href="{{ route('books.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
</form>

<script>
(() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();
</script>
@endsection
