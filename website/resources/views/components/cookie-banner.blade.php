<div id="protocol-consent-matrix" class="fixed bottom-0 left-0 w-full z-[99999] transform translate-y-full opacity-0 transition-all duration-700 ease-out pointer-events-none">
    <div class="bg-white/85 backdrop-blur-2xl border-t border-slate-200 shadow-[0_-10px_40px_rgba(0,0,0,0.05)] w-full px-4 py-4 md:py-5">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-5 w-full md:w-auto">
                <div class="hidden md:flex w-10 h-10 rounded-full bg-slate-50 border border-slate-100 items-center justify-center flex-shrink-0 text-rose-500">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-slate-900 font-bold text-sm tracking-tight mb-1 uppercase">Cookie Protocol</h4>
                    <p class="text-slate-600 text-xs leading-relaxed max-w-2xl" style="font-family: Cambria, Georgia, serif;">
                        We use technical cookies to optimize your architecture and ensure secure interactions. By proceeding, you align with our standard performance protocols.
                        <a href="{{ route('privacy') }}" target="_blank" class="text-rose-600 hover:text-rose-700 underline underline-offset-2 font-bold ml-1">Read Cookie Policy</a>
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-3 w-full md:w-auto flex-shrink-0">
                <button onclick="handleProtocolConsent('rejected')" class="flex-1 md:flex-none px-6 py-2.5 rounded-full text-slate-500 hover:text-slate-900 text-[10px] font-black uppercase tracking-[0.2em] transition-colors hover:bg-slate-100 border border-transparent">
                    Reject
                </button>
                <button onclick="handleProtocolConsent('accepted')" class="flex-1 md:flex-none px-8 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-full transition-all shadow-md active:scale-95">
                    Accept
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        window.showProtocolMatrix = function() {
            // Also check cookies via PHP state
            const serverConsent = '{{ request()->cookie('cookie-consent') }}';
            const localConsent = localStorage.getItem('protocol-consent');
            const matrix = document.getElementById('protocol-consent-matrix');
            
            if (!matrix) return;

            // Only show if no consent is found anywhere
            if (!localConsent && !serverConsent) {
                matrix.classList.remove('translate-y-full', 'opacity-0', 'pointer-events-none');
                matrix.classList.add('opacity-100');
                matrix.style.pointerEvents = 'auto';
            }
        };

        const initMatrix = () => {
            const serverConsent = '{{ request()->cookie('cookie-consent') }}';
            const localConsent = localStorage.getItem('protocol-consent');
            
            if (!localConsent && !serverConsent) {
                const saleShown = sessionStorage.getItem('founderSaleShown');
                const hasSaleModal = document.getElementById('premiumSaleModal');
                
                // Show if no sale modal exists, OR if the sale modal has already been shown this session.
                // Otherwise, wait for the sale modal to be closed (which triggers showProtocolMatrix).
                if (!hasSaleModal || saleShown) {
                    setTimeout(window.showProtocolMatrix, 1000);
                }
            }
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initMatrix);
        } else {
            initMatrix();
        }

        window.handleProtocolConsent = function(choice) {
            const matrix = document.getElementById('protocol-consent-matrix');
            
            // Optimistically update UI
            if (matrix) {
                matrix.classList.add('translate-y-full', 'opacity-0');
                matrix.style.pointerEvents = 'none';
            }
            
            // Save to local storage immediately so it doesn't show again on refresh while DB is slow
            localStorage.setItem('protocol-consent', choice);
            
            // Also store as an actual browser cookie immediately for instant client-side availability
            document.cookie = `cookie-consent=${choice}; max-age=31536000; path=/`;
            
            // Save to database via AJAX
            fetch('{{ route('cookie-consent.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: choice })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    console.error('Failed to log protocol consent');
                }
            })
            .catch(error => {
                console.error('Error saving consent:', error);
            });
        };
    })();
</script>
