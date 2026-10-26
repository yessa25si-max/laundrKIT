<div class="row g-3">
    <!-- Nama Lengkap / Username -->
    <div class="col-md-6">
        <label for="name" class="form-label fw-semibold">
            Nama Pengguna <span class="text-danger">*</span>
        </label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-user"></i></span>
            <input type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   id="name"
                   name="name"
                   value="{{ old('name', $user->name ?? '') }}"
                   placeholder="Masukkan nama lengkap / username"
                   required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Email -->
    <div class="col-md-6">
        <label for="email" class="form-label fw-semibold">
            Alamat Email <span class="text-danger">*</span>
        </label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-envelope"></i></span>
            <input type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   id="email"
                   name="email"
                   value="{{ old('email', $user->email ?? '') }}"
                   placeholder="contoh: user@laundrkit.local"
                   required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Password -->
    <div class="col-md-6">
        <label for="password" class="form-label fw-semibold">
            Password @if(!($isEdit ?? false))<span class="text-danger">*</span>@endif
        </label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-lock"></i></span>
            <input type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   id="password"
                   name="password"
                   placeholder="{{ ($isEdit ?? false) ? 'Kosongkan jika tidak ingin mengubah password' : 'Min. 6 karakter' }}"
                   {{ ($isEdit ?? false) ? '' : 'required' }}>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @if($isEdit ?? false)
            <div class="form-text text-muted">
                <i class="fa-solid fa-circle-info me-1"></i>Biarkan kosong jika tidak ingin mengubah password saat ini.
            </div>
        @else
            <div class="form-text text-muted">
                <i class="fa-solid fa-shield-halved me-1"></i>Password akan di-hash secara aman menggunakan <code>Hash::make()</code>.
            </div>
        @endif
    </div>

    <!-- Konfirmasi Password -->
    <div class="col-md-6">
        <label for="password_confirmation" class="form-label fw-semibold">
            Konfirmasi Password @if(!($isEdit ?? false))<span class="text-danger">*</span>@endif
        </label>
        <div class="input-group">
            <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-key"></i></span>
            <input type="password"
                   class="form-control @error('password_confirmation') is-invalid @enderror"
                   id="password_confirmation"
                   name="password_confirmation"
                   placeholder="Ulangi password di atas"
                   {{ ($isEdit ?? false) ? '' : 'required' }}>
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
