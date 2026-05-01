<div x-data="aiChatWidget()" 
     class="fixed bottom-6 right-6 z-[100]"
     @keydown.escape.window="open = false">
    
    <!-- Floating Toggle Button -->
    <button @click="toggleChat()" 
            class="group relative h-14 w-14 flex items-center justify-center rounded-2xl shadow-2xl transition-all duration-300 hover:scale-110 active:scale-95 overflow-hidden"
            style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);">
        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: linear-gradient(135deg, #4338ca 0%, #6d28d9 100%);"></div>
        <svg x-show="!open" class="relative h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10zM9 10l3 3 3-3" />
        </svg>
        <svg x-show="open" class="relative h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
        <span x-show="!open && hasUnread" class="absolute -top-1 -right-1 h-3.5 w-3.5 rounded-full bg-rose-500 ring-2 ring-white dark:ring-slate-900"></span>
    </button>

    <!-- Chat Panel -->
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-6 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-end="opacity-0 translate-y-6 scale-95"
         class="absolute bottom-16 right-0 w-[420px] max-w-[92vw] flex flex-col rounded-[2rem] overflow-hidden shadow-[0_32px_80px_-12px_rgba(0,0,0,0.45)] border border-white/10 transition-all duration-500"
         :style="`background:rgba(10,15,30,0.97); backdrop-filter:blur(32px); height: ${isExpanded ? '600px' : '420px'};` ">

        <!-- Header -->
        <div class="relative px-6 py-4 flex items-center justify-between flex-shrink-0 overflow-hidden"
             style="background:linear-gradient(135deg,#3730a3 0%,#5b21b6 100%);">
            <div class="absolute inset-0 opacity-20" style="background:radial-gradient(ellipse at top left, rgba(255,255,255,0.3), transparent 60%);"></div>
            <div class="relative flex items-center gap-3">
                <div class="h-9 w-9 rounded-xl flex items-center justify-center" style="background:rgba(255,255,255,0.15);">
                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10zM9 10l3 3 3-3" />
                    </svg>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-black text-white tracking-widest uppercase">NexoraByte AI</span>
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-400"></span>
                        </span>
                    </div>
                    <p class="text-[10px] font-bold uppercase tracking-widest" style="color:rgba(255,255,255,0.55);">Powered by NexoraByte</p>
                </div>
            </div>
            <div class="relative flex gap-2">
                <button @click.stop="isExpanded = !isExpanded" type="button" class="h-8 w-8 rounded-xl flex items-center justify-center hover:scale-110 transition-all focus:outline-none" style="background:rgba(255,255,255,0.15);" :title="isExpanded ? 'Minimize' : 'Expand'">
                    <svg x-show="!isExpanded" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                    </svg>
                    <svg x-show="isExpanded" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4l5 5m11-5l-5 5m-11 11l5-5m11 5l-5-5M9 4v5H4m11-5v5h5M9 20v-5H4m11 5v-5h5"/>
                    </svg>
                </button>
                <button @click="newSession()" class="h-8 w-8 rounded-xl flex items-center justify-center hover:scale-110 transition-all" style="background:rgba(255,255,255,0.15);" title="New Chat">
                    <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                </button>
                <button @click="open=false" class="h-8 w-8 rounded-xl flex items-center justify-center hover:scale-110 transition-all" style="background:rgba(255,255,255,0.15);">
                    <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                </button>
            </div>
        </div>

        <!-- TAB BAR -->
        <div class="flex flex-shrink-0" style="background:rgba(15,23,42,1); border-bottom:1px solid rgba(79,70,229,0.15);">
            <button @click="activeTab='chat'" 
                    class="flex-1 py-3 text-[10px] font-black uppercase tracking-widest transition-all"
                    :style="activeTab==='chat' ? 'color:#818cf8; border-bottom:2px solid #6366f1;' : 'color:rgba(100,116,139,0.7);'">
                💬 Chat
            </button>
            <button @click="activeTab='voice'; initVoiceTab()"
                    class="flex-1 py-3 text-[10px] font-black uppercase tracking-widest transition-all"
                    :style="activeTab==='voice' ? 'color:#818cf8; border-bottom:2px solid #6366f1;' : 'color:rgba(100,116,139,0.7);'">
                🎙️ Voice
            </button>
        </div>

        <!-- ===== CHAT TAB ===== -->
        <div x-show="activeTab==='chat'" class="flex flex-col flex-1 min-h-0">
            <!-- Suggestion Pills -->
            <div x-show="messages.length===0" class="px-5 pt-4 pb-2 flex-shrink-0">
                <p class="text-[10px] font-black uppercase tracking-widest mb-2.5" style="color:rgba(100,116,139,0.7);">Try asking</p>
                <div class="flex flex-wrap gap-2">
                    <template x-for="pill in suggestions" :key="pill">
                        <button @click="sendPill(pill)" class="px-3 py-1.5 rounded-xl text-[11px] font-bold transition-all hover:scale-105 active:scale-95"
                                style="background:rgba(79,70,229,0.15);color:#818cf8;border:1px solid rgba(79,70,229,0.25);" x-text="pill"></button>
                    </template>
                </div>
            </div>

            <!-- Messages -->
            <div class="flex-1 overflow-y-auto px-5 py-4 space-y-4 min-h-0" id="ai-chat-messages"
                 style="scrollbar-width:thin;scrollbar-color:rgba(79,70,229,0.3) transparent;">
                <div x-show="messages.length===0" class="flex flex-col items-center justify-center h-full text-center space-y-3">
                    <svg class="h-10 w-10" style="color:rgba(79,70,229,0.4);" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                    <p class="text-xs font-bold" style="color:rgba(100,116,139,0.6);">No messages yet. Say something!</p>
                </div>
                <template x-for="(msg,i) in messages" :key="i">
                    <div :class="msg.role==='user'?'flex justify-end':'flex justify-start items-start gap-2.5'">
                        <div x-show="msg.role!=='user'" class="h-7 w-7 rounded-xl flex-shrink-0 flex items-center justify-center mt-0.5"
                             style="background:linear-gradient(135deg,#4f46e5,#7c3aed);min-width:28px;">
                            <svg class="h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10zM9 10l3 3 3-3" />
                            </svg>
                        </div>
                        <div class="px-4 py-3 rounded-2xl text-sm font-medium leading-relaxed max-w-[80%]"
                             :class="msg.role==='user'?'rounded-tr-sm':'rounded-tl-sm'"
                             :style="msg.role==='user'?'background:linear-gradient(135deg,#4f46e5,#7c3aed);color:white;':'background:rgba(30,41,59,0.9);border:1px solid rgba(79,70,229,0.15);color:rgba(226,232,240,0.95);'"
                             x-text="msg.content"></div>
                    </div>
                </template>
                <div x-show="loading" class="flex justify-start items-start gap-2.5">
                    <div class="h-7 w-7 rounded-xl flex-shrink-0 flex items-center justify-center" style="background:linear-gradient(135deg,#4f46e5,#7c3aed);min-width:28px;">
                        <svg class="h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div class="px-4 py-4 rounded-2xl rounded-tl-sm flex items-center gap-1.5" style="background:rgba(30,41,59,0.9);border:1px solid rgba(79,70,229,0.15);">
                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-400 animate-bounce" style="animation-delay:0ms"></span>
                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-400 animate-bounce" style="animation-delay:160ms"></span>
                        <span class="h-1.5 w-1.5 rounded-full bg-indigo-400 animate-bounce" style="animation-delay:320ms"></span>
                    </div>
                </div>
            </div>

            <!-- Input -->
            <div class="px-4 pb-4 pt-3 flex-shrink-0" style="border-top:1px solid rgba(79,70,229,0.1);">
                <form @submit.prevent="send()" class="flex items-center gap-2">
                    <input type="text" x-model="userInput" :disabled="loading"
                           placeholder="Ask NexoraByte anything..."
                           class="flex-1 px-4 py-3 text-sm font-medium rounded-xl border-0 outline-none transition-all"
                           style="background:rgba(30,41,59,0.9);color:rgba(226,232,240,0.95);">
                    <button type="submit" :disabled="!userInput.trim()||loading"
                            class="h-11 w-11 flex items-center justify-center rounded-xl flex-shrink-0 transition-all hover:scale-110 active:scale-95 disabled:opacity-40"
                            style="background:linear-gradient(135deg,#4f46e5,#7c3aed);">
                        <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    </button>
                </form>
                <p class="text-[9px] font-bold uppercase tracking-widest text-center mt-2" style="color:rgba(100,116,139,0.5);">NexoraByte Intelligence · Verify critical records</p>
            </div>
        </div>

        <!-- ===== VOICE TAB ===== -->
        <div x-show="activeTab==='voice'" style="display:none;" class="flex flex-col flex-1 items-center justify-center px-6 py-6 gap-6">
            
            <!-- Conversation ON badge -->
            <div x-show="conversationMode" class="flex items-center gap-2 px-4 py-2 rounded-full" style="background:rgba(52,211,153,0.1);border:1px solid rgba(52,211,153,0.3);">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-400"></span>
                </span>
                <span class="text-[10px] font-black uppercase tracking-widest text-emerald-400">Conversation Active</span>
            </div>

            <!-- Status text -->
            <div class="text-center space-y-2">
                <p class="text-xs font-black uppercase tracking-widest transition-all"
                   :style="voiceState==='idle' && !conversationMode ? 'color:rgba(100,116,139,0.7);'
                          : voiceState==='listening' ? 'color:#f87171;'
                          : voiceState==='speaking' ? 'color:#818cf8;'
                          : 'color:#fbbf24;'"
                   x-text="!conversationMode ? 'TAP ORB TO TALK'
                          : voiceState==='listening' ? 'Go ahead, I\'m listening...'
                          : voiceState==='speaking' ? 'Talking to you...'
                          : voiceState==='processing' ? 'Processing...'
                          : 'Attentive & Ready'"></p>
                <p x-show="voiceTranscript" class="text-sm italic max-w-[260px] mx-auto leading-relaxed"
                   style="color:rgba(226,232,240,0.5);" x-text="'\"' + voiceTranscript + '\"'"></p>
            </div>

            <!-- Orb -->
            <div class="relative flex items-center justify-center">
                <!-- always-on outer glow when conversation active -->
                <div x-show="conversationMode" class="absolute h-52 w-52 rounded-full opacity-10"
                     :style="voiceState==='listening' ? 'background:rgba(239,68,68,0.6);animation:ping 1s cubic-bezier(0,0,0.2,1) infinite;'
                            : voiceState==='speaking' ? 'background:rgba(99,102,241,0.6);animation:ping 1.2s cubic-bezier(0,0,0.2,1) infinite;'
                            : 'background:rgba(52,211,153,0.4);animation:ping 2s cubic-bezier(0,0,0.2,1) infinite;'"></div>
                <div x-show="conversationMode" class="absolute h-40 w-40 rounded-full opacity-20"
                     :style="voiceState==='listening' ? 'background:rgba(239,68,68,0.5);animation:ping 1s cubic-bezier(0,0,0.2,1) infinite;animation-delay:0.3s;'
                            : voiceState==='speaking' ? 'background:rgba(99,102,241,0.5);animation:ping 1.2s cubic-bezier(0,0,0.2,1) infinite;animation-delay:0.3s;'
                            : 'background:rgba(52,211,153,0.3);animation:ping 2s cubic-bezier(0,0,0.2,1) infinite;animation-delay:0.5s;'"></div>

                <!-- The Orb itself -->
                <button @click="toggleConversation()"
                        class="relative h-32 w-32 rounded-full flex flex-col items-center justify-center gap-2 transition-all duration-500 shadow-2xl hover:scale-105 active:scale-95"
                        :style="!conversationMode
                            ? 'background:linear-gradient(135deg,#1e293b,#0f172a);border:2px solid rgba(79,70,229,0.35);'
                            : voiceState==='listening'
                            ? 'background:linear-gradient(135deg,#dc2626,#991b1b);box-shadow:0 0 60px rgba(239,68,68,0.6);'
                            : voiceState==='speaking'
                            ? 'background:linear-gradient(135deg,#4f46e5,#7c3aed);box-shadow:0 0 60px rgba(99,102,241,0.6);'
                            : voiceState==='processing'
                            ? 'background:linear-gradient(135deg,#d97706,#b45309);box-shadow:0 0 40px rgba(251,191,36,0.4);'
                            : 'background:linear-gradient(135deg,#065f46,#047857);box-shadow:0 0 40px rgba(52,211,153,0.4);'">

                    <!-- OFF state: mic icon -->
                    <svg x-show="!conversationMode" class="h-12 w-12" style="color:#6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                    </svg>

                    <!-- Listening: waveform bars -->
                    <div x-show="conversationMode && voiceState==='listening'" class="flex items-end gap-1" style="height:40px;">
                        <span class="w-1.5 rounded-full bg-white animate-bounce" style="height:16px;animation-delay:0ms;"></span>
                        <span class="w-1.5 rounded-full bg-white animate-bounce" style="height:30px;animation-delay:80ms;"></span>
                        <span class="w-1.5 rounded-full bg-white animate-bounce" style="height:22px;animation-delay:160ms;"></span>
                        <span class="w-1.5 rounded-full bg-white animate-bounce" style="height:36px;animation-delay:240ms;"></span>
                        <span class="w-1.5 rounded-full bg-white animate-bounce" style="height:18px;animation-delay:320ms;"></span>
                        <span class="w-1.5 rounded-full bg-white animate-bounce" style="height:28px;animation-delay:400ms;"></span>
                    </div>

                    <!-- Speaking: sound waves -->
                    <div x-show="conversationMode && voiceState==='speaking'" class="flex items-end gap-1" style="height:40px;">
                        <span class="w-1.5 rounded-full bg-white animate-bounce" style="height:28px;animation-delay:0ms;"></span>
                        <span class="w-1.5 rounded-full bg-white animate-bounce" style="height:38px;animation-delay:100ms;"></span>
                        <span class="w-1.5 rounded-full bg-white animate-bounce" style="height:20px;animation-delay:200ms;"></span>
                        <span class="w-1.5 rounded-full bg-white animate-bounce" style="height:34px;animation-delay:300ms;"></span>
                        <span class="w-1.5 rounded-full bg-white animate-bounce" style="height:24px;animation-delay:400ms;"></span>
                        <span class="w-1.5 rounded-full bg-white animate-bounce" style="height:32px;animation-delay:500ms;"></span>
                    </div>

                    <!-- Processing: spinner -->
                    <div x-show="conversationMode && voiceState==='processing'" class="h-10 w-10 border-[3px] border-white border-t-transparent rounded-full animate-spin"></div>

                    <!-- Standby (active but not doing anything): green mic -->
                    <svg x-show="conversationMode && voiceState==='idle'" class="h-10 w-10 text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                    </svg>

                    <!-- Label -->
                    <span class="text-[9px] font-black uppercase tracking-widest"
                          style="color:rgba(255,255,255,0.75);"
                          x-text="!conversationMode ? 'TAP TO TALK' : (voiceState === 'idle' ? 'LISTENING' : voiceState.toUpperCase())"></span>
                </button>
            </div>

            <!-- Last AI Reply -->
            <div x-show="lastVoiceReply" class="w-full rounded-2xl px-5 py-4 text-sm font-medium leading-relaxed"
                 style="background:rgba(30,41,59,0.8);border:1px solid rgba(79,70,229,0.15);color:rgba(226,232,240,0.9);max-height:120px;overflow-y:auto;"
                 x-text="lastVoiceReply"></div>

            <p class="text-[9px] font-black uppercase tracking-widest" style="color:rgba(100,116,139,0.4);">
                <span x-show="!conversationMode">Tap orb to start · Auto-listens after each reply</span>
                <span x-show="conversationMode">Tap orb again to end conversation</span>
            </p>
        </div>
    </div>
</div>

<script>
function aiChatWidget() {
    return {
        // Persistence states
        open: sessionStorage.getItem('nexorabyte_open') === 'true',
        isExpanded: sessionStorage.getItem('nexorabyte_expanded') === 'true',
        activeTab: sessionStorage.getItem('nexorabyte_tab') || 'chat',
        userInput: '',
        loading: false,
        hasUnread: false,
        sessionId: null,
        messages: [],
        suggestions: ['How many clients?', 'Show pending claims', 'Go to Dashboard', 'Switch to light mode'],
        conversationMode: sessionStorage.getItem('nexorabyte_voice') === 'true',

        // Voice mode state
        voiceState: 'idle',
        voiceTranscript: '',
        lastVoiceReply: '',
        recognition: null,
        synth: window.speechSynthesis || null,
        voiceReady: false,
        availableVoices: [],
        silenceTimer: null,      // auto-stops if no speech for 10s
        silenceCountdown: 0,
        countdownInterval: null,
        phoneticMap: {
            'Dashboard': 'डैशबोर्ड',
            'Clients': 'क्लाइंट्स',
            'Queries': 'क्वेरीज',
            'Claims': 'क्लेम्स',
            'Renewals': 'रिन्यूएल्स',
            'Staff': 'स्टाफ',
            'Settings': 'सेटिंग्स',
            'Profile': 'प्रोफाइल',
            'Dark Mode': 'डार्क मोड',
            'Light Mode': 'लाइट मोड',
            'Nexora': 'नेक्सोरा',
            'ERP': 'सिस्टम'
        },

        async init() {
            // Load chat history
            try {
                const res = await fetch('{{ route('api.chat.history') }}');
                const data = await res.json();
                if (data.length > 0) {
                    this.sessionId = data[0].id;
                    this.messages = data[0].messages.filter(m => m.role === 'user' || m.role === 'assistant');
                }
            } catch(e) {}

            // Pre-load voices (Chrome/Edge load them async)
            if (this.synth) {
                const loadVoices = () => {
                    this.availableVoices = this.synth.getVoices();
                    
                    // Trigger greeting once voices are ready and if on dashboard
                    const onDashboard = window.location.pathname.includes('/dashboard');
                    if (onDashboard && !sessionStorage.getItem('nexorabyte_greeted')) {
                        setTimeout(() => this.greetUser(), 1500);
                    }
                };
                loadVoices();
                if (navigator.userAgent.indexOf("Chrome") !== -1 || navigator.userAgent.indexOf("Edge") !== -1) {
                    this.synth.onvoiceschanged = loadVoices;
                }
            }

            // Persistence Watchers
            this.$watch('open', val => sessionStorage.setItem('nexorabyte_open', val));
            this.$watch('isExpanded', val => sessionStorage.setItem('nexorabyte_expanded', val));
            this.$watch('activeTab', val => sessionStorage.setItem('nexorabyte_tab', val));
            this.$watch('conversationMode', val => {
                sessionStorage.setItem('nexorabyte_voice', val);
                if (!val) {
                    this.clearSilenceTimer();
                    try { this.recognition.stop(); } catch(e) {}
                }
            });

            // Resume conversation mode if it was active
            if (this.conversationMode && this.activeTab === 'voice') {
                setTimeout(() => {
                    if (this.conversationMode) this.startListening();
                }, 2000);
            }

            // Setup SpeechRecognition
            const SR = window.SpeechRecognition || window.webkitSpeechRecognition;
            if (SR) {
                this.recognition = new SR();
                this.recognition.lang = '';  // Empty = auto-detect user's language
                this.recognition.interimResults = true; // Real-time feedback
                this.recognition.continuous = false;

                this.recognition.onresult = (e) => {
                    // Speech detected — clear the silence timer
                    this.clearSilenceTimer();
                    
                    let interimTranscript = '';
                    let finalTranscript = '';

                    for (let i = e.resultIndex; i < e.results.length; ++i) {
                        if (e.results[i].isFinal) {
                            finalTranscript += e.results[i][0].transcript;
                        } else {
                            interimTranscript += e.results[i][0].transcript;
                        }
                    }

                    if (finalTranscript) {
                        this.voiceTranscript = finalTranscript;
                        this.voiceState = 'processing';
                        this.sendVoiceMessage(finalTranscript);
                    } else {
                        // Update UI with real-time text so user knows we are listening
                        this.voiceTranscript = interimTranscript;
                    }
                };

                this.recognition.onerror = (e) => {
                    console.warn('Speech error:', e.error);
                    if (e.error === 'not-allowed') {
                        alert('Microphone access denied. Please allow microphone in your browser settings.');
                        this.conversationMode = false;
                        this.voiceState = 'idle';
                        return;
                    }
                    // In conversation mode, retry listening after a short pause
                    if (this.conversationMode && e.error !== 'aborted') {
                        setTimeout(() => this.startListening(), 600);
                    } else {
                        this.voiceState = 'idle';
                    }
                };

                this.recognition.onend = () => {
                    // Only go to idle if we're not already in another state (processing/speaking)
                    if (this.voiceState === 'listening') {
                        if (this.conversationMode) {
                            // No speech detected, restart listening
                            setTimeout(() => this.startListening(), 300);
                        } else {
                            this.voiceState = 'idle';
                        }
                    }
                };

                this.voiceReady = true;
            }
        },

        initVoiceTab() {
            // Called each time Voice tab is opened
            if (this.synth) {
                this.availableVoices = this.synth.getVoices();
            }
        },

        // Start a single listening session
        startListening() {
            if (!this.conversationMode) return;
            this.voiceTranscript = '';
            this.voiceState = 'listening';

            // 10-second silence auto-stop
            this.clearSilenceTimer();
            this.silenceCountdown = 10;
            this.countdownInterval = setInterval(() => {
                this.silenceCountdown--;
                if (this.silenceCountdown <= 0) {
                    this.clearSilenceTimer();
                    if (this.voiceState === 'listening') {
                        // No speech detected — end conversation mode
                        this.conversationMode = false;
                        this.voiceState = 'idle';
                        this.lastVoiceReply = '';
                        try { this.recognition.stop(); } catch(e) {}
                    }
                }
            }, 1000);

            try { this.recognition.start(); } catch(e) { this.voiceState = 'idle'; this.clearSilenceTimer(); }
        },

        clearSilenceTimer() {
            if (this.countdownInterval) { clearInterval(this.countdownInterval); this.countdownInterval = null; }
            this.silenceCountdown = 0;
        },

        // Toggle the always-on conversation mode
        toggleConversation() {
            if (!this.voiceReady) {
                alert('Voice is not supported in this browser. Please use Chrome or Edge.');
                return;
            }
            if (!this.conversationMode) {
                // START conversation mode
                this.conversationMode = true;
                this.startListening();
            } else {
                // STOP everything
                this.conversationMode = false;
                this.clearSilenceTimer();
                if (this.synth) this.synth.cancel();
                try { this.recognition.stop(); } catch(e) {}
                this.voiceState = 'idle';
                this.voiceTranscript = '';
            }
        },

        async sendVoiceMessage(text) {
            this.messages.push({ role: 'user', content: text });

            try {
                const response = await fetch('{{ route('api.chat.send') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: text, session_id: this.sessionId })
                });

                const data = await response.json();
                if (data.error) throw new Error(data.error);

                this.sessionId = data.session_id;

                // CLEAN LEAKED CODE: Strip JSON, XML tags, or function names that might have leaked
                let reply = data.response
                    .replace(/<function[\s\S]*?<\/function>/g, '') // Remove XML tags
                    .replace(/\{"__action"[\s\S]*?\}/g, '')         // Remove JSON actions
                    .replace(/set_theme\(.*?\)/g, '')              // Remove function calls
                    .replace(/navigate_to\(.*?\)/g, '')            // Remove navigation calls
                    .trim();

                this.messages.push({ role: 'assistant', content: reply });
                this.lastVoiceReply = reply;

                this.speakText(reply, () => {
                    this.voiceTranscript = '';
                    if (this.conversationMode) {
                        // Reduced to 100ms for "Instant" response
                        setTimeout(() => this.startListening(), 100);
                    } else {
                        this.voiceState = 'idle';
                    }
                });

                if (data.actions && data.actions.length > 0) {
                    setTimeout(() => data.actions.forEach(a => this.executeAction(a)), 1500);
                }
            } catch(e) {
                const errMsg = 'Sorry, the AI service is currently busy. Please try again in 10 seconds.';
                this.lastVoiceReply = errMsg;
                // Speak the error so user knows what's up
                this.speakText(errMsg, () => {
                    this.voiceState = 'idle';
                    this.conversationMode = false; // Stop the loop
                    this.clearSilenceTimer();
                });
            }
        },

        speakText(text, onEnd) {
            if (!this.synth) {
                if (onEnd) onEnd();
                return;
            }
            this.synth.cancel();

            // 0. NUCLEAR CLEANING: Strip ALL technical tags and code fragments
            let cleaned = text
                .replace(/[a-z0-9]+_[a-z0-9_]+/g, '') // Strip snake_case
                .replace(/<.*?>/gi, '')               // Strip anything in < >
                .replace(/\(.*?\)/gi, '')             // Strip anything in ( )
                .replace(/```[\s\S]*?```/g, '')       // Remove markdown code
                .replace(/[*_`#[\]]/g, '')           // Remove other markdown
                .replace(/\{.*?\}/g, '')             // Remove JSON
                .replace(/[,:;]/g, '')               // Remove robotic pauses
                .replace(/\.+(?!\s*$)/g, '')         // Remove internal periods
                .trim();

            // 1. VOICE FALLBACK: Ensure she never stays silent during an action
            if (!cleaned || cleaned.length < 2) {
                cleaned = "Theek hai, main karti hoon.";
            }

            // 1. IMPROVED LANGUAGE DETECTION
            const containsHindi = /[\u0900-\u097F]/.test(text) || text.toLowerCase().includes('hu ') || text.toLowerCase().includes('hai');
            const langPrefix = containsHindi ? 'hi' : 'en';

            const utterance = new SpeechSynthesisUtterance(cleaned);
            utterance.lang = containsHindi ? 'hi-IN' : 'en-IN';
            
            // 2. RESTORED PREMIUM RHYTHM (1.08x was the sweet spot)
            utterance.rate = 1.08; 
            utterance.pitch = 1.02; 
            utterance.volume = 1.0;

            const voices = this.availableVoices.length ? this.availableVoices : this.synth.getVoices();
            
            // 3. RESTORED 'BEFORE' VOICE SELECTION
            const findBestVoice = () => {
                // If we have a voice lock, use it immediately
                if (this.voiceLock) {
                    const locked = voices.find(v => v.name === this.voiceLock);
                    if (locked) return locked;
                }

                const femaleVoices = voices.filter(v => !v.name.toLowerCase().includes('male'));
                
                // Priority 1: Google Hindi (Premium Chrome)
                let best = femaleVoices.find(v => v.name.includes('Google') && v.lang.startsWith('hi'));
                if (best) return best;

                // Priority 2: Microsoft Aria / Natural (Premium Edge)
                best = femaleVoices.find(v => v.name.includes('Natural') || v.name.includes('Online'));
                if (best) return best;

                // Priority 3: Any Google Female
                best = femaleVoices.find(v => v.name.includes('Google'));
                if (best) return best;

                // Priority 4: Any Female in language
                best = femaleVoices.find(v => v.lang.startsWith(langPrefix));
                if (best) return best;

                return femaleVoices[0] || voices[0];
            };

            const selectedVoice = findBestVoice();
            if (selectedVoice) {
                utterance.voice = selectedVoice;
                utterance.lang = selectedVoice.lang;
            }

            this.voiceState = 'speaking';
            utterance.onend = () => { if (onEnd) onEnd(); };
            utterance.onerror = (e) => { 
                console.warn('Speech Error:', e);
                if (onEnd) onEnd(); 
                this.voiceState = 'idle'; 
            };
            this.synth.speak(utterance);
        },

        toggleChat() {
            this.open = !this.open;
            this.hasUnread = false;
            if (this.open) this.$nextTick(() => this.scrollToBottom());
        },

        newSession() {
            this.sessionId = null;
            this.messages = [];
            this.lastVoiceReply = '';
            this.voiceTranscript = '';
            this.voiceState = 'idle';
            if (this.synth) this.synth.cancel();
        },

        sendPill(text) { this.userInput = text; this.send(); },

        async send() {
            if (!this.userInput.trim() || this.loading) return;
            const message = this.userInput;
            this.userInput = '';
            this.messages.push({ role: 'user', content: message });
            this.loading = true;
            this.$nextTick(() => this.scrollToBottom());

            try {
                const res = await fetch('{{ route('api.chat.send') }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: JSON.stringify({ 
                        message, 
                        session_id: this.sessionId,
                        url: window.location.href,
                        currentPage: this.activeTab
                    })
                });
                const data = await res.json();
                if (data.error) throw new Error(data.error);
                this.sessionId = data.session_id;

                // CLEAN LEAKED CODE
                let reply = data.response
                    .replace(/<.*?>/gi, '') 
                    .replace(/\(.*?\)/gi, '') 
                    .replace(/\{"__action"[\s\S]*?\}/g, '')         
                    .replace(/[a-z0-9]+_[a-z0-9_]+\(\)/g, '')              
                    .trim();
                
                if (!reply) reply = "Ji, ho gaya.";

                this.messages.push({ role: 'assistant', content: reply });
                if (data.actions?.length) setTimeout(() => data.actions.forEach(a => this.executeAction(a)), 900);
            } catch(e) {
                this.messages.push({ role: 'assistant', content: 'Error: ' + e.message });
            } finally {
                this.loading = false;
                this.$nextTick(() => this.scrollToBottom());
            }
        },

        async greetUser() {
            try {
                sessionStorage.setItem('nexorabyte_greeted', 'true');
                const response = await fetch('{{ route('api.ai.brief') }}');
                const data = await response.json();
                
                if (data.message) {
                    if (data.voice_lock) this.voiceLock = data.voice_lock;
                    
                    // Open the widget and switch to voice
                    this.open = true;
                    this.activeTab = 'voice';
                    this.initVoiceTab();
                    
                    // Add to chat history for visual reference
                    this.messages.push({ role: 'assistant', content: data.message });
                    this.lastVoiceReply = data.message;
                    
                    // Start conversation mode so it listens after speaking
                    this.conversationMode = true;
                    
                    this.speakText(data.message, () => {
                        // After speaking the greeting, start listening for user input
                        if (this.conversationMode) {
                            setTimeout(() => this.startListening(), 100);
                        }
                    });
                }
            } catch (e) {
                console.warn('Greeting failed:', e);
            }
        },

        executeAction(action) {
            if (action.__action === 'set_theme') {
                const isDark = action.mode === 'dark';
                document.documentElement.classList.toggle('dark', isDark);
                localStorage.theme = action.mode;
            } else if (action.__action === 'navigate') {
                window.location.href = action.url;
            } else if (action.__action === 'open_url') {
                // Open WhatsApp or phone call in new tab
                window.open(action.url, '_blank');
            }
        },

        scrollToBottom() {
            const el = document.getElementById('ai-chat-messages');
            if (el) el.scrollTop = el.scrollHeight;
        }
    }
}
</script>
