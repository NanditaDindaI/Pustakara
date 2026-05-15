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
                font-size: 15px;
                color: var(--bark3);
                -webkit-font-smoothing: antialiased;
            }

            /* ── PAGE HEADER ─────────────────────────── */
            .page-header {
                background: linear-gradient(140deg, var(--bark) 0%, var(--bark2) 35%, var(--bark3) 75%, #7A4A28 100%);
                padding: 1.5rem 2.5rem;
                border-bottom: 2.5px solid;
                border-image: linear-gradient(90deg, var(--leaf1), var(--gold), var(--leaf3), var(--gold2), var(--leaf1)) 1;
                position: relative;
                overflow: hidden;
                box-shadow: 0 6px 32px rgba(30,15,8,0.35);
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
                font-size: 1.55rem;
                font-weight: 700;
                letter-spacing: -0.01em;
                text-shadow: 0 2px 12px rgba(0,0,0,0.4);
                display: flex;
                align-items: center;
                gap: 12px;
            }
            .page-header h1::before,
            .page-header h2::before {
                content: '';
                display: inline-block;
                width: 5px; height: 32px;
                background: linear-gradient(to bottom, var(--leaf4), var(--leaf1));
                border-radius: 3px;
                box-shadow: 0 0 10px rgba(86,150,51,0.5);
                flex-shrink: 0;
            }
            .page-header p {
                font-size: 0.85rem;
                color: var(--latte);
                margin-top: 5px;
                padding-left: 17px;
                font-weight: 400;
                font-style: italic;
            }

            /* ── CARDS ───────────────────────────────── */
            .card {
                background: var(--white);
                border-radius: 16px;
                border: 1.5px solid rgba(92,51,23,0.12);
                box-shadow: 0 2px 20px rgba(30,15,8,0.08);
                padding: 24px;
            }

            /* ── BUTTONS ─────────────────────────────── */
            .btn {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                padding: 8px 18px;
                border-radius: 999px;
                border: none;
                cursor: pointer;
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 0.8rem;
                font-weight: 700;
                letter-spacing: 0.04em;
                text-transform: uppercase;
                text-decoration: none;
                transition: all 0.2s;
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--bark2), var(--bark3));
                color: var(--gold2);
                box-shadow: 0 2px 12px rgba(30,15,8,0.3);
            }
            .btn-primary:hover { opacity: 0.88; transform: translateY(-1px); box-shadow: 0 4px 16px rgba(30,15,8,0.38); }

            .btn-success {
                background: linear-gradient(135deg, var(--leaf1), var(--leaf3));
                color: #fff;
                box-shadow: 0 2px 12px rgba(36,80,15,0.35);
            }
            .btn-success:hover { opacity: 0.88; transform: translateY(-1px); }

            .btn-warning {
                background: linear-gradient(135deg, var(--gold), var(--gold2));
                color: var(--bark2);
                box-shadow: 0 2px 10px rgba(201,168,76,0.4);
            }
            .btn-warning:hover { opacity: 0.88; transform: translateY(-1px); }

            .btn-danger {
                background: linear-gradient(135deg, var(--red-mid), var(--red-light));
                color: #fff;
                box-shadow: 0 2px 10px rgba(192,57,43,0.35);
            }
            .btn-danger:hover { opacity: 0.88; transform: translateY(-1px); }

            .btn-secondary {
                background: transparent;
                color: var(--bark3);
                border: 1.5px solid rgba(92,51,23,0.28);
            }
            .btn-secondary:hover { background: var(--parchment); border-color: var(--coffee); color: var(--bark2); }

            .btn-sm { padding: 5px 13px; font-size: 0.73rem; }

            /* ── TABLE ───────────────────────────────── */
            table { width: 100%; border-collapse: collapse; font-size: 0.88rem; }

            table thead tr {
                background: linear-gradient(135deg, var(--bark) 0%, var(--bark2) 100%);
            }
            table thead th {
                padding: 13px 14px !important;
                font-family: 'Plus Jakarta Sans', sans-serif !important;
                font-size: 0.71rem !important;
                font-weight: 700 !important;
                text-transform: uppercase;
                letter-spacing: 0.09em;
                color: var(--gold2) !important;
                white-space: nowrap;
            }
            table thead th:first-child { padding-left: 1.5rem !important; }
            table thead th:last-child  { padding-right: 1.5rem !important; }

            table tbody tr {
                border-bottom: 1px solid rgba(92,51,23,0.07);
                transition: background 0.15s;
            }
            table tbody tr:last-child { border-bottom: none; }
            table tbody tr:hover { background: rgba(178,212,126,0.1); }

            table tbody td {
                padding: 13px 14px;
                color: var(--bark3);
                vertical-align: middle;
            }
            table tbody td:first-child { padding-left: 1.5rem; color: var(--coffee); font-weight: 600; }
            table tbody td:last-child  { padding-right: 1.5rem; }

            /* ── BADGES ──────────────────────────────── */
            .badge {
                display: inline-flex;
                align-items: center;
                gap: 5px;
                padding: 3px 12px;
                border-radius: 999px;
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 0.71rem;
                font-weight: 700;
                letter-spacing: 0.07em;
                text-transform: uppercase;
            }
            .badge-aktif       { background: rgba(36,80,15,0.12); color: var(--leaf1); border: 1.5px solid rgba(36,80,15,0.22); }
            .badge-nonaktif    { background: rgba(192,57,43,0.1);  color: var(--red-dark); border: 1.5px solid rgba(192,57,43,0.22); }
            .badge-menunggu    { background: rgba(201,168,76,0.14); color: #7A5C10; border: 1.5px solid rgba(201,168,76,0.35); }
            .badge-dipinjam    { background: rgba(92,51,23,0.1);  color: var(--bark3); border: 1.5px solid rgba(92,51,23,0.22); }
            .badge-dikembalikan { background: rgba(58,115,32,0.1); color: var(--leaf1); border: 1.5px solid rgba(58,115,32,0.22); }
            .badge-ditolak     { background: rgba(192,57,43,0.1);  color: var(--red-dark); border: 1.5px solid rgba(192,57,43,0.22); }
            .badge-lunas       { background: rgba(36,80,15,0.12); color: var(--leaf0); border: 1.5px solid rgba(36,80,15,0.22); }
            .badge-belum-bayar { background: rgba(122,28,28,0.1); color: var(--red-dark); border: 1.5px solid rgba(122,28,28,0.22); }

            /* ── FORM CONTROLS ───────────────────────── */
            .form-input, .form-select, .form-textarea {
                width: 100%;
                padding: 9px 14px;
                border-radius: 10px;
                border: 1.5px solid rgba(92,51,23,0.2);
                background: var(--white);
                color: var(--bark2);
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 0.88rem;
                outline: none;
                transition: border-color 0.2s, box-shadow 0.2s;
            }
            .form-input:focus, .form-select:focus, .form-textarea:focus {
                border-color: var(--leaf2);
                box-shadow: 0 0 0 3px rgba(58,115,32,0.12);
            }

            /* ── ALERTS ──────────────────────────────── */
            .alert-success {
                background: rgba(36,80,15,0.08);
                border: 1.5px solid rgba(36,80,15,0.2);
                color: var(--leaf0);
                border-radius: 10px;
                padding: 12px 16px;
                font-size: 0.87rem;
                font-weight: 500;
            }
            .alert-error {
                background: rgba(192,57,43,0.08);
                border: 1.5px solid rgba(192,57,43,0.22);
                color: var(--red-dark);
                border-radius: 10px;
                padding: 12px 16px;
                font-size: 0.87rem;
                font-weight: 500;
            }

            /* ── MEMBER AVATAR IN TABLE ──────────────── */
            .member-wrap { display: flex; align-items: center; gap: 10px; }
            .member-av {
                width: 34px; height: 34px; border-radius: 50%; flex-shrink: 0;
                background: linear-gradient(135deg, var(--leaf1), var(--leaf4));
                display: flex; align-items: center; justify-content: center;
                font-size: 11px; font-weight: 800; color: #fff;
                border: 2px solid var(--moss);
            }
            .member-name { font-weight: 600; color: var(--bark2); font-size: 0.87rem; }
            .member-id   { font-size: 0.73rem; color: var(--coffee); }

            /* ── MISC UTILS ──────────────────────────── */
            .text-muted   { color: var(--coffee); font-size: 0.83rem; }
            .text-danger  { color: var(--red-dark); font-weight: 700; }
            .text-success { color: var(--leaf0); font-weight: 700; }
            .section-title {
                font-family: 'Syne', sans-serif;
                font-size: 1rem;
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