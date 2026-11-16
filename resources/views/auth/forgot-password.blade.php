<x-guest-layout>
    <h5 class="text-center mb-4 fw-bold">Lupa Password</h5>
    <div class="text-muted small mb-3">Lupa password? Masukkan email Anda, kami akan kirim link reset.</div>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('login') }}" class="text-decoration-none small">Kembali ke login</a>
            <button type="submit" class="btn btn-primary px-4">Kirim Link</button>
        </div>
    </form>
</x-guest-layout>
