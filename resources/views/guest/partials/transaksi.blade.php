<!-- Partial View: Data Transaksi & Tracking Cucian (Eloquent ORM) -->
<section class="py-5 bg-white" id="tracking">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-semibold mb-2">
                <i class="fa-solid fa-receipt me-1"></i> Live Order Tracking • Eloquent ORM
            </span>
            <h2 class="fw-bold text-dark">Pantau Status Cucian Anda Secara Realtime</h2>
            <p class="text-muted mx-auto" style="max-width: 650px;">
                Cek progres pencucian pakaian Anda langsung tanpa perlu datang ke outlet. Bagian ini memuat data transaksi terhubung menggunakan <strong>Eloquent ORM</strong> (Relasi Transaksi &rarr; Pelanggan & Layanan).
            </p>
        </div>

        <!-- Formulir Cek Resi / Nomor HP -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 col-md-9">
                <div class="card border-0 shadow-sm rounded-4 p-3 bg-light border border-light">
                    <form action="{{ url('/#tracking') }}" method="GET" class="row g-2 align-items-center">
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-0 text-muted">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>
                                <input type="text"
                                       name="tracking_code"
                                       class="form-control border-0 py-3 shadow-none bg-white"
                                       placeholder="Masukkan Kode Resi (misal: TRX-20261101-001) / No. HP..."
                                       value="{{ request('tracking_code') }}"
                                       required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button type="submit" class="btn-brand-primary w-100 py-3 text-center border-0">
                                <i class="fa-solid fa-search me-1"></i> Cek Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Hasil Pencarian Tracking (Jika Ada) -->
        @if(request()->filled('tracking_code'))
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8">
                    @if(isset($searchResult) && $searchResult)
                        <div class="card border-0 shadow rounded-4 overflow-hidden" style="border: 2px solid #D95F91 !important;">
                            <div class="p-4 text-white d-flex justify-content-between align-items-center flex-wrap gap-2" style="background: linear-gradient(135deg, #D95F91 0%, #B83267 100%);">
                                <div>
                                    <span class="badge bg-white text-danger fw-bold mb-1">Status Pesanan Ditemukan</span>
                                    <h4 class="fw-bold mb-0 font-monospace">{{ $searchResult->kode_transaksi }}</h4>
                                </div>
                                <div>
                                    @if($searchResult->status == 'Baru')
                                        <span class="badge bg-secondary px-3 py-2 fs-6">Baru Masuk</span>
                                    @elseif($searchResult->status == 'Diproses')
                                        <span class="badge bg-warning text-dark px-3 py-2 fs-6">
                                            <i class="fa-solid fa-spinner fa-spin me-1"></i> Sedang Dicuci / Diproses
                                        </span>
                                    @elseif($searchResult->status == 'Selesai')
                                        <span class="badge bg-info text-white px-3 py-2 fs-6">
                                            <i class="fa-solid fa-circle-check me-1"></i> Selesai (Siap Diambil)
                                        </span>
                                    @elseif($searchResult->status == 'Diambil')
                                        <span class="badge bg-success text-white px-3 py-2 fs-6">
                                            <i class="fa-solid fa-bag-shopping me-1"></i> Sudah Diambil
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-body p-4 bg-white">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <small class="text-muted d-block">Nama Pelanggan:</small>
                                        <span class="fw-bold fs-6 text-dark">{{ $searchResult->pelanggan->first_name ?? '-' }} {{ $searchResult->pelanggan->last_name ?? '' }}</span>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted d-block">Paket Layanan:</small>
                                        <span class="fw-bold fs-6 text-primary">{{ $searchResult->layanan->nama_layanan ?? '-' }}</span>
                                    </div>
                                    <div class="col-sm-4">
                                        <small class="text-muted d-block">Berat / Kuantitas:</small>
                                        <span class="fw-semibold">{{ $searchResult->berat_jumlah }} {{ $searchResult->layanan->satuan ?? 'Kg' }}</span>
                                    </div>
                                    <div class="col-sm-4">
                                        <small class="text-muted d-block">Tanggal Masuk:</small>
                                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($searchResult->tgl_masuk)->format('d M Y') }}</span>
                                    </div>
                                    <div class="col-sm-4">
                                        <small class="text-muted d-block">Estimasi Selesai:</small>
                                        <span class="fw-semibold">{{ $searchResult->tgl_selesai ? \Carbon\Carbon::parse($searchResult->tgl_selesai)->format('d M Y') : 'Dalam antrean' }}</span>
                                    </div>
                                    <div class="col-12 pt-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
                                        <div>
                                            <small class="text-muted d-block">Status Pembayaran:</small>
                                            @if($searchResult->status_pembayaran == 'Lunas')
                                                <span class="badge bg-success text-white"><i class="fa-solid fa-check me-1"></i> LUNAS</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle"><i class="fa-solid fa-clock me-1"></i> BELUM LUNAS</span>
                                            @endif
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted d-block">Total Tagihan:</small>
                                            <span class="fs-4 fw-bold text-success">Rp {{ number_format($searchResult->total_biaya, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger rounded-4 p-4 text-center border-0 shadow-sm">
                            <i class="fa-solid fa-circle-exclamation fa-2x mb-2 text-danger"></i>
                            <h5 class="fw-bold mb-1">Resi Tidak Ditemukan</h5>
                            <p class="mb-0 text-muted small">
                                Kode transaksi atau nomor telepon <strong>"{{ request('tracking_code') }}"</strong> tidak cocok dengan pesanan mana pun. Pastikan Anda memasukkan kode resi yang valid.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Daftar Cucian Masuk Terkini (Eloquent with Relation) -->
        <div class="card border-0 rounded-4 shadow-sm p-4 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <div>
                    <h5 class="fw-bold text-dark mb-0">
                        <i class="fa-solid fa-clock-rotate-left text-primary me-2"></i> Status Pesanan Terkini
                    </h5>
                    <span class="text-muted small">Update progres cucian yang sedang ditangani hari ini</span>
                </div>
                <div>
                    <span class="badge bg-light text-muted border px-3 py-2">
                        <i class="fa-solid fa-signal text-success me-1"></i> Realtime Eloquent Feed
                    </span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>No. Resi</th>
                            <th>Pelanggan</th>
                            <th>Paket Layanan</th>
                            <th>Bobot / Qty</th>
                            <th>Status Pengerjaan</th>
                            <th>Estimasi Waktu</th>
                            <th>Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestTransaksi as $trx)
                            <tr>
                                <td>
                                    <span class="fw-bold font-monospace text-dark">{{ $trx->kode_transaksi }}</span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark">
                                        {{ $trx->pelanggan->first_name ?? '-' }} {{ substr($trx->pelanggan->last_name ?? '', 0, 1) }}.
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">{{ $trx->layanan->nama_layanan ?? '-' }}</span>
                                </td>
                                <td>{{ $trx->berat_jumlah }} {{ $trx->layanan->satuan ?? 'Kg' }}</td>
                                <td>
                                    @if($trx->status == 'Baru')
                                        <span class="badge bg-secondary-subtle text-secondary border">Baru Masuk</span>
                                    @elseif($trx->status == 'Diproses')
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">
                                            <i class="fa-solid fa-spinner fa-spin me-1"></i> Diproses
                                        </span>
                                    @elseif($trx->status == 'Selesai')
                                        <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle">
                                            <i class="fa-solid fa-circle-check me-1"></i> Siap Diambil
                                        </span>
                                    @elseif($trx->status == 'Diambil')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle">
                                            <i class="fa-solid fa-bag-shopping me-1"></i> Sudah Diambil
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-muted small">
                                        {{ $trx->tgl_selesai ? \Carbon\Carbon::parse($trx->tgl_selesai)->format('d M Y') : 'Hari ini' }}
                                    </span>
                                </td>
                                <td>
                                    @if($trx->status_pembayaran == 'Lunas')
                                        <span class="badge bg-success text-white small">Lunas</span>
                                    @else
                                        <span class="badge bg-secondary text-white small">Saat Ambil</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    Belum ada antrean cucian aktif.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
