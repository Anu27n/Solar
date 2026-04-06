@extends('install.layout')

@section('content')
    <h1>Database</h1>
    <p class="lead">Enter the MySQL credentials from your hosting control panel (cPanel, Plesk, etc.).</p>

    <form method="post" action="{{ route('install.database.save') }}">
        @csrf
        <div class="row two">
            <div>
                <label for="db_host">Host</label>
                <input id="db_host" name="db_host" type="text" value="{{ old('db_host', '127.0.0.1') }}" required autocomplete="off">
            </div>
            <div>
                <label for="db_port">Port</label>
                <input id="db_port" name="db_port" type="number" value="{{ old('db_port', 3306) }}" required min="1" max="65535">
            </div>
        </div>
        <label for="db_database">Database name</label>
        <input id="db_database" name="db_database" type="text" value="{{ old('db_database') }}" required autocomplete="off">

        <div class="row two">
            <div>
                <label for="db_username">Username</label>
                <input id="db_username" name="db_username" type="text" value="{{ old('db_username') }}" required autocomplete="off">
            </div>
            <div>
                <label for="db_password">Password</label>
                <input id="db_password" name="db_password" type="password" value="{{ old('db_password') }}" autocomplete="new-password">
            </div>
        </div>

        <div class="actions">
            <button type="submit" class="btn">Test connection &amp; continue</button>
            <a class="btn secondary" href="{{ route('install.requirements') }}">Back</a>
        </div>
    </form>
@endsection
