<div id="custom-alert-overlay" class="custom-alert-overlay theme-{{ $popupTheme }} blur-{{ $backdrop_blur }}" style="display: flex;">
    <div class="custom-alert-card">
        <div class="custom-alert-header">
            <h2>{{ $title }}</h2>
        </div>
        <div class="custom-alert-body">
            {!! $message !!}
        </div>
        <div class="custom-alert-footer">
            @foreach($buttons as $button)
                @php
                    $btnStyle = $button['style'] ?? 'primary';
                    $btnAction = $button['action'] ?? 'close';
                    $btnLink = $button['link'] ?? '#';
                    $btnText = $button['text'] ?? 'Chiudi';
                @endphp
                <button type="button" 
                        class="custom-alert-btn btn-style-{{ $btnStyle }}"
                        onclick="handleAlertInteraction('{{ e($btnText) }}', '{{ e($btnAction) }}', '{{ e($btnLink) }}')">
                    {{ $btnText }}
                </button>
            @endforeach
        </div>
    </div>
</div>

<style>
/* CSS Styles for the global fullscreen Custom Alert Overlay */
.custom-alert-overlay {
    position: fixed;
    inset: 0;
    z-index: 999999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
    transition: opacity 0.4s ease, visibility 0.4s ease;
    opacity: 0;
    visibility: hidden;
}

/* Animations */
.custom-alert-overlay.show {
    opacity: 1;
    visibility: visible;
}

.custom-alert-card {
    width: 100%;
    max-width: 540px;
    border-radius: 24px;
    padding: 2.25rem;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    transform: scale(0.9) translateY(20px);
    transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
}

.custom-alert-overlay.show .custom-alert-card {
    transform: scale(1) translateY(0);
}

/* Backdrop Blur Strengths */
.custom-alert-overlay.blur-none { backdrop-filter: none; -webkit-backdrop-filter: none; }
.custom-alert-overlay.blur-low { backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px); }
.custom-alert-overlay.blur-medium { backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
.custom-alert-overlay.blur-high { backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px); }

/* Theme Styles */

/* 1. Slate Dark Glass Theme */
.theme-dark_glass {
    background-color: rgba(15, 23, 42, 0.45);
}
.theme-dark_glass .custom-alert-card {
    background: rgba(30, 41, 59, 0.7);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: #f8fafc;
}
.theme-dark_glass .custom-alert-header h2 {
    color: #ffffff;
    font-size: 1.6rem;
    font-weight: 700;
    margin: 0;
}
.theme-dark_glass .custom-alert-body {
    color: #cbd5e1;
    font-size: 1.05rem;
    line-height: 1.6;
}

/* 2. Pearl Light Glass Theme */
.theme-light_glass {
    background-color: rgba(241, 245, 249, 0.4);
}
.theme-light_glass .custom-alert-card {
    background: rgba(255, 255, 255, 0.7);
    border: 1px solid rgba(0, 0, 0, 0.08);
    color: #0f172a;
}
.theme-light_glass .custom-alert-header h2 {
    color: #0f172a;
    font-size: 1.6rem;
    font-weight: 700;
    margin: 0;
}
.theme-light_glass .custom-alert-body {
    color: #334155;
    font-size: 1.05rem;
    line-height: 1.6;
}

/* 3. Minimalist Clean Light Theme */
.theme-minimal_light {
    background-color: rgba(0, 0, 0, 0.3);
}
.theme-minimal_light .custom-alert-card {
    background: #ffffff;
    border: none;
    color: #1e293b;
}
.theme-minimal_light .custom-alert-header h2 {
    color: #0f172a;
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
}
.theme-minimal_light .custom-alert-body {
    color: #475569;
    font-size: 1rem;
    line-height: 1.5;
}

/* 4. Vibrant Aurora Theme */
.theme-vibrant_aurora {
    background-image: radial-gradient(at 0% 0%, rgba(255, 87, 34, 0.15) 0px, transparent 50%),
                      radial-gradient(at 100% 100%, rgba(139, 92, 246, 0.15) 0px, transparent 50%);
    background-color: rgba(15, 23, 42, 0.5);
}
.theme-vibrant_aurora .custom-alert-card {
    background: rgba(17, 24, 39, 0.8);
    border: 1px solid rgba(139, 92, 246, 0.2);
    color: #f9fafb;
    box-shadow: 0 0 40px -10px rgba(139, 92, 246, 0.3);
}
.theme-vibrant_aurora .custom-alert-header h2 {
    background: linear-gradient(135deg, #ff5722, #a78bfa);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 1.7rem;
    font-weight: 800;
    margin: 0;
}
.theme-vibrant_aurora .custom-alert-body {
    color: #e5e7eb;
    font-size: 1.05rem;
    line-height: 1.6;
}

/* Footer & Buttons */
.custom-alert-footer {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-end;
    gap: 0.75rem;
    margin-top: 0.5rem;
}

.custom-alert-btn {
    cursor: pointer;
    font-family: inherit;
    font-weight: 600;
    font-size: 0.95rem;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    box-sizing: border-box;
    border: none;
    outline: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.custom-alert-btn:hover {
    transform: translateY(-2px);
}

.custom-alert-btn:active {
    transform: translateY(0);
}

/* Button Colors Style classes */
/* Solid primary */
.btn-style-primary {
    background: #ff5722;
    color: #ffffff;
    box-shadow: 0 4px 14px 0 rgba(255, 87, 34, 0.3);
}
.btn-style-primary:hover {
    background: #f4511e;
    box-shadow: 0 6px 20px 0 rgba(255, 87, 34, 0.4);
}

/* Glass secondary outline */
.btn-style-secondary {
    background: rgba(255, 255, 255, 0.08);
    color: inherit;
    border: 1px solid rgba(255, 255, 255, 0.15);
}
.btn-style-secondary:hover {
    background: rgba(255, 255, 255, 0.15);
    border-color: rgba(255, 255, 255, 0.25);
}
.theme-light_glass .btn-style-secondary,
.theme-minimal_light .btn-style-secondary {
    background: rgba(0, 0, 0, 0.04);
    color: #0f172a;
    border: 1px solid rgba(0, 0, 0, 0.1);
}
.theme-light_glass .btn-style-secondary:hover,
.theme-minimal_light .btn-style-secondary:hover {
    background: rgba(0, 0, 0, 0.08);
}

/* Red Accent Danger */
.btn-style-danger {
    background: #ef4444;
    color: #ffffff;
    box-shadow: 0 4px 14px 0 rgba(239, 68, 68, 0.3);
}
.btn-style-danger:hover {
    background: #dc2626;
    box-shadow: 0 6px 20px 0 rgba(239, 68, 68, 0.4);
}

/* Simple Outline */
.btn-style-outline {
    background: transparent;
    color: inherit;
    border: 1px solid currentColor;
}
.btn-style-outline:hover {
    background: rgba(255, 255, 255, 0.05);
}
.theme-light_glass .btn-style-outline:hover,
.theme-minimal_light .btn-style-outline:hover {
    background: rgba(0, 0, 0, 0.03);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const overlay = document.getElementById('custom-alert-overlay');
    if (overlay) {
        setTimeout(() => {
            overlay.classList.add('show');
        }, 100);
    }
});

function handleAlertInteraction(buttonText, action, link) {
    const overlay = document.getElementById('custom-alert-overlay');
    if (!overlay) return;

    overlay.classList.remove('show');
    overlay.style.pointerEvents = 'none';

    const configHash = '{{ $config_hash }}';
    const cookieName = 'paolorox_customalert_dismissed';
    const d = new Date();
    d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
    document.cookie = cookieName + '=' + configHash + ';path=/;expires=' + d.toUTCString() + ';SameSite=Lax';

    fetch('/customalert/log-interaction', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            config_hash: configHash,
            button_clicked: buttonText,
            status: 'dismissed'
        })
    }).catch(err => console.error('Failed to log alert interaction:', err));

    if (action === 'link' && link && link !== '#') {
        setTimeout(() => {
            window.location.href = link;
        }, 300);
    } else {
        setTimeout(() => {
            overlay.remove();
        }, 500);
    }
}
</script>
