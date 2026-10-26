<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Bootstrap 5 CSS via CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- FontAwesome 6 Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<!-- Custom Guest Theme Styling -->
<style>
    :root {
        --brand-primary: #D95F91;
        --brand-primary-hover: #C24A7C;
        --brand-secondary: #F08BB4;
        --brand-light: #FFF0F6;
        --brand-subtle: #FFF8FB;
        --brand-dark: #1F2937;
        --brand-text: #704457;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #FAFCFE;
        color: #334155;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .guest-main {
        flex: 1 0 auto;
    }

    /* Guest Navbar */
    .guest-navbar {
        background-color: #FFFFFF;
        box-shadow: 0 4px 20px rgba(217, 95, 145, 0.08);
        border-bottom: 1px solid #FFE4EE;
        padding-top: 14px;
        padding-bottom: 14px;
        transition: all 0.3s ease;
    }

    .guest-navbar .navbar-brand {
        font-weight: 800;
        color: var(--brand-primary);
        font-size: 1.4rem;
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .guest-navbar .navbar-brand img {
        height: 42px;
        width: auto;
        object-fit: contain;
    }

    .guest-navbar .nav-link {
        font-weight: 600;
        font-size: 0.95rem;
        color: #475569;
        padding: 8px 16px !important;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .guest-navbar .nav-link:hover,
    .guest-navbar .nav-link.active {
        color: var(--brand-primary) !important;
        background-color: var(--brand-light);
    }

    /* Custom Buttons */
    .btn-brand-primary {
        background: linear-gradient(135deg, var(--brand-primary) 0%, #B83267 100%);
        color: #FFFFFF !important;
        border: none;
        font-weight: 600;
        padding: 10px 22px;
        border-radius: 10px;
        box-shadow: 0 4px 14px rgba(217, 95, 145, 0.3);
        transition: all 0.25s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-brand-primary:hover {
        background: linear-gradient(135deg, var(--brand-primary-hover) 0%, #A02656 100%);
        box-shadow: 0 6px 18px rgba(217, 95, 145, 0.45);
        transform: translateY(-1px);
    }

    .btn-brand-outline {
        border: 2px solid var(--brand-primary);
        color: var(--brand-primary) !important;
        background: transparent;
        font-weight: 600;
        padding: 8px 20px;
        border-radius: 10px;
        transition: all 0.25s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-brand-outline:hover,
    .btn-brand-outline.active {
        background-color: var(--brand-primary);
        color: #FFFFFF !important;
        box-shadow: 0 4px 14px rgba(217, 95, 145, 0.25);
    }

    /* Hero Section */
    .guest-hero {
        background: linear-gradient(135deg, #FFF0F6 0%, #FFE4EE 50%, #FFF8FB 100%);
        padding: 85px 0 95px;
        position: relative;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background-color: #FFFFFF;
        color: var(--brand-primary);
        font-weight: 700;
        font-size: 0.85rem;
        padding: 6px 16px;
        border-radius: 30px;
        box-shadow: 0 2px 10px rgba(217, 95, 145, 0.15);
        margin-bottom: 22px;
        border: 1px solid #FFD1E3;
    }

    /* Process Card & Feature Cards */
    .card-process {
        background: #FFFFFF;
        border-radius: 18px;
        border: 1px solid #FFE4EE;
        padding: 32px 24px;
        text-align: center;
        box-shadow: 0 6px 20px rgba(217, 95, 145, 0.06);
        transition: all 0.3s ease;
        height: 100%;
    }

    .card-process:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 30px rgba(217, 95, 145, 0.16);
        border-color: var(--brand-primary);
    }

    .process-icon-circle {
        width: 76px;
        height: 76px;
        border-radius: 50%;
        background: var(--brand-light);
        color: var(--brand-primary);
        font-size: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        border: 2px solid #FFD1E3;
    }

    /* Auth Card Form */
    .auth-container {
        padding: 60px 0 80px;
    }

    .auth-card {
        background: #FFFFFF;
        border-radius: 22px;
        border: 1px solid #FFE4EE;
        box-shadow: 0 16px 40px rgba(217, 95, 145, 0.12);
        padding: 42px 38px;
    }

    .auth-icon-badge {
        width: 68px;
        height: 68px;
        border-radius: 18px;
        background: var(--brand-light);
        color: var(--brand-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.85rem;
        margin: 0 auto 18px;
        border: 1px solid #FFD1E3;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.92rem;
        color: #334155;
        margin-bottom: 7px;
    }

    .input-group-text {
        background-color: #F8FAFC;
        border-color: #CBD5E1;
        color: #64748B;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    .form-control-guest {
        border-color: #CBD5E1;
        padding: 11px 14px;
        font-size: 0.95rem;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-control-guest:focus {
        border-color: var(--brand-primary);
        box-shadow: 0 0 0 4px rgba(217, 95, 145, 0.15);
    }

    /* Guest Footer */
    .guest-footer {
        background: #1E293B;
        color: #CBD5E1;
        padding-top: 60px;
        padding-bottom: 25px;
        margin-top: auto;
        border-top: 3px solid var(--brand-primary);
    }

    .guest-footer a {
        color: #94A3B8;
        text-decoration: none;
        transition: color 0.2s;
    }

    .guest-footer a:hover {
        color: var(--brand-secondary);
    }
</style>

