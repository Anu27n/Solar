@extends('install.layout')

@section('content')
    <h1>Create administrator</h1>
    <p class="lead">This account has full access to the admin dashboard.</p>

    <form method="post" action="{{ route('install.admin.save') }}">
        @csrf
        <label for="name">Name</label>
        <input id="name" name="name" type="text" value="{{ old('name') }}" required autocomplete="name">

        <label for="email">Email</label>
        <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email">

        <div class="row two">
            <div>
                <label for="password">Password</label>
                <input id="password" name="password" type="password" required autocomplete="new-password">
            </div>
            <div>
                <label for="password_confirmation">Confirm password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password">
            </div>
        </div>

        <div class="actions">
            <button type="submit" class="btn">Create admin &amp; continue</button>
            <a class="btn secondary" href="{{ route('install.migrate') }}">Back</a>
        </div>
    </form>
@endsection
