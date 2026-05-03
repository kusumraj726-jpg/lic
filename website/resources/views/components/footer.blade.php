<footer x-data="{}" class="py-20 border-t border-white/5 bg-[#0f111a] relative overflow-hidden">
    <!-- Footer Aurora Glow -->
    <div class="absolute -bottom-48 left-1/2 -translate-x-1/2 w-full h-96 bg-rose-500/10 blur-[120px] rounded-full">
    </div>

    <div class="max-w-7xl mx-auto px-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 lg:gap-8 mb-16">
            <div class="md:col-span-2">
                <div class="flex items-center gap-4 mb-6">
                    <img src="{{ asset('images/company_logo.jpg') }}" alt="nexorabyte"
                        class="h-10 w-auto object-contain"
                        style="filter: url(#chroma-key-black) contrast(1.1) brightness(1.2);">
                    <span class="text-xl font-black text-white tracking-[0.2em]">nexorabyte</span>
                </div>
                <p class="text-slate-400 text-sm leading-relaxed max-w-sm mb-8 font-medium">
                    Architecting the digital backbone of the modern enterprise through bespoke ERP logic, elite
                    engineering, and immutable security.
                </p>
            </div>

            <div>
                <h5 class="text-white font-black tracking-[0.3em] uppercase text-[10px] mb-6">Our Services</h5>
                <ul class="space-y-4">
                    <li><a href="{{ route('services.web-development') }}"
                            class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">Customized
                            Websites</a></li>
                    <li><a href="{{ route('services.insurance-erp') }}"
                            class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">Insurance
                            ERP Systems</a></li>
                </ul>
            </div>

            <div>
                <h5 class="text-white font-black tracking-[0.3em] uppercase text-[10px] mb-6">Studio</h5>
                <ul class="space-y-4">
                    <li><a href="{{ route('about') }}"
                            class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">About
                            Us</a></li>
                    <li><a href="{{ route('lifecycle') }}"
                            class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">Our
                            Lifecycle</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="text-slate-500 text-sm hover:text-rose-500 transition-all hover:pl-2">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-6">
            <p class="text-[9px] font-black tracking-[0.3em] text-slate-600 uppercase">&copy; {{ date('Y') }}
                nexorabyte. ARCHITECTING EXCELLENCE.</p>
            <div class="flex flex-wrap gap-8">
                <a href="{{ route('terms') }}"
                    class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-600 hover:text-white transition-colors">Terms</a>
                <a href="{{ route('privacy') }}"
                    class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-600 hover:text-white transition-colors">Privacy</a>
                <a href="{{ route('refunds') }}"
                    class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-600 hover:text-white transition-colors">Refunds</a>

            </div>
        </div>
    </div>
</footer>

<x-cookie-banner />
