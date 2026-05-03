<div id="cookie-banner" class="fixed bottom-0 left-0 w-full z-[9999] transform translate-y-full transition-transform duration-1000 ease-in-out" style="display: none; pointer-events: all;">
    <div class="max-w-7xl mx-auto px-4 pb-6">
        <div class="bg-slate-900/95 backdrop-blur-3xl border border-white/20 rounded-3xl p-8 shadow-[0_20px_50px_rgba(0,0,0,0.5)] flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="flex items-center gap-6">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-500 to-pink-600 flex items-center justify-center flex-shrink-0 shadow-lg shadow-rose-500/20">
                    <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-black text-lg tracking-tight mb-1 uppercase">Cookie Protocol</h4>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-xl font-medium">
                        We use specialized technical cookies to optimize your digital architecture and ensure the highest performance. By accepting, you consent to our security protocols.
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-4 w-full md:w-auto">
                <button onclick="handleCookieConsent('rejected')" class="flex-1 md:flex-none px-8 py-3 rounded-2xl text-slate-400 hover:text-white text-[11px] font-black uppercase tracking-[0.2em] transition-all hover:bg-white/5">
                    Reject All
                </button>
                <button onclick="handleCookieConsent('accepted')" class="flex-1 md:flex-none px-10 py-4 bg-rose-600 hover:bg-rose-500 text-white text-[11px] font-black uppercase tracking-[0.2em] rounded-2xl transition-all shadow-xl shadow-rose-900/40 active:scale-95">
                    Accept All
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        console.log('Cookie banner script initialized');
        
        window.showCookieBanner = function() {
            console.log('Attempting to show cookie banner...');
            const consent = localStorage.getItem('cookie-consent');
            const banner = document.getElementById('cookie-banner');
            
            if (!banner) {
                console.error('Cookie banner element not found!');
                return;
            }

            if (!consent) {
                console.log('No consent found, showing banner');
                banner.style.display = 'block';
                // Force reflow
                banner.offsetHeight; 
                setTimeout(() => {
                    banner.classList.remove('translate-y-full');
                    console.log('Banner animation triggered');
                }, 50);
            } else {
                console.log('Consent already exists: ' + consent);
            }
        };

        const initBanner = () => {
            const consent = localStorage.getItem('cookie-consent');
            const saleShown = sessionStorage.getItem('founderSaleShown');
            const hasSaleModal = document.getElementById('premiumSaleModal');

            console.log('Banner init check:', { consent, saleShown, hasSaleModal: !!hasSaleModal });

            // Show automatically if: 
            // 1. No consent given AND 
            // 2. Either no sale modal on this page OR sale already shown/dismissed
            if (!consent && (!hasSaleModal || saleShown)) {
                console.log('Auto-showing banner in 2s');
                setTimeout(window.showCookieBanner, 2000);
            }
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initBanner);
        } else {
            initBanner();
        }

        window.handleCookieConsent = function(choice) {
            console.log('Cookie consent choice:', choice);
            const banner = document.getElementById('cookie-banner');
            localStorage.setItem('cookie-consent', choice);
            
            if (banner) {
                banner.classList.add('translate-y-full');
                setTimeout(() => {
                    banner.style.display = 'none';
                }, 1000);
            }
        };
    })();
</script>
