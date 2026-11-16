<x-guest-layout>
    <h5 class="text-center mb-4 fw-bold">Konfirmasi Password</h5>
    <div class="text-muted small mb-3">Ini adalah area aman. Harap konfirmasi password Anda sebelum melanjutkan.</div>
    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autofocus>
            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100">Konfirmasi</button>
    </form>
</x-guest-layout>
