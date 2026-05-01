<div x-data="{ 
    open: false,
    loading: false,
    success: false,
    formData: {
        name: '',
        email: '',
        service: 'Insurance ERP Systems',
        message: ''
    },
    async submitForm() {
        this.loading = true;
        try {
            const response = await fetch('{{ route('consultation.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(this.formData)
            });
            const data = await response.json();
            if (data.success) {
                this.success = true;
                this.formData = { name: '', email: '', service: 'Insurance ERP Systems', message: '' };
                setTimeout(() => { this.open = false; this.success = false; }, 3000);
            }
        } catch (error) {
            alert('Submission failed. Please try again.');
        } finally {
            this.loading = false;
        }
    }
}" 
@open-contact.window="open = true" 
class="relative">
    <template x-teleport="body">
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-md">
            
            <div @click.away="open = false" 
                 class="bg-white rounded-[2.5rem] shadow-2xl w-full max-w-lg overflow-hidden border border-slate-100 relative"
                 style="font-family: 'Cambria', Georgia, serif;">
                
                <!-- Close Button -->
                <button @click="open = false" class="absolute top-6 right-6 text-slate-400 hover:text-slate-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <div class="p-10">
                    <div x-show="!success">
                        <h3 class="text-3xl font-black text-slate-950 mb-2 uppercase tracking-tight">Connect with Us</h3>
                        <p class="text-slate-800 text-sm font-bold mb-8">Drop us a line and our architects will get back to you shortly.</p>

                        <form @submit.prevent="submitForm" class="space-y-5">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-800 uppercase tracking-[0.2em] mb-2">Full Name</label>
                                <input type="text" x-model="formData.name" required
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-500/20 transition-all placeholder:text-slate-400"
                                    placeholder="e.g. Rahul Sharma">
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-slate-800 uppercase tracking-[0.2em] mb-2">Email Address</label>
                                <input type="email" x-model="formData.email" required
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-500/20 transition-all placeholder:text-slate-400"
                                    placeholder="rahul@example.com">
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-slate-800 uppercase tracking-[0.2em] mb-2">Service Interest</label>
                                <select x-model="formData.service"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-500/20 transition-all">
                                    <option>Insurance ERP Systems</option>
                                    <option>Customized Websites</option>
                                    <option>API & Cloud Infrastructure</option>
                                    <option>Other Consultation</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-[11px] font-bold text-slate-800 uppercase tracking-[0.2em] mb-2">Your Vision / Message</label>
                                <textarea x-model="formData.message" rows="4"
                                    class="w-full bg-slate-50 border-none rounded-2xl px-5 py-4 text-sm font-bold text-slate-900 focus:ring-2 focus:ring-indigo-500/20 transition-all placeholder:text-slate-400"
                                    placeholder="Tell us about your requirements..."></textarea>
                            </div>

                            <button type="submit" :disabled="loading"
                                class="w-full bg-slate-900 text-white py-5 rounded-2xl font-black uppercase tracking-widest text-xs hover:bg-indigo-600 transition-all shadow-lg shadow-indigo-100 flex items-center justify-center gap-3">
                                <span x-show="!loading">Initialize Transmission</span>
                                <template x-if="loading">
                                    <div class="flex items-center gap-2">
                                        <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        <span>Architecting...</span>
                                    </div>
                                </template>
                            </button>
                        </form>
                    </div>

                    <!-- Success State -->
                    <div x-show="success" class="text-center py-10 animate-fade-in">
                        <div class="w-20 h-20 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-slate-900 mb-2 uppercase tracking-tight">Message Received</h3>
                        <p class="text-slate-500 text-sm font-medium">Our team has been notified. We will reach out to you within 24 hours.</p>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
