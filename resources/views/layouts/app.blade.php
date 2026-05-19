<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pustakara') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Fraunces:ital,opsz,wght@0,9..144,500;0,9..144,700;1,9..144,400;1,9..144,500&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --bark:       #1E0F08;
                --bark2:      #3B1F10;
                --bark3:      #5C3317;
                --coffee:     #8B5E3C;
                --latte:      #C4956A;
                --gold:       #C9A84C;
                --gold2:      #E8D08A;
                --cream:      #FAF6EE;
                --parchment:  #F2EAD5;
                --white:      #FEFCF8;
                --leaf0:      #152E07;
                --leaf1:      #24500F;
                --leaf2:      #3A7320;
                --leaf3:      #569633;
                --leaf4:      #7DBF50;
                --moss:       #B2D47E;
                --red-dark:   #7A1C1C;
                --red-mid:    #C0392B;
                --red-light:  #E85555;
            }

            *, *::before, *::after { box-sizing: border-box; }

            body {
                background-color: var(--cream);
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 16px; /* DIUBAH: Ukuran font dasar dinaikkan agar tulisan keseluruhan lebih besar */
                color: var(--bark3);
                -webkit-font-smoothing: antialiased;
            }

            /* ── NAVIGATOR GLOBAL ADJUSTMENT ───────────────── */
            /* Memaksa elemen teks di dalam file include navigation agar lebih besar, tebal, dan sejajar secara visual */
            nav, .nav-link, nav a, nav button, nav span {
                font-size: 1.05rem !important; 
                font-weight: 600 !important;
            }
            nav .brand, nav .logo-text {
                font-size: 1.4rem !important;
                font-weight: 800 !important;
                letter-spacing: 0.03em;
            }

            /* ── PAGE HEADER ─────────────────────────── */
            .page-header {
                /* DIUBAH: Gradasi cokelat disesuaikan agar transisinya lebih kaya dan premium */
                background: linear-gradient(135deg, var(--bark) 0%, var(--bark2) 40%, var(--bark3) 80%, var(--coffee) 100%);
                padding: 1.8rem 2.5rem; /* DIUBAH: Padding sedikit dinaikkan */
                border-bottom: 3px solid; /* DIUBAH: Garis bawah dipertebal */
                border-image: linear-gradient(90deg, var(--leaf1), var(--gold), var(--leaf3), var(--gold2), var(--leaf1)) 1;
                position: relative;
                overflow: hidden;
                box-shadow: 0 8px 36px rgba(30,15,8,0.4);
            }
            .page-header::before {
                content: '';
                position: absolute;
                top: -70px; right: -70px;
                width: 260px; height: 260px;
                background: radial-gradient(circle, rgba(86,150,51,0.13) 0%, transparent 65%);
                pointer-events: none;
            }
            .page-header h1,
            .page-header h2,
            .page-header p {
                font-family: 'Plus Jakarta Sans', sans-serif;
                color: var(--gold2);
            }
            .page-header h1,
            .page-header h2 {
                font-size: 1.8rem; /* DIUBAH: Ukuran judul dashboard dinaikkan dari 1.55rem */
                font-weight: 700;
                letter-spacing: -0.01em;
                text-shadow: 0 2px 14px rgba(0,0,0,0.5);
                display: flex;
                align-items: center;
                gap: 14px;
            }
            .page-header h1::before,
            .page-header h2::before {
                content: '';
                display: inline-block;
                width: 6px; height: 36px; /* DIUBAH: Disesuaikan dengan tinggi font judul baru */
                background: linear-gradient(to bottom, var(--leaf4), var(--leaf1));
                border-radius: 3px;
                box-shadow: 0 0 12px rgba(86,150,51,0.6);
                flex-shrink: 0;
            }
            .page-header p {
                font-size: 0.95rem; /* DIUBAH: Sub-judul disesuaikan ukurannya */
                color: var(--latte);
                margin-top: 6px;
                padding-left: 20px;
                font-weight: 400;
                font-style: italic;
            }

            /* ── CARDS ───────────────────────────────── */
            .card {
                background: var(--white);
                border-radius: 16px;
                border: 1.5px solid rgba(92,51,23,0.15);
                box-shadow: 0 4px 24px rgba(30,15,8,0.1); /* DIUBAH: Efek shadow card lebih tegas */
                padding: 26px;
            }

            /* ── BUTTONS ─────────────────────────────── */
            .btn {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 10px 22px; /* DIUBAH: Sedikit diperbesar tombolnya */
                border-radius: 999px;
                border: none;
                cursor: pointer;
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 0.88rem; /* DIUBAH: Ukuran font tombol dinaikkan */
                font-weight: 700;
                letter-spacing: 0.04em;
                text-transform: uppercase;
                text-decoration: none;
                transition: all 0.25s ease;
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--bark2), var(--bark3));
                color: var(--gold2);
                box-shadow: 0 3px 14px rgba(30,15,8,0.35);
            }
            .btn-primary:hover { opacity: 0.92; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(30,15,8,0.45); }

            /* ── 3D TABLE CONTAINER ──────────────────── */
            /* DIUBAH/DITAMBAHKAN: Wrapper khusus untuk membungkus elemen <table> agar memiliki efek 3D timbul */
            .table-container {
                width: 100%;
                overflow-x: auto;
                border-radius: 14px;
                border: 2px solid var(--bark2); /* Border luar tebal pembentuk dimensi */
                box-shadow: 0 8px 0px var(--bark), 0 12px 24px rgba(30,15,8,0.25); /* Efek bayangan 3D solid di bagian bawah gembung */
                background: var(--white);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }
            .table-container:hover {
                transform: translateY(-2px); /* Interaksi naik sedikit ketika disorot mouse */
                box-shadow: 0 10px 0px var(--bark), 0 14px 28px rgba(30,15,8,0.3);
            }

            /* ── TABLE ───────────────────────────────── */
            table { width: 100%; border-collapse: separate; border-spacing: 0; font-size: 0.95rem; } /* DIUBAH: Menggunakan separate agar border internal bekerja baik */

            table thead tr {
                /* DIUBAH: Menggunakan efek gradasi cokelat mewah yang menyatu dari sudut kiri ke kanan */
                background: linear-gradient(90deg, var(--bark) 0%, var(--bark2) 50%, var(--bark3) 100%);
            }
            table thead th {
                padding: 16px 18px !important; /* DIUBAH: Ruang header tabel diperlebar */
                font-family: 'Plus Jakarta Sans', sans-serif !important;
                font-size: 0.82rem !important; /* DIUBAH: Font th dinaikkan */
                font-weight: 700 !important;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                color: var(--gold2) !important;
                white-space: nowrap;
                border-bottom: 2px solid var(--bark);
            }
            table thead th:not(:last-child) {
                border-right: 1px solid rgba(232,208,138,0.15); /* Border sekat vertikal halus di bagian header */
            }
            table thead th:first-child { padding-left: 1.5rem !important; }
            table thead th:last-child  { padding-right: 1.5rem !important; }

            table tbody tr {
                transition: background 0.15s;
            }
            /* DIUBAH: Memberikan garis pembatas/border antar cell baris yang nyata */
            table tbody tr td {
                border-bottom: 1.5px solid rgba(92,51,23,0.15);
                border-right: 1.5px solid rgba(92,51,23,0.08);
            }
            table tbody tr td:last-child {
                border-right: none; /* Hilangkan border kanan paling ujung */
            }
            table tbody tr:last-child td { 
                border-bottom: none; /* Hilangkan border bawah pada baris terakhir agar tidak bentrok dengan lengkungan container */
            }
            table tbody tr:hover { background: rgba(201,168,76,0.06); } /* Tint kuning-gold soft saat hover row */

            table tbody td {
                padding: 15px 18px; /* DIUBAH: Padding data dinaikkan */
                color: var(--bark3);
                vertical-align: middle;
            }
            table tbody td:first-child { padding-left: 1.5rem; color: var(--coffee); font-weight: 700; }
            table tbody td:last-child  { padding-right: 1.5rem; }

            /* ── BADGES ──────────────────────────────── */
            .badge {
                display: inline-flex;
                align-items: center;
                gap: 5px;
                padding: 5px 14px; /* DIUBAH: Badge dibuat sedikit lebih gemuk agar seimbang */
                border-radius: 999px;
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 0.78rem; /* DIUBAH: Font badge diperbesar */
                font-weight: 700;
                letter-spacing: 0.07em;
                text-transform: uppercase;
                box-shadow: 0 2px 4px rgba(0,0,0,0.03);
            }
            .badge-aktif       { background: rgba(36,80,15,0.12); color: var(--leaf1); border: 1.5px solid rgba(36,80,15,0.22); }
            .badge-nonaktif    { background: rgba(192,57,43,0.1);  color: var(--red-dark); border: 1.5px solid rgba(192,57,43,0.22); }
            .badge-menunggu    { background: rgba(201,168,76,0.14); color: #7A5C10; border: 1.5px solid rgba(201,168,76,0.45); }
            .badge-dipinjam    { background: rgba(92,51,23,0.1);  color: var(--bark3); border: 1.5px solid rgba(92,51,23,0.32); }
            .badge-dikembalikan { background: rgba(58,115,32,0.1); color: var(--leaf1); border: 1.5px solid rgba(58,115,32,0.22); }
            .badge-ditolak     { background: rgba(192,57,43,0.1);  color: var(--red-dark); border: 1.5px solid rgba(192,57,43,0.22); }
            .badge-lunas       { background: rgba(36,80,15,0.12); color: var(--leaf0); border: 1.5px solid rgba(36,80,15,0.22); }
            .badge-belum-bayar { background: rgba(122,28,28,0.1); color: var(--red-dark); border: 1.5px solid rgba(122,28,28,0.22); }

            /* ── FORM CONTROLS ───────────────────────── */
            .form-input, .form-select, .form-textarea {
                width: 100%;
                padding: 11px 16px; /* DIUBAH: Input field dibuat lebih tinggi */
                border-radius: 10px;
                border: 1.5px solid rgba(92,51,23,0.25);
                background: var(--white);
                color: var(--bark2);
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 0.93rem;
                outline: none;
                transition: border-color 0.2s, box-shadow 0.2s;
            }
            .form-input:focus, .form-select:focus, .form-textarea:focus {
                border-color: var(--leaf2);
                box-shadow: 0 0 0 3px rgba(58,115,32,0.15);
            }

            /* ── ALERTS ──────────────────────────────── */
            .alert-success {
                background: rgba(36,80,15,0.08);
                border: 1.5px solid rgba(36,80,15,0.2);
                color: var(--leaf0);
                border-radius: 10px;
                padding: 14px 18px;
                font-size: 0.93rem;
                font-weight: 500;
            }
            .alert-error {
                background: rgba(192,57,43,0.08);
                border: 1.5px solid rgba(192,57,43,0.22);
                color: var(--red-dark);
                border-radius: 10px;
                padding: 14px 18px;
                font-size: 0.93rem;
                font-weight: 500;
            }

            /* ── MEMBER AVATAR IN TABLE ──────────────── */
            .member-wrap { display: flex; align-items: center; gap: 12px; }
            .member-av {
                width: 38px; height: 38px; border-radius: 50%; flex-shrink: 0; /* DIUBAH: Ukuran avatar disesuaikan naik */
                background: linear-gradient(135deg, var(--leaf1), var(--leaf4));
                display: flex; align-items: center; justify-content: center;
                font-size: 12px; font-weight: 800; color: #fff;
                border: 2px solid var(--moss);
            }
            .member-name { font-weight: 600; color: var(--bark2); font-size: 0.93rem; }
            .member-id   { font-size: 0.78rem; color: var(--coffee); }

            /* ── MISC UTILS ──────────────────────────── */
            .text-muted   { color: var(--coffee); font-size: 0.88rem; }
            .text-danger  { color: var(--red-dark); font-weight: 700; }
            .text-success { color: var(--leaf0); font-weight: 700; }
            .section-title {
                font-family: 'Syne', sans-serif;
                font-size: 1.15rem; /* DIUBAH: Ukuran section title naik */
                font-weight: 700;
                color: var(--bark2);
                letter-spacing: -0.01em;
                display: flex;
                align-items: center;
                gap: 10px;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen" style="background-color: var(--cream);">
            @include('layouts.navigation')

            @isset($header)
                <header class="page-header shadow">
                    <div class="max-w-7xl mx-auto">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>