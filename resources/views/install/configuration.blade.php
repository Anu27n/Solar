@extends('install.layout')

@section('content')
    <h1>Application configuration</h1>
    <p class="lead">These values are written to your <code style="color:#cbd5e1">.env</code> file. You can change mail settings later in the admin panel if needed.</p>

    <form method="post" action="{{ route('install.configuration.save') }}">
        @csrf
        <label for="app_name">Site / app name</label>
        <input id="app_name" name="app_name" type="text" value="{{ old('app_name', 'Solar Portal') }}" required>

        <label for="app_url">Site URL</label>
        <input id="app_url" name="app_url" type="url" value="{{ old('app_url', request()->getSchemeAndHttpHost()) }}" required placeholder="https://example.com">

        <div class="check">
            <input type="checkbox" name="app_debug" id="app_debug" value="1" @checked(old('app_debug'))>
            <label for="app_debug" style="margin:0;color:inherit;">Enable debug mode (leave off for production)</label>
        </div>

        <p class="lead" style="margin-top:1.25rem;">Mail (optional)</p>
        <div class="row two">
            <div>
                <label for="mail_mailer">Mailer</label>
                <input id="mail_mailer" name="mail_mailer" type="text" value="{{ old('mail_mailer', 'smtp') }}" placeholder="smtp / log">
            </div>
            <div>
                <label for="mail_host">Host</label>
                <input id="mail_host" name="mail_host" type="text" value="{{ old('mail_host') }}">
            </div>
        </div>
        <div class="row two">
            <div>
                <label for="mail_port">Port</label>
                <input id="mail_port" name="mail_port" type="text" value="{{ old('mail_port', '587') }}">
            </div>
            <div>
                <label for="mail_username">SMTP username</label>
                <input id="mail_username" name="mail_username" type="text" value="{{ old('mail_username') }}" autocomplete="off">
            </div>
        </div>
        <label for="mail_password">SMTP password</label>
        <input id="mail_password" name="mail_password" type="password" value="{{ old('mail_password') }}" autocomplete="new-password">

        <div class="row two">
            <div>
                <label for="mail_from_address">From address</label>
                <input id="mail_from_address" name="mail_from_address" type="email" value="{{ old('mail_from_address') }}">
            </div>
            <div>
                <label for="mail_from_name">From name</label>
                <input id="mail_from_name" name="mail_from_name" type="text" value="{{ old('mail_from_name') }}">
            </div>
        </div>

        <div class="actions">
            <button type="submit" class="btn">Save &amp; continue</button>
            <a class="btn secondary" href="{{ route('install.database') }}">Back</a>
        </div>
    </form>
@endsection
