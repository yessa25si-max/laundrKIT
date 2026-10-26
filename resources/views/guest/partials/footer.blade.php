<!-- Guest Footer Partial View -->
<footer class="guest-footer">
    <div class="container pb-4">
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <img src="{{ asset('assets-admin/assets/img/logo/logo.png') }}" alt="LaundryKIT" style="height: 38px; width: auto;" onerror="this.onerror=null; this.src='{{ asset('logo.png') }}';">
                    <span class="fs-4 fw-bold text-white">Laundr<span style="color: #D95F91;">KIT</span></span>
                </div>
                <p class="text-secondary small mb-3">
                    Sistem informasi laundry modern terintegrasi, memberikan hasil cucian bersih, wangi, rapi, dan higienis dengan pelayanan cepat serta profesional.
                </p>
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 col-6">
                <h6 class="text-white fw-bold mb-3">Halaman Tamu</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ url('/') }}"><i class="fa-solid fa-chevron-right me-1 text-danger small"></i> Home ( / )</a></li>
                    <li class="mb-2"><a href="{{ url('/auth') }}"><i class="fa-solid fa-chevron-right me-1 text-danger small"></i> Login ( /auth )</a></li>
                    <li class="mb-2"><a href="{{ url('/register') }}"><i class="fa-solid fa-chevron-right me-1 text-danger small"></i> Register ( /register )</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6 col-6">
                <h6 class="text-white fw-bold mb-3">Modul Sistem</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-chevron-right me-1 text-danger small"></i> Panel Admin</a></li>
                    <li class="mb-2"><a href="{{ route('pelanggan.index') }}"><i class="fa-solid fa-chevron-right me-1 text-danger small"></i> Data Pelanggan</a></li>
                    <li class="mb-2"><a href="{{ route('layanan.index') }}"><i class="fa-solid fa-chevron-right me-1 text-danger small"></i> Layanan Cuci</a></li>
                    <li class="mb-2"><a href="{{ route('barang.index') }}"><i class="fa-solid fa-chevron-right me-1 text-danger small"></i> Perlengkapan</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="text-white fw-bold mb-3">Hubungi Kami</h6>
                <ul class="list-unstyled small text-secondary">
                    <li class="mb-2"><i class="fa-solid fa-location-dot me-2 text-danger"></i> Kampus Politeknik Caltex Riau, Pekanbaru</li>
                    <li class="mb-2"><i class="fa-solid fa-phone me-2 text-danger"></i> (08) 728 256 266</li>
                    <li class="mb-2"><i class="fa-solid fa-envelope me-2 text-danger"></i> cs@laundrkit.id</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="border-top border-secondary pt-3 mt-3">
        <div class="container text-center small text-secondary">
            <p class="mb-0">&copy; {{ date('Y') }} <strong>LaundrKIT</strong>. All Rights Reserved. Praktikum Pemrograman Web - PartialView Guest.</p>
        </div>
    </div>
</footer>

