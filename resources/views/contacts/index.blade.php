<!DOCTYPE html>
<html>
<head>
    <title>{{ __('messages.form_title') }} - {{ __('messages.welcome') }}</title>
</head>
<body>
    <h1>{{ __('messages.welcome') }}</h1>
    <form action="{{ route('lang.switch', app()->getLocale()) }}" method="GET" id="language-form" >
        <select name="locale" onchange="window.location.href='{{ url('lang') }}/'+this.value;">
            <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>Español</option>
            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
        </select>
    </form>
    <form method="POST" action="{{ route('contacts.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="{{ __('messages.form_name') }}" required>
        <input type="text" name="email" placeholder="{{ __('messages.form_email') }}" required>
        <input type="file" name="file" placeholder="{{ __('messages.form_file') }}" required>

        @error('email')
            <div class="error" style="color: red;">{{ $message }}</div>
        @enderror

        <button type="submit">{{ __('messages.save') }}</button>
    </form>

    <ul>
        @foreach ($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                @if($contact->file)
                    <a href="{{ asset('storage/' . $contact->file) }}" target="_blank">Ver adjunto</a>
                @endif
            </tr><br>
        @endforeach
    </ul>

    <a href="/">{{ __('messages.back') }}</a>
</body>
</html>
