<x-guest-layout>
    <h5 class="text-center mb-4 fw-bold">Login</h5>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
            <label class="form-check-label" for="remember_me">Remember me</label>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none small">Lupa password?</a>
            @endif
            <button type="submit" class="btn btn-primary px-4">Login</button>
        </div>
    </form>
</x-guest-layout>
