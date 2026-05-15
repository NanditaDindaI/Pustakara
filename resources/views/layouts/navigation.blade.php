<style>
    /* ── NAVBAR ──────────────────────────────────────────── */
    .pus-nav {
        background: linear-gradient(155deg, var(--bark) 0%, var(--bark2) 40%, var(--bark3) 80%, #7A4A28 100%);
        border-bottom: 2.5px solid;
        border-image: linear-gradient(90deg, var(--leaf0), var(--leaf3), var(--gold), var(--gold2), var(--leaf3), var(--leaf0)) 1;
        box-shadow: 0 4px 28px rgba(30,15,8,0.5);
        position: relative;
        z-index: 50;
    }
    .pus-nav::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 55% 120% at 50% -10%, rgba(201,168,76,0.07) 0%, transparent 65%);
        pointer-events: none;
    }
    .pus-nav-inner {
        max-width: 80rem;
        margin: 0 auto;
        padding: 0 1.5rem;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1.5rem;
    }

    /* Brand */
    .pus-brand {
        font-family: 'Syne', sans-serif;
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--gold2);
        text-decoration: none;
        letter-spacing: 0.12em;
        display: flex;
        align-items: center;
        gap: 9px;
        text-shadow: 0 0 20px rgba(201,168,76,0.3);
        flex-shrink: 0;
    }
    .pus-brand-icon {
        width: 32px; height: 32px;
        border-radius: 8px;
        background: linear-gradient(135deg, var(--leaf1) 0%, var(--leaf3) 60%, var(--leaf4) 100%);
        border: 1.5px solid rgba(201,168,76,0.45);
        display: flex; align-items: center; justify-content: center;
        font-size: 16px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.35), inset 0 1px 0 rgba(255,255,255,0.12);
    }

    /* Nav links */
    .pus-links {
        display: flex;
        align-items: center;
        gap: 2px;
        list-style: none;
        margin: 0; padding: 0;
    }
    .pus-links a {
        color: rgba(242,234,213,0.72);
        text-decoration: none;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.82rem;
        font-weight: 600;
        padding: 6px 13px;
        border-radius: 8px;
        transition: all 0.2s;
        letter-spacing: 0.02em;
        position: relative;
        display: inline-block;
    }
    .pus-links a:hover {
        color: var(--gold2);
        background: rgba(201,168,76,0.1);
    }
    .pus-links a.pus-active {
        color: var(--gold);
        background: linear-gradient(135deg, rgba(201,168,76,0.16) 0%, rgba(86,150,51,0.1) 100%);
        border: 1px solid rgba(201,168,76,0.25);
    }
    .pus-links a.pus-active::after {
        content: '';
        position: absolute;
        bottom: -1px; left: 13px; right: 13px;
        height: 2px;
        background: linear-gradient(90deg, var(--leaf3), var(--gold), var(--leaf3));
        border-radius: 2px;
    }

    /* User dropdown trigger */
    .pus-user-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.07);
        border: 1px solid rgba(201,168,76,0.28);
        border-radius: 999px;
        padding: 5px 14px 5px 6px;
        color: var(--parchment);
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.82rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .pus-user-btn:hover {
        background: rgba(255,255,255,0.13);
        border-color: var(--gold);
    }
    .pus-avatar {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--leaf1), var(--leaf4));
        border: 1.5px solid var(--gold);
        display: flex; align-items: center; justify-content: center;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 10px; font-weight: 800; color: #fff;
        box-shadow: 0 0 8px rgba(86,150,51,0.35);
        flex-shrink: 0;
    }

    /* Mobile hamburger */
    .pus-hamburger {
        color: var(--gold2);
        background: none;
        border: none;
        cursor: pointer;
        padding: 4px;
        display: none;
    }

    /* Mobile menu */
    .pus-mobile {
        display: none;
        background: linear-gradient(180deg, var(--bark2) 0%, var(--bark) 100%);
        border-top: 1px solid rgba(201,168,76,0.2);
        padding: 12px 20px 16px;
    }
    .pus-mobile a {
        display: block;
        color: rgba(242,234,213,0.78);
        text-decoration: none;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.87rem;
        font-weight: 600;
        padding: 9px 0;
        border-bottom: 1px solid rgba(201,168,76,0.08);
        letter-spacing: 0.02em;
        transition: color 0.2s;
    }
    .pus-mobile a:last-child { border-bottom: none; }
    .pus-mobile a:hover { color: var(--gold2); }
    .pus-mobile a.pus-active { color: var(--gold); }
    .pus-mobile-user {
        padding-top: 14px;
        margin-top: 10px;
        border-top: 1px solid rgba(201,168,76,0.2);
    }
    .pus-mobile-user-name {
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        color: var(--gold2);
        font-size: 0.9rem;
        letter-spacing: 0.03em;
    }
    .pus-mobile-user-email {
        color: var(--latte);
        font-size: 0.77rem;
        margin-top: 2px;
    }
    .pus-mobile-actions { margin-top: 10px; display: flex; gap: 8px; }
    .pus-mobile-actions a,
    .pus-mobile-actions button {
        display: inline-block;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        text-decoration: none;
        background: none;
        border: 1px solid rgba(201,168,76,0.3);
        color: var(--gold2);
        padding: 6px 16px;
        border-radius: 999px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .pus-mobile-actions a:hover,
    .pus-mobile-actions button:hover {
        background: rgba(201,168,76,0.12);
        border-color: var(--gold);
    }

    @media (max-width: 640px) {
        .pus-links, .pus-user-area-desktop { display: none !important; }
        .pus-hamburger { display: block; }
    }
</style>

<nav class="pus-nav" x-data="{ open: false }">
    <div class="pus-nav-inner">

        {{-- Brand --}}
        <a href="{{ Auth::user()->role === 'administrator' ? route('admin.dashboard') : route('anggota.dashboard') }}"
           class="pus-brand">
            <div class="pus-brand-icon">📚</div>
            PUSTAKARA
        </a>

        {{-- Desktop links --}}
        <ul class="pus-links" style="display:flex;">
            @if(Auth::user()->role === 'administrator')
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                       class="{{ request()->routeIs('admin.dashboard') ? 'pus-active' : '' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('kategori.index') }}"
                       class="{{ request()->routeIs('kategori.*') ? 'pus-active' : '' }}">
                        Kategori
                    </a>
                </li>
                <li>
                    <a href="{{ route('buku.index') }}"
                       class="{{ request()->routeIs('buku.*') ? 'pus-active' : '' }}">
                        Buku
                    </a>
                </li>
                <li>
                    <a href="{{ route('anggota-admin.index') }}"
                       class="{{ request()->routeIs('anggota-admin.*') ? 'pus-active' : '' }}">
                        Anggota
                    </a>
                </li>
                <li>
                    <a href="{{ route('peminjaman.index') }}"
                       class="{{ request()->routeIs('peminjaman.*') ? 'pus-active' : '' }}">
                        Peminjaman
                    </a>
                </li>
                <li>
                    <a href="{{ route('denda.index') }}"
                       class="{{ request()->routeIs('denda.*') ? 'pus-active' : '' }}">
                        Denda
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('anggota.dashboard') }}"
                       class="{{ request()->routeIs('anggota.dashboard') ? 'pus-active' : '' }}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('anggota.katalog.index') }}"
                       class="{{ request()->routeIs('anggota.katalog.*') ? 'pus-active' : '' }}">
                        Katalog Buku
                    </a>
                </li>
                <li>
                    <a href="{{ route('anggota.riwayat.index') }}"
                       class="{{ request()->routeIs('anggota.riwayat.*') ? 'pus-active' : '' }}">
                        Riwayat
                    </a>
                </li>
            @endif
        </ul>

        {{-- Desktop user dropdown --}}
        <div class="pus-user-area-desktop" style="display:flex;align-items:center;">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="pus-user-btn">
                        <div class="pus-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                        <svg width="12" height="12" viewBox="0 0 20 20" fill="currentColor" style="opacity:0.6;flex-shrink:0;">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>

        {{-- Mobile hamburger --}}
        <button class="pus-hamburger" @click="open = !open" aria-label="Toggle menu">
            <svg width="24" height="24" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open}"    class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': !open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Mobile menu --}}
    <div class="pus-mobile" :class="{'block': open, 'hidden': !open}" style="display:none;">
        @if(Auth::user()->role === 'administrator')
            <a href="{{ route('admin.dashboard') }}"     class="{{ request()->routeIs('admin.dashboard') ? 'pus-active' : '' }}">Dashboard</a>
            <a href="{{ route('kategori.index') }}"      class="{{ request()->routeIs('kategori.*') ? 'pus-active' : '' }}">Kategori</a>
            <a href="{{ route('buku.index') }}"          class="{{ request()->routeIs('buku.*') ? 'pus-active' : '' }}">Buku</a>
            <a href="{{ route('anggota-admin.index') }}" class="{{ request()->routeIs('anggota-admin.*') ? 'pus-active' : '' }}">Anggota</a>
            <a href="{{ route('peminjaman.index') }}"    class="{{ request()->routeIs('peminjaman.*') ? 'pus-active' : '' }}">Peminjaman</a>
            <a href="{{ route('denda.index') }}"         class="{{ request()->routeIs('denda.*') ? 'pus-active' : '' }}">Denda</a>
        @else
            <a href="{{ route('anggota.dashboard') }}"      class="{{ request()->routeIs('anggota.dashboard') ? 'pus-active' : '' }}">Dashboard</a>
            <a href="{{ route('anggota.katalog.index') }}"  class="{{ request()->routeIs('anggota.katalog.*') ? 'pus-active' : '' }}">Katalog Buku</a>
            <a href="{{ route('anggota.riwayat.index') }}"  class="{{ request()->routeIs('anggota.riwayat.*') ? 'pus-active' : '' }}">Riwayat</a>
        @endif

        <div class="pus-mobile-user">
            <div class="pus-mobile-user-name">{{ Auth::user()->name }}</div>
            <div class="pus-mobile-user-email">{{ Auth::user()->email }}</div>
            <div class="pus-mobile-actions">
                <a href="{{ route('profile.edit') }}">Profile</a>
                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                    @csrf
                    <button type="submit">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</nav>