@extends('admin.layouts.app')

@section('title', 'Tambah Transaksi')
@section('page_title', 'Catat Transaksi Laundry Baru')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}" class="text-decoration-none">Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Catat Baru</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center gap-2">
            <h3 class="fw-bold mb-0 text-dark">Form Input Transaksi Laundry</h3>
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                <i class="fa-solid fa-code me-1"></i> Eloquent ORM
            </span>
        </div>
        <p class="text-muted small mb-0">Masukkan rincian cucian pelanggan, pilih paket layanan, dan status pembayaran.</p>
    </div>
    <div>
        <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>
</div>

<div class="card card-custom p-4">
    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <!-- Kode Transaksi -->
            <div class="col-md-4">
                <label for="kode_transaksi" class="form-label fw-semibold">Kode Transaksi / Invoice</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted"><i class="fa-solid fa-barcode"></i></span>
                    <input type="text"
                           class="form-control font-monospace @error('kode_transaksi') is-invalid @enderror"
                           id="kode_transaksi"
                           name="kode_transaksi"
                           value="{{ old('kode_transaksi', $autoKode) }}"
                           placeholder="Contoh: TRX-20261102-001">
                </div>
                <small class="text-muted">Dibuat otomatis bila dikosongkan.</small>
                @error('kode_transaksi')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pilih Pelanggan (Relasi Eloquent) -->
            <div class="col-md-4">
                <label for="pelanggan_id" class="form-label fw-semibold">Pelanggan <span class="text-danger">*</span></label>
                <select class="form-select @error('pelanggan_id') is-invalid @enderror" id="pelanggan_id" name="pelanggan_id" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    @foreach($pelanggan as $p)
                        <option value="{{ $p->pelanggan_id }}" {{ old('pelanggan_id') == $p->pelanggan_id ? 'selected' : '' }}>
                            {{ $p->first_name }} {{ $p->last_name }} ({{ $p->phone ?? $p->email }})
                        </option>
                    @endforeach
                </select>
                @error('pelanggan_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pilih Layanan (Relasi Eloquent) -->
            <div class="col-md-4">
                <label for="layanan_id" class="form-label fw-semibold">Paket Layanan <span class="text-danger">*</span></label>
                <select class="form-select @error('layanan_id') is-invalid @enderror" id="layanan_id" name="layanan_id" required>
                    <option value="" data-harga="0">-- Pilih Layanan --</option>
                    @foreach($layanan as $l)
                        <option value="{{ $l->layanan_id }}"
                                data-harga="{{ $l->harga }}"
                                data-satuan="{{ $l->satuan }}"
                                {{ old('layanan_id') == $l->layanan_id ? 'selected' : '' }}>
                            {{ $l->nama_layanan }} - Rp {{ number_format($l->harga, 0, ',', '.') }}/{{ $l->satuan }}
                        </option>
                    @endforeach
                </select>
                @error('layanan_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Berat / Jumlah Unit -->
            <div class="col-md-3">
                <label for="berat_jumlah" class="form-label fw-semibold">Jumlah / Berat <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="number"
                           step="0.1"
                           min="0.1"
                           class="form-control @error('berat_jumlah') is-invalid @enderror"
                           id="berat_jumlah"
                           name="berat_jumlah"
                           value="{{ old('berat_jumlah', '1.0') }}"
                           required>
                    <span class="input-group-text bg-light text-muted" id="label-satuan">Kg / Pcs</span>
                </div>
                @error('berat_jumlah')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Total Biaya -->
            <div class="col-md-3">
                <label for="total_biaya" class="form-label fw-semibold">Total Biaya (Rp)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light fw-bold">Rp</span>
                    <input type="number"
                           min="0"
                           class="form-control @error('total_biaya') is-invalid @enderror"
                           id="total_biaya"
                           name="total_biaya"
                           value="{{ old('total_biaya') }}"
                           placeholder="Otomatis dihitung">
                </div>
                <small class="text-muted">Bisa diedit manual bila ada diskon/biaya ekstra.</small>
                @error('total_biaya')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tanggal Masuk -->
            <div class="col-md-3">
                <label for="tgl_masuk" class="form-label fw-semibold">Tanggal Masuk <span class="text-danger">*</span></label>
                <input type="date"
                       class="form-control @error('tgl_masuk') is-invalid @enderror"
                       id="tgl_masuk"
                       name="tgl_masuk"
                       value="{{ old('tgl_masuk', date('Y-m-d')) }}"
                       required>
                @error('tgl_masuk')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Estimasi Tanggal Selesai -->
            <div class="col-md-3">
                <label for="tgl_selesai" class="form-label fw-semibold">Estimasi Selesai</label>
                <input type="date"
                       class="form-control @error('tgl_selesai') is-invalid @enderror"
                       id="tgl_selesai"
                       name="tgl_selesai"
                       value="{{ old('tgl_selesai', date('Y-m-d', strtotime('+2 days'))) }}">
                @error('tgl_selesai')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status Cucian -->
            <div class="col-md-6">
                <label for="status" class="form-label fw-semibold">Status Pengerjaan <span class="text-danger">*</span></label>
                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="Baru" {{ old('status') == 'Baru' ? 'selected' : '' }}>Baru Masuk (Menunggu Antrian)</option>
                    <option value="Diproses" {{ old('status') == 'Diproses' ? 'selected' : '' }}>Diproses (Sedang Dicuci / Disetrika)</option>
                    <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>Selesai (Siap Diambil)</option>
                    <option value="Diambil" {{ old('status') == 'Diambil' ? 'selected' : '' }}>Diambil (Sudah Diterima Pelanggan)</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status Pembayaran -->
            <div class="col-md-6">
                <label for="status_pembayaran" class="form-label fw-semibold">Status Pembayaran <span class="text-danger">*</span></label>
                <select class="form-select @error('status_pembayaran') is-invalid @enderror" id="status_pembayaran" name="status_pembayaran" required>
                    <option value="Belum Lunas" {{ old('status_pembayaran') == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas (Bayar Saat Pengambilan)</option>
                    <option value="Lunas" {{ old('status_pembayaran') == 'Lunas' ? 'selected' : '' }}>Lunas (Telah Dibayar)</option>
                </select>
                @error('status_pembayaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Catatan Khusus -->
            <div class="col-12">
                <label for="catatan" class="form-label fw-semibold">Catatan Khusus Cucian</label>
                <textarea class="form-control @error('catatan') is-invalid @enderror"
                          id="catatan"
                          name="catatan"
                          rows="3"
                          placeholder="Contoh: Pisahkan kemeja putih, jangan gunakan pewangi berlebih, ada noda kecap di kerah.">{{ old('catatan') }}</textarea>
                @error('catatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Aksi -->
            <div class="col-12 text-end pt-3 border-top">
                <a href="{{ route('transaksi.index') }}" class="btn btn-light me-2">Batal</a>
                <button type="submit" class="btn btn-brand px-4">
                    <i class="fa-solid fa-save me-1"></i> Simpan Transaksi (Eloquent)
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const layananSelect = document.getElementById('layanan_id');
        const beratInput = document.getElementById('berat_jumlah');
        const totalInput = document.getElementById('total_biaya');
        const labelSatuan = document.getElementById('label-satuan');

        function hitungTotal() {
            const selectedOption = layananSelect.options[layananSelect.selectedIndex];
            const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
            const satuan = selectedOption.getAttribute('data-satuan') || 'Unit';
            const berat = parseFloat(beratInput.value) || 0;

            labelSatuan.textContent = satuan;

            if (harga > 0 && berat > 0) {
                totalInput.value = Math.round(harga * berat);
            }
        }

        layananSelect.addEventListener('change', hitungTotal);
        beratInput.addEventListener('input', hitungTotal);
    });
</script>
@endsection
