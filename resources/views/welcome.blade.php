<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Notes Manager') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=dm-serif-display:400,400i&family=dm-sans:300,400,500" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

            :root {
                --bg: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                --surface: #fff;
                --surface-hover: rgba(108,99,255,0.06);
                --border: rgba(108,99,255,0.15);
                --border-accent: rgba(108,99,255,0.35);
                --text: #2c3e50;
                --muted: #6c757d;
                --accent: #6c63ff;
                --accent-dark: #5a4fb8;
                --accent-bg: rgba(108,99,255,0.08);
            }

            body {
                font-family: 'DM Sans', sans-serif;
                background: var(--bg);
                color: var(--text);
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                -webkit-font-smoothing: antialiased;
            }

            /* ── NAV ── */
            nav.topnav {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 1.25rem 3rem;
                background: linear-gradient(135deg, #6c63ff 0%, #5a4fb8 100%);
                box-shadow: 0 4px 15px rgba(108,99,255,0.25);
            }

            .logo {
                font-family: 'DM Serif Display', serif;
                font-size: 1.35rem;
                color: #fff;
                letter-spacing: -0.02em;
            }

            .logo i { margin-right: 0.4rem; font-size: 1.1rem; }

            .nav-actions { display: flex; align-items: center; gap: 0.75rem; }

            .btn-outline {
                display: inline-block;
                padding: 0.45rem 1.25rem;
                border: 1px solid rgba(255,255,255,0.4);
                border-radius: 2rem;
                font-family: 'DM Sans', sans-serif;
                font-size: 0.8rem;
                font-weight: 400;
                color: rgba(255,255,255,0.85);
                text-decoration: none;
                transition: all 0.2s;
                background: transparent;
            }

            .btn-outline:hover {
                background: rgba(255,255,255,0.15);
                color: #fff;
            }

            .btn-solid {
                display: inline-block;
                padding: 0.45rem 1.25rem;
                border: none;
                border-radius: 2rem;
                font-family: 'DM Sans', sans-serif;
                font-size: 0.8rem;
                font-weight: 500;
                color: var(--accent);
                background: #fff;
                text-decoration: none;
                transition: all 0.2s;
            }

            .btn-solid:hover { background: #f0eeff; }

            /* ── HERO ── */
            .hero {
                flex: 1;
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 5rem;
                align-items: center;
                max-width: 1100px;
                margin: 0 auto;
                padding: 5rem 3rem 4rem;
                width: 100%;
            }

            .eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                background: var(--accent-bg);
                border: 1px solid var(--border-accent);
                color: var(--accent);
                font-size: 0.7rem;
                letter-spacing: 0.09em;
                padding: 0.3rem 0.9rem;
                border-radius: 2rem;
                margin-bottom: 1.75rem;
                font-weight: 500;
            }

            .pulse {
                width: 6px; height: 6px;
                background: var(--accent);
                border-radius: 50%;
                display: inline-block;
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.3; }
            }

            h1 {
                font-family: 'DM Serif Display', serif;
                font-size: 3.4rem;
                line-height: 1.08;
                letter-spacing: -0.03em;
                color: var(--text);
                margin-bottom: 1.25rem;
            }

            h1 em { font-style: italic; color: var(--accent); }

            .hero-desc {
                color: var(--muted);
                font-size: 1rem;
                line-height: 1.75;
                font-weight: 300;
                margin-bottom: 2rem;
            }

            .checklist {
                list-style: none;
                margin-bottom: 2.5rem;
                display: flex;
                flex-direction: column;
                gap: 0.6rem;
            }

            .checklist li {
                display: flex;
                align-items: center;
                gap: 0.65rem;
                font-size: 0.875rem;
                color: var(--muted);
                font-weight: 300;
            }

            .checklist li::before {
                content: '✦';
                color: var(--accent);
                font-size: 0.7rem;
                flex-shrink: 0;
            }

            .cta-group {
                display: flex;
                align-items: center;
                gap: 1rem;
                flex-wrap: wrap;
            }

            .btn-cta-primary {
                display: inline-block;
                padding: 0.85rem 2rem;
                background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
                color: #fff;
                border: none;
                border-radius: 2rem;
                font-family: 'DM Sans', sans-serif;
                font-size: 0.875rem;
                font-weight: 500;
                text-decoration: none;
                transition: all 0.2s;
                box-shadow: 0 4px 14px rgba(108,99,255,0.3);
            }

            .btn-cta-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(108,99,255,0.4);
                color: #fff;
            }

            .btn-cta-ghost {
                display: inline-block;
                padding: 0.85rem 1.75rem;
                background: #fff;
                color: var(--accent);
                border: 1px solid var(--border-accent);
                border-radius: 2rem;
                font-family: 'DM Sans', sans-serif;
                font-size: 0.875rem;
                font-weight: 400;
                text-decoration: none;
                transition: all 0.2s;
            }

            .btn-cta-ghost:hover {
                background: var(--accent-bg);
                color: var(--accent-dark);
            }

            /* ── NOTE CARDS ── */
            .hero-cards {
                display: flex;
                flex-direction: column;
                gap: 0.9rem;
            }

            .note-card {
                background: #fff;
                border: 1px solid var(--border);
                border-radius: 1rem;
                padding: 1.25rem 1.5rem;
                transition: all 0.25s;
                cursor: default;
                box-shadow: 0 2px 8px rgba(108,99,255,0.08);
            }

            .note-card:hover {
                border-color: var(--border-accent);
                transform: translateX(4px);
                box-shadow: 0 4px 16px rgba(108,99,255,0.15);
            }

            .note-card.featured {
                background: var(--accent-bg);
                border-color: var(--border-accent);
            }

            .note-tag {
                display: inline-block;
                background: var(--accent-bg);
                color: var(--accent);
                font-size: 0.62rem;
                letter-spacing: 0.07em;
                padding: 0.18rem 0.55rem;
                border-radius: 1rem;
                margin-bottom: 0.55rem;
                font-weight: 600;
            }

            .note-title {
                font-family: 'DM Serif Display', serif;
                font-size: 0.95rem;
                color: var(--text);
                margin-bottom: 0.35rem;
            }

            .note-preview {
                font-size: 0.78rem;
                color: var(--muted);
                line-height: 1.5;
                font-weight: 300;
            }

            .note-meta {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 0.75rem;
            }

            .note-date {
                font-size: 0.68rem;
                color: rgba(44,62,80,0.4);
                letter-spacing: 0.04em;
            }

            .avatars { display: flex; }

            .av {
                width: 20px; height: 20px;
                border-radius: 50%;
                border: 1.5px solid #fff;
                margin-left: -5px;
                font-size: 0.52rem;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
                color: #fff;
            }

            /* ── STATS ── */
            .stats-bar {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1px;
                background: var(--border);
                max-width: 1100px;
                margin: 0 auto 4rem;
                width: calc(100% - 6rem);
                border-radius: 1rem;
                overflow: hidden;
                box-shadow: 0 2px 12px rgba(108,99,255,0.1);
            }

            .stat {
                background: #fff;
                padding: 1.75rem;
                text-align: center;
            }

            .stat-num {
                font-family: 'DM Serif Display', serif;
                font-size: 2.2rem;
                color: var(--accent);
                letter-spacing: -0.03em;
                display: block;
            }

            .stat-label {
                font-size: 0.7rem;
                color: var(--muted);
                letter-spacing: 0.07em;
                margin-top: 0.2rem;
                display: block;
            }

            /* ── FEATURES ── */
            .features {
                max-width: 1100px;
                margin: 0 auto 5rem;
                padding: 0 3rem;
                width: 100%;
            }

            .section-eyebrow {
                font-size: 0.7rem;
                letter-spacing: 0.1em;
                color: var(--accent);
                margin-bottom: 2.5rem;
                font-weight: 600;
            }

            .feat-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 1px;
                background: var(--border);
                border-radius: 1rem;
                overflow: hidden;
                box-shadow: 0 2px 12px rgba(108,99,255,0.1);
            }

            .feat-item {
                background: #fff;
                padding: 2rem;
                transition: background 0.2s;
            }

            .feat-item:hover { background: var(--accent-bg); }

            .feat-icon {
                width: 38px; height: 38px;
                background: var(--accent-bg);
                border-radius: 0.6rem;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.1rem;
                margin-bottom: 1.1rem;
            }

            .feat-title {
                font-family: 'DM Serif Display', serif;
                font-size: 1rem;
                color: var(--text);
                margin-bottom: 0.45rem;
            }

            .feat-desc {
                font-size: 0.78rem;
                color: var(--muted);
                line-height: 1.6;
                font-weight: 300;
            }

            /* ── CTA BOTTOM ── */
            .cta-bottom {
                text-align: center;
                padding: 0 3rem 5rem;
                max-width: 650px;
                margin: 0 auto;
            }

            .cta-bottom h2 {
                font-family: 'DM Serif Display', serif;
                font-size: 2.6rem;
                color: var(--text);
                margin-bottom: 1rem;
                letter-spacing: -0.03em;
                line-height: 1.15;
            }

            .cta-bottom h2 em { color: var(--accent); font-style: italic; }

            .cta-bottom p {
                color: var(--muted);
                font-size: 0.95rem;
                line-height: 1.7;
                margin-bottom: 2.25rem;
                font-weight: 300;
            }

            .cta-bottom-btns { display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap; }

            /* ── FOOTER ── */
            footer {
                background: linear-gradient(135deg, #6c63ff 0%, #5a4fb8 100%);
                padding: 1.75rem 3rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .footer-logo {
                font-family: 'DM Serif Display', serif;
                font-size: 0.95rem;
                color: rgba(255,255,255,0.7);
            }

            .footer-links { display: flex; gap: 2rem; }

            .footer-links a {
                font-size: 0.73rem;
                color: rgba(255,255,255,0.5);
                text-decoration: none;
                font-weight: 300;
                letter-spacing: 0.04em;
                transition: color 0.2s;
            }

            .footer-links a:hover { color: #fff; }

            /* ── RESPONSIVE ── */
            @media (max-width: 900px) {
                nav.topnav { padding: 1.25rem 1.5rem; }
                .hero { grid-template-columns: 1fr; gap: 3rem; padding: 3rem 1.5rem 2.5rem; }
                h1 { font-size: 2.5rem; }
                .stats-bar { width: calc(100% - 3rem); margin-bottom: 3rem; }
                .feat-grid { grid-template-columns: 1fr 1fr; }
                .features { padding: 0 1.5rem; }
                .cta-bottom { padding: 0 1.5rem 4rem; }
                footer { padding: 1.5rem; flex-direction: column; gap: 1rem; text-align: center; }
            }

            @media (max-width: 560px) {
                .feat-grid { grid-template-columns: 1fr; }
                .stats-bar { grid-template-columns: 1fr; }
                h1 { font-size: 2.1rem; }
                .cta-bottom h2 { font-size: 2rem; }
            }
        </style>
    </head>
    <body>

        {{-- ── NAVIGATION ── --}}
        <nav class="topnav">
            <div class="logo"><i class="fas fa-sticky-note"></i>Notes Manager</div>

            @if (Route::has('login'))
                <div class="nav-actions">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-outline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-outline">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-solid">Get started</a>
                        @endif
                    @endauth
                </div>
            @endif
        </nav>

        {{-- ── HERO ── --}}
        <section class="hero">
            <div>
                <div class="eyebrow"><span class="pulse"></span> Now available</div>
                <h1>Think clearly,<br><em>write freely</em></h1>
                <p class="hero-desc">
                    A refined note-taking experience for people who take their ideas seriously. Capture, organize, and collaborate — without the noise.
                </p>
                <ul class="checklist">
                    <li>Create and organize unlimited notes</li>
                    <li>Collaborate with team members</li>
                    <li>Beautiful, responsive design</li>
                    <li>Fast and reliable</li>
                </ul>
                <div class="cta-group">
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-cta-primary">Get started free</a>
                    @endif
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn-cta-ghost">Sign in</a>
                    @endif
                </div>
            </div>

            <div class="hero-cards">
                <div class="note-card featured">
                    <div class="note-tag">✦ PINNED</div>
                    <div class="note-title">Q4 Product Roadmap</div>
                    <div class="note-preview">Launch redesigned onboarding, ship mobile app v2, integrate tagging across all workspaces...</div>
                    <div class="note-meta">
                        <div class="note-date">Today, 9:41 AM</div>
                        <div class="avatars">
                            <div class="av" style="background:#6c63ff">J</div>
                            <div class="av" style="background:#5a4fb8">M</div>
                            <div class="av" style="background:#4ecdc4">R</div>
                        </div>
                    </div>
                </div>
                <div class="note-card">
                    <div class="note-tag">IDEAS</div>
                    <div class="note-title">Brand refresh concepts</div>
                    <div class="note-preview">Earthy tones, serif typography, less chrome. Let the content breathe...</div>
                    <div class="note-meta">
                        <div class="note-date">Yesterday</div>
                        <div class="avatars"><div class="av" style="background:#6c63ff">J</div></div>
                    </div>
                </div>
                <div class="note-card">
                    <div class="note-tag">READING</div>
                    <div class="note-title">Thinking, Fast and Slow — notes</div>
                    <div class="note-preview">System 1 vs System 2. Anchoring effect in negotiations. Loss aversion ~2x...</div>
                    <div class="note-meta">
                        <div class="note-date">2 days ago</div>
                        <div class="avatars"><div class="av" style="background:#5a4fb8">M</div></div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ── STATS ── --}}
        <div class="stats-bar">
            <div class="stat">
                <span class="stat-num">50k+</span>
                <span class="stat-label">ACTIVE USERS</span>
            </div>
            <div class="stat">
                <span class="stat-num">2M+</span>
                <span class="stat-label">NOTES CREATED</span>
            </div>
            <div class="stat">
                <span class="stat-num">99.9%</span>
                <span class="stat-label">UPTIME</span>
            </div>
        </div>

        {{-- ── FEATURES ── --}}
        <section class="features">
            <div class="section-eyebrow">WHAT MAKES IT DIFFERENT</div>
            <div class="feat-grid">
                <div class="feat-item">
                    <div class="feat-icon">✍️</div>
                    <div class="feat-title">Easy note creation</div>
                    <p class="feat-desc">A distraction-free writing environment that gets out of your way. Just you and your ideas.</p>
                </div>
                <div class="feat-item">
                    <div class="feat-icon">🏷</div>
                    <div class="feat-title">Smart organization</div>
                    <p class="feat-desc">Tag, nest, and cross-reference notes effortlessly. Find anything in seconds with instant search.</p>
                </div>
                <div class="feat-item">
                    <div class="feat-icon">👥</div>
                    <div class="feat-title">Collaboration</div>
                    <p class="feat-desc">Share workspaces and edit together in real-time. Comments, mentions, and live cursors included.</p>
                </div>
                <div class="feat-item">
                    <div class="feat-icon">📱</div>
                    <div class="feat-title">Works everywhere</div>
                    <p class="feat-desc">Native apps for iOS, Android, Mac, and Windows. Your notes sync instantly across all devices.</p>
                </div>
                <div class="feat-item">
                    <div class="feat-icon">🔒</div>
                    <div class="feat-title">Secure & private</div>
                    <p class="feat-desc">End-to-end encryption on all your notes. Your thoughts stay yours — we can't read them either.</p>
                </div>
                <div class="feat-item">
                    <div class="feat-icon">⚡</div>
                    <div class="feat-title">Blazing fast</div>
                    <p class="feat-desc">Zero loading spinners. Notes open instantly, search returns results as you type.</p>
                </div>
            </div>
        </section>

        {{-- ── CTA BOTTOM ── --}}
        <section class="cta-bottom">
            <h2>Your best ideas deserve a <em>better home</em></h2>
            <p>Join thousands of writers, teams, and thinkers who've switched to a calmer, smarter way to take notes.</p>
            <div class="cta-bottom-btns">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn-cta-primary">Start for free</a>
                @endif
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="btn-cta-ghost">Sign in</a>
                @endif
            </div>
        </section>

        {{-- ── FOOTER ── --}}
        <footer>
            <div class="footer-logo"><i class="fas fa-sticky-note"></i> NotesManager</div>
            <div class="footer-links">
                <a href="#">Privacy</a>
                <a href="#">Terms</a>
                <a href="#">Help</a>
            </div>
        </footer>

    </body>
</html>