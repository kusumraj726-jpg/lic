<div id="cookie-banner" class="fixed bottom-0 left-0 w-full z-[100] transform translate-y-full transition-transform duration-700 ease-out" style="display: none;">
    <div class="max-w-7xl mx-auto px-4 pb-6">
        <div class="bg-slate-900/90 backdrop-blur-2xl border border-white/10 rounded-2xl p-6 shadow-2xl flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-rose-500/20 flex items-center justify-center flex-shrink-0">
                    <svg class="w-6 h-6 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-bold text-sm tracking-tight">Cookie Consent</h4>
                    <p class="text-slate-400 text-xs leading-relaxed max-w-xl">
                        We use technical cookies to enhance your architectural experience and analyze our ecosystem's performance. By clicking "Accept All", you agree to our digital data protocols.
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-3 w-full md:w-auto">
                <button onclick="handleCookieConsent('rejected')" class="flex-1 md:flex-none px-6 py-2.5 rounded-xl text-slate-400 hover:text-white text-[10px] font-black uppercase tracking-widest transition-all">
                    Reject All
                </button>
                <button onclick="handleCookieConsent('accepted')" class="flex-1 md:flex-none px-8 py-2.5 bg-rose-600 hover:bg-rose-700 text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-lg shadow-rose-900/20 active:scale-95">
                    Accept All
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const consent = localStorage.getItem('cookie-consent');
        const banner = document.getElementById('cookie-banner');
        
        if (!consent) {
            banner.style.display = 'block';
            setTimeout(() => {
                banner.classList.remove('translate-y-full');
            }, 1000);
        }
    });

    function handleCookieConsent(choice) {
        const banner = document.getElementById('cookie-banner');
        localStorage.setItem('cookie-consent', choice);
        
        banner.classList.add('translate-y-full');
        setTimeout(() => {
            banner.style.display = 'none';
        }, 700);
    }
</script>
