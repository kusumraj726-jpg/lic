<div id="protocol-consent-matrix" class="fixed bottom-0 left-0 w-full z-[99999] transform translate-y-full opacity-0 transition-all duration-1000 ease-out pointer-events-none">
    <div class="max-w-7xl mx-auto px-4 pb-6">
        <div class="bg-slate-900/95 backdrop-blur-3xl border border-white/20 rounded-3xl p-8 shadow-[0_20px_50px_rgba(0,0,0,0.5)] flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="flex items-center gap-6">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-500 to-pink-600 flex items-center justify-center flex-shrink-0 shadow-lg shadow-rose-500/20">
                    <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div>
                    <h4 class="text-white font-black text-lg tracking-tight mb-1 uppercase">System Protocol</h4>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-xl font-medium">
                        We use specialized technical protocols to optimize your digital architecture and ensure the highest performance. By accepting, you consent to our security protocols.
                    </p>
                </div>
            </div>
            <div class="flex items-center gap-4 w-full md:w-auto">
                <button onclick="handleProtocolConsent('rejected')" class="flex-1 md:flex-none px-8 py-3 rounded-2xl text-slate-400 hover:text-white text-[11px] font-black uppercase tracking-[0.2em] transition-all hover:bg-white/5">
                    Reject All
                </button>
                <button onclick="handleProtocolConsent('accepted')" class="flex-1 md:flex-none px-10 py-4 bg-rose-600 hover:bg-rose-500 text-white text-[11px] font-black uppercase tracking-[0.2em] rounded-2xl transition-all shadow-xl shadow-rose-900/40 active:scale-95">
                    Accept All
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
                setTimeout(window.showProtocolMatrix, 1000);
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
