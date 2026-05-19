<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

        .pw *{
            font-family:'Inter',sans-serif;
            box-sizing:border-box;
        }

        .pw{
            --forest:#173728;
            --forest2:#21543D;
            --forest3:#2D7A58;

            --leaf:#74C69D;
            --leaf-light:#D8F3DC;

            --bg:#F5F7F6;
            --white:#FFFFFF;

            --text:#142018;
            --text2:#4D5B53;
            --muted:#819084;

            --border:#E4ECE7;

            --danger:#C0392B;
            --warning:#A16207;

            background:var(--bg);
            min-height:100vh;
            padding-bottom:60px;
        }

        /* HERO */

        .pw-hero{
            background:
                linear-gradient(135deg,#173728 0%,#21543D 60%,#2D7A58 100%);
            padding:60px 50px 120px;
            position:relative;
            overflow:hidden;
        }

        .pw-hero::before{
            content:'';
            position:absolute;
            width:420px;
            height:420px;
            border-radius:50%;
            background:rgba(255,255,255,.04);
            right:-120px;
            top:-80px;
        }

        .pw-hero-inner{
            max-width:1400px;
            margin:auto;
            position:relative;
            z-index:2;
        }

        .pw-hero-badge{
            display:inline-flex;
            align-items:center;
            gap:8px;
            padding:8px 16px;
            border-radius:999px;
            background:rgba(255,255,255,.08);
            border:1px solid rgba(255,255,255,.12);

            font-size:13px;
            font-weight:600;
            color:#D8F3DC;

            margin-bottom:20px;
        }

        .pw-hero-badge-dot{
            width:8px;
            height:8px;
            border-radius:50%;
            background:#74C69D;
        }

        .pw-hero h1{
            font-size:46px;
            line-height:1.15;
            font-weight:800;
            color:white;
            margin-bottom:12px;
        }

        .pw-hero-sub{
            font-size:18px;
            color:rgba(255,255,255,.75);
        }

        /* STATS */

        .pw-stats{
            max-width:1400px;
            margin:-70px auto 0;
            padding:0 50px;

            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:24px;

            position:relative;
            z-index:10;
        }

        .pw-stat{
            background:white;
            border-radius:24px;
            padding:28px;
            border:1px solid var(--border);

            transition:.25s;
            box-shadow:
                0 10px 30px rgba(0,0,0,.04);
        }

        .pw-stat:hover{
            transform:translateY(-5px);
            box-shadow:
                0 20px 40px rgba(0,0,0,.08);
        }

        .pw-stat-top{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:22px;
        }

        .pw-stat-icon{
            width:56px;
            height:56px;
            border-radius:18px;

            display:flex;
            align-items:center;
            justify-content:center;
        }

        .pw-stat-icon svg{
            width:24px;
            height:24px;
            stroke-width:2;
            fill:none;
        }

        .si-a{
            background:#EAF7F0;
        }

        .si-a svg{
            stroke:#21543D;
        }

        .si-b{
            background:#E8F4FF;
        }

        .si-b svg{
            stroke:#2563EB;
        }

        .si-c{
            background:#FFF3E7;
        }

        .si-c svg{
            stroke:#B45309;
        }

        .si-d{
            background:#FDECEC;
        }

        .si-d svg{
            stroke:#C0392B;
        }

        .pw-stat-label{
            font-size:14px;
            font-weight:600;
            color:var(--muted);
            margin-bottom:10px;
        }

        .pw-stat-val{
            font-size:42px;
            font-weight:800;
            line-height:1;
            color:var(--text);
            margin-bottom:10px;
        }

        .sv-green{
            color:#1F7A4D;
        }

        .sv-bark{
            color:#B45309;
        }

        .sv-red{
            color:#C0392B;
        }

        .sv-sm{
            font-size:28px;
        }

        .pw-stat-hint{
            font-size:14px;
            color:var(--text2);
        }

        .pw-stat-trend{
            font-size:12px;
            font-weight:700;
            padding:7px 12px;
            border-radius:999px;
        }

        .trend-up{
            background:#EAF7F0;
            color:#1F7A4D;
        }

        .trend-warn{
            background:#FFF4E5;
            color:#A16207;
        }

        .trend-neutral{
            background:#F1F3F5;
            color:#5F6B65;
        }

        /* MAIN */

        .pw-main{
            max-width:1400px;
            margin:40px auto 0;
            padding:0 50px;
        }

        .pw-grid{
            display:grid;
            grid-template-columns:1fr 360px;
            gap:28px;
            align-items:start;
        }

        /* SECTION */

        .pw-sec-head{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:20px;
        }

        .pw-sec-title{
            font-size:28px;
            font-weight:800;
            color:var(--text);

            display:flex;
            align-items:center;
            gap:14px;
        }

        .pw-sec-title::before{
            content:'';
            width:6px;
            height:28px;
            border-radius:999px;
            background:var(--forest3);
        }

        /* BUTTON */

        .pw-btn{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            gap:10px;

            padding:14px 22px;
            border-radius:14px;

            background:var(--forest2);
            color:white;

            font-size:14px;
            font-weight:700;
            text-decoration:none;

            transition:.2s;
        }

        .pw-btn:hover{
            background:var(--forest);
            transform:translateY(-2px);
            color:white;
        }

        .pw-btn svg{
            width:18px;
            height:18px;
            stroke:white;
            stroke-width:2.2;
            fill:none;
        }

        /* TABLE */

        .pw-tcard{
            background:white;
            border-radius:24px;
            overflow:hidden;
            border:1px solid var(--border);

            box-shadow:
                0 10px 30px rgba(0,0,0,.03);
        }

        .pw-tcard table{
            width:100%;
            border-collapse:collapse;
        }

        .pw-tcard thead{
            background:var(--forest);
        }

        .pw-tcard thead th{
            padding:20px;

            font-size:13px;
            font-weight:700;
            letter-spacing:.08em;

            color:rgba(255,255,255,.7);
            text-transform:uppercase;

            text-align:left;
        }

        .pw-tcard tbody td{
            padding:22px 20px;
            border-bottom:1px solid #EEF2EF;
            font-size:15px;
            color:var(--text);
        }

        .pw-tcard tbody tr:hover{
            background:#F8FBF9;
        }

        .td-num{
            text-align:center;
            font-weight:700;
            color:var(--muted);
        }

        .td-book{
            font-size:16px;
            font-weight:700;
            color:var(--text);
        }

        .td-book-author{
            margin-top:5px;
            font-size:13px;
            color:var(--muted);
        }

        .td-date,
        .td-due{
            font-size:14px;
            font-weight:600;
        }

        .tc{
            text-align:center;
        }

        /* BADGE */

        .p-badge{
            display:inline-flex;
            align-items:center;
            gap:8px;

            padding:8px 14px;
            border-radius:999px;

            font-size:13px;
            font-weight:700;
        }

        .badge-dipinjam{
            background:#EAF7F0;
            color:#1F7A4D;
        }

        .badge-menunggu{
            background:#FFF4E5;
            color:#A16207;
        }

        .badge-kembali{
            background:#F1F3F5;
            color:#5F6B65;
        }

        .badge-terlambat{
            background:#FDECEC;
            color:#C0392B;
        }

        /* FOOTER */

        .pw-tfoot{
            padding:20px 24px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            background:#FAFCFB;
        }

        .pw-footlink{
            font-size:15px;
            font-weight:700;
            color:var(--forest2);
            text-decoration:none;
        }

        /* SIDEBAR */

        .pw-sidebar{
            display:flex;
            flex-direction:column;
            gap:24px;
        }

        .pw-card{
            background:white;
            border-radius:24px;
            border:1px solid var(--border);
            overflow:hidden;
        }

        .pw-card-head{
            padding:22px 24px;

            font-size:18px;
            font-weight:800;

            border-bottom:1px solid var(--border);

            color:var(--text);

            display:flex;
            align-items:center;
            gap:10px;
        }

        .pw-card-head svg{
            width:18px;
            height:18px;
            stroke:var(--forest3);
            stroke-width:2;
            fill:none;
        }

        /* NOTIF */

        .pw-notif-item{
            padding:18px 24px;
            border-bottom:1px solid #EEF2EF;

            display:flex;
            gap:14px;
            align-items:flex-start;
        }

        .pw-notif-dot{
            width:10px;
            height:10px;
            border-radius:50%;
            margin-top:7px;
            flex-shrink:0;
        }

        .dot-warn{
            background:#B45309;
        }

        .dot-ok{
            background:#1F7A4D;
        }

        .dot-red{
            background:#C0392B;
        }

        .pw-notif-text{
            font-size:14px;
            line-height:1.7;
            color:var(--text2);
        }

        .pw-notif-time{
            margin-top:5px;
            font-size:12px;
            color:var(--muted);
        }

        /* QUICK */

        .pw-quick{
            padding:22px;
            display:flex;
            flex-direction:column;
            gap:22px;
        }

        .pw-qrow{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:10px;
        }

        .pw-qrow-label{
            font-size:14px;
            font-weight:600;
            color:var(--text2);

            display:flex;
            align-items:center;
            gap:8px;
        }

        .pw-qrow-label svg{
            width:16px;
            height:16px;
            stroke-width:2;
            fill:none;
        }

        .pw-qrow-val{
            font-size:15px;
            font-weight:800;
            color:var(--text);
        }

        .qv-green{
            color:#1F7A4D;
        }

        .qv-bark{
            color:#B45309;
        }

        .qv-red{
            color:#C0392B;
        }

        .pw-bar-wrap{
            width:100%;
            height:8px;
            border-radius:999px;
            background:#EDF2EE;
            overflow:hidden;
        }

        .pw-bar{
            height:100%;
            border-radius:999px;
        }

        /* RESPONSIVE */

        @media(max-width:1200px){

            .pw-stats{
                grid-template-columns:repeat(2,1fr);
            }

            .pw-grid{
                grid-template-columns:1fr;
            }
        }

        @media(max-width:768px){

            .pw-hero{
                padding:40px 24px 110px;
            }

            .pw-main,
            .pw-stats{
                padding:0 20px;
            }

            .pw-stats{
                grid-template-columns:1fr;
            }

            .pw-sec-head{
                flex-direction:column;
                align-items:flex-start;
                gap:14px;
            }

            .pw-hero h1{
                font-size:34px;
            }

            .pw-sec-title{
                font-size:24px;
            }

            .pw-stat-val{
                font-size:36px;
            }

            .pw-tcard{
                overflow-x:auto;
            }

            table{
                min-width:700px;
            }
        }
    </style>

    <div class="pw">

        {{-- HERO --}}
        <div class="pw-hero">
            <div class="pw-hero-inner">

                <div class="pw-hero-badge">
                    <div class="pw-hero-badge-dot"></div>
                    ADMIN DASHBOARD
                </div>

                <h1>
                    Selamat Datang, Admin 👑
                </h1>

                <p class="pw-hero-sub">
                    Pustakara Library Management System
                    ·
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </p>

            </div>
        </div>

        {{-- STATS --}}
        <div class="pw-stats">

            {{-- TOTAL BUKU --}}
            <div class="pw-stat">

                <div class="pw-stat-top">

                    <div class="pw-stat-icon si-a">
                        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                        </svg>
                    </div>

                    <span class="pw-stat-trend trend-up">
                        Koleksi aktif
                    </span>

                </div>

                <div class="pw-stat-label">
                    Total Buku
                </div>

                <div class="pw-stat-val">
                    {{ number_format($totalBuku) }}
                </div>

                <div class="pw-stat-hint">
                    judul tersedia
                </div>

            </div>

            {{-- TOTAL ANGGOTA --}}
            <div class="pw-stat">

                <div class="pw-stat-top">

                    <div class="pw-stat-icon si-b">
                        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                    </div>

                    <span class="pw-stat-trend trend-up">
                        Aktif
                    </span>

                </div>

                <div class="pw-stat-label">
                    Total Anggota
                </div>

                <div class="pw-stat-val sv-green">
                    {{ number_format($totalAnggota) }}
                </div>

                <div class="pw-stat-hint">
                    anggota terdaftar
                </div>

            </div>

        </div>

    </div>
</x-app-layout>