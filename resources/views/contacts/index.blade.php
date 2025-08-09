@extends('layouts.app')

@section('title', __('messages.form_title'))

@section('content')
<h1 class="mb-4">{{ __('messages.welcome') }}</h1>

<!-- Selector de idioma -->
<form action="{{ route('lang.switch', app()->getLocale()) }}" method="GET" id="language-form" class="mb-4">
    <select name="locale" onchange="window.location.href='{{ url('lang') }}/'+this.value;" class="form-select w-auto">
        <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>Español</option>
        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
    </select>
</form>

<!-- Formulario de contacto -->
<form method="POST" action="{{ route('contacts.store') }}" enctype="multipart/form-data" class="mb-5 needs-validation" novalidate>
    @csrf
    <div class="mb-3">
        <input type="text" name="name" placeholder="{{ __('messages.form_name') }}" required
               class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <input type="email" name="email" placeholder="{{ __('messages.form_email') }}" required
               class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <input type="file" name="file" required class="form-control @error('file') is-invalid @enderror">
        @error('file')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">{{ __('messages.save') }}</button>
</form>

<!-- Listado de contactos -->
<form method="GET" action="{{ route('contacts.index') }}" class="mb-4 flex gap-2">
    <input type="text" name="title" value="{{ request('name') }}" placeholder="Título" class="border rounded px-2 py-1">

    <select name="contact_id" class="border rounded px-2 py-1">
        <option value="">-- Contacto --</option>
        @foreach ($contacts as $contact)
            <option value="{{ $contact->id }}" {{ request('contact_id') == $contact->id ? 'selected' : '' }}>
                {{ $contact->name }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-success">Filtrar</button>
    <!-- Botón limpiar filtros -->
    <button type="submit" name="clean" value="1" class="btn btn-success">
        Clean
    </button>
</form>
@if($contacts->isEmpty())
    <p class="text-muted">No hay contactos registrados.</p>
@else

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th>{{ __('messages.form_name') }}</th>
                <th>{{ __('messages.form_email') }}</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td class="text-center">
                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar este usuario?');" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            {{ __('messages.delete') ?? 'Eliminar' }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Links de paginación -->
    <div class="d-flex justify-content-center">
        {{ $contacts->links() }}
    </div>
@endif

<a href="{{ url('/') }}" class="btn btn-secondary mt-4">{{ __('messages.back') }}</a>

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
