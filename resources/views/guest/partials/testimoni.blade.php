<!-- Partial View: Testimoni & Review Pelanggan (Query Builder DB::table) -->
<section class="py-5" style="background-color: #FFF8FB;" id="testimoni">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-2 rounded-pill fw-semibold mb-2">
                <i class="fa-solid fa-bolt me-1"></i> Ulasan & Testimoni • Query Builder (DB::table)
            </span>
            <h2 class="fw-bold text-dark">Apa Kata Pelanggan Tentang LaundrKIT?</h2>
            <p class="text-muted mx-auto" style="max-width: 650px;">
                Kepercayaan dan kepuasan Anda adalah prioritas kami. Modul ini mengambil data ulasan secara efisien dengan <strong>Laravel Query Builder</strong> (JOIN tabel <code>testimoni</code>, <code>pelanggan</code>, dan <code>layanan</code>).
            </p>
        </div>

        <div class="row g-4">
            @forelse($listTestimoni as $review)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 rounded-4 shadow-sm p-4 h-100 bg-white position-relative">
                        <!-- Rating Stars -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <i class="fa-solid fa-star"></i>
                                    @else
                                        <i class="fa-regular fa-star text-muted opacity-50"></i>
                                    @endif
                                @endfor
                                <span class="fw-bold text-dark ms-1 small">({{ $review->rating }}.0)</span>
                            </div>
                            <span class="badge bg-danger-subtle text-danger rounded-pill px-2 py-1 small">
                                Verified Customer
                            </span>
                        </div>

                        <!-- Review Text -->
                        <p class="text-muted small mb-4 flex-grow-1 fst-italic position-relative">
                            <i class="fa-solid fa-quote-left text-danger opacity-25 fa-2x position-absolute" style="top: -12px; left: -8px; z-index: 0;"></i>
                            <span class="position-relative" style="z-index: 1;">
                                "{{ $review->komentar }}"
                            </span>
                        </p>

                        <!-- Author & Service Info -->
                        <div class="pt-3 border-top d-flex align-items-center gap-3">
                            <div class="avatar-circle bg-danger-subtle text-danger fw-bold rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-size: 14px;">
                                {{ substr($review->first_name, 0, 1) }}{{ substr($review->last_name, 0, 1) }}
                            </div>
                            <div>
                                <h6 class="fw-bold text-dark mb-0">{{ $review->first_name }} {{ $review->last_name }}</h6>
                                <span class="text-muted small">
                                    <i class="fa-solid fa-shirt me-1 text-primary"></i> {{ $review->nama_layanan }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="fa-solid fa-comments fa-3x mb-3 text-secondary opacity-50"></i>
                    <p class="mb-0">Belum ada testimoni pelanggan yang dipublikasikan.</p>
                </div>
            @endforelse
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-danger px-4 py-2 rounded-pill fw-semibold">
                <i class="fa-solid fa-plus-circle me-1"></i> Ingin Beri Masukan? Hubungi Admin
            </a>
        </div>
    </div>
</section>
