<!DOCTYPE html>
<html>
<head>
    <title>{{ __('messages.form_title') }} - {{ __('messages.welcome') }}</title>
</head>
<body>
    <h1>{{ __('messages.welcome') }}</h1>
    <form action="{{ route('lang.switch', app()->getLocale()) }}" method="GET" id="language-form">
        <select name="locale" onchange="window.location.href='{{ url('lang') }}/'+this.value;">
            <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>Español</option>
            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
        </select>
    </form>
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <input type="text" name="title" placeholder="{{ __('messages.form_title') }}" required>

        @error('title')
            <div class="error" style="color: red;">{{ $message }}</div>
        @enderror

        <button type="submit">{{ __('messages.save') }}</button>
    </form>

    <ul>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->created_at }}</td>
                <td>{{ $task->updated_at }}</td>
            </tr><br>
        @endforeach
    </ul>

    <a href="/">{{ __('messages.back') }}</a>
</body>
</html>
