<x-guest-layout>
    <h5 class="text-center mb-4 fw-bold">Verifikasi Email</h5>
    <div class="text-muted small mb-3">
        Terima kasih telah mendaftar! Sebelum memulai, verifikasi email Anda dengan klik link yang kami kirim. Jika tidak menerima email, kami akan kirim ulang.
    </div>
    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success small">Link verifikasi baru telah dikirim ke email Anda.</div>
    @endif
    <div class="d-flex justify-content-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-outline-primary btn-sm">Kirim Ulang Email</button>
        </form>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-secondary btn-sm">Logout</button>
        </form>
    </div>
</x-guest-layout>
