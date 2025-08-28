@php
    $providerID = $provider->id;
    $routes = [
        'getChats' => route('provider.Dashboard.ProviderGetChat', $providerID),
        'getMessages' => route('provider.Dashboard.ProviderGetChatMessage', ':chat_id') . '?page=:page&per_page=:per_page',
        'sendMessage' => route('provider.Dashboard.ProviderChatMessage.store'),
    ];
    $authId = auth()->id();
    $perPage = 20;
@endphp

<div class="h-screen flex overflow-hidden bg-white" 
     x-data="chatApp({{ Js::from($routes) }}, {{ $authId }}, {{ $perPage }})" 
     x-init="init()">

    <!-- القائمة الجانبية -->
    <div class="w-1/3 lg:w-1/4 border-r border-gray-200 bg-white flex flex-col">
        <!-- شريط البحث -->
        <div class="p-4 border-b border-gray-200">
            <div class="relative">
                <input type="text" placeholder="البحث في المحادثات..." x-model="searchQuery" @input="filterChats"
                       class="w-full h-10 rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- قائمة المحادثات -->
        <div class="flex-1 overflow-y-auto">
            <template x-for="chat in filteredChats" :key="chat.id">
                <div class="p-3 cursor-pointer border-b border-gray-100 hover:bg-gray-50 transition-colors"
                     :class="activeChat?.id === chat.id ? 'bg-blue-50 border-blue-200' : ''" 
                     @click="selectChat(chat)">
                    <div class="flex items-center gap-3">
                        <img :src="chat.image ?? '/default.png'" class="h-10 w-10 rounded-full object-cover" />
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-1">
                                <p class="font-medium text-sm text-gray-900 truncate" x-text="chat.subject"></p>
                                <span class="text-xs text-gray-500" x-text="formatTimeAgo(chat.updated_at)"></span>
                            </div>
                            <p class="text-xs text-gray-600 truncate" x-text="chat.last_message || 'لا توجد رسائل'"></p>
                        </div>
                        <div x-show="chat.unread_count && chat.unread_count > 0"
                             class="bg-blue-500 text-white text-xs rounded-full min-w-[18px] h-[18px] flex items-center justify-center font-medium">
                            <span x-text="chat.unread_count > 99 ? '99+' : chat.unread_count"></span>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- منطقة المحادثة -->
    <div class="flex-1 flex flex-col bg-white">
        <!-- الهيدر -->
        <div class="p-4 border-b border-gray-200 flex items-center gap-3 bg-white">
            <img :src="activeChat?.image ?? '/default.png'" class="h-8 w-8 rounded-full object-cover" />
            <div class="flex-1">
                <p class="font-medium text-gray-900" x-text="activeChat?.subject || 'اختر محادثة'"></p>
                <p class="text-sm text-green-500" x-show="activeChat">متصل الآن</p>
            </div>
        </div>

        <!-- منطقة الرسائل -->
        <div class="flex-1 relative overflow-hidden bg-white">
            <div x-show="loadingOldMessages"
                 class="absolute top-0 left-0 right-0 z-10 p-4 bg-white border-b border-gray-200">
                <div class="flex items-center justify-center gap-2">
                    <div class="w-4 h-4 border-2 border-blue-500 border-t-transparent rounded-full animate-spin"></div>
                    <span class="text-sm text-gray-600">جاري تحميل الرسائل السابقة...</span>
                </div>
            </div>

            <div class="h-full overflow-y-auto p-4 space-y-4" x-ref="messagesContainer" @scroll="handleScroll"
                 :style="loadingOldMessages ? 'padding-top: 60px;' : ''">

                <template x-for="(msg, index) in messages" :key="msg.id || msg.tempId || index">
                    <div class="flex" :class="msg.sender_id === authId ? 'justify-end' : 'justify-start'">
                        <div :class="msg.sender_id === authId ? 'flex-row-reverse' : 'flex-row'" class="flex items-end gap-2 max-w-xs">
                            <!-- صورة المرسل -->
                            <img :src="msg.sender_id === authId ? '/user-avatar.png' : (activeChat?.image ?? '/default.png')"
                                 class="w-6 h-6 rounded-full flex-shrink-0" />

                            <div>
                                <div :class="msg.sender_id === authId ? 'bg-blue-500 text-white' : 'bg-gray-100 text-gray-800'"
                                     class="rounded-lg px-3 py-2 relative">
                                    <!-- حالة الرسالة -->
                                    <div x-show="msg.isPending" class="absolute -top-1 -right-1 w-4 h-4 bg-yellow-400 rounded-full flex items-center justify-center">
                                        <div class="w-2 h-2 border border-white rounded-full border-t-transparent animate-spin"></div>
                                    </div>
                                    <div x-show="msg.failed" class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full flex items-center justify-center cursor-pointer"
                                         @click="retrySendMessage(msg)" title="انقر لإعادة الإرسال">
                                        <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>

                                    <!-- نص الرسالة -->
                                    <p class="whitespace-pre-wrap break-words" x-text="msg.message"></p>

                                    <!-- عرض الملفات -->
                                    <template x-for="(file, fIndex) in msg.metaFiles ?? []" :key="fIndex">
                                        <div class="mt-1">
                                            <template x-if="file.preview">
                                                <template x-if="file.type.startsWith('image/')">
                                                    <img :src="file.preview" class="rounded max-w-xs"/>
                                                </template>
                                                <template x-if="file.type.startsWith('video/')">
                                                    <video :src="file.preview" controls class="rounded max-w-xs"></video>
                                                </template>
                                            </template>
                                            <template x-if="!file.preview">
                                                <a :href="storage + file.path" target="_blank" class="text-xs underline">
                                                    <span x-text="file.name"></span>
                                                </a>
                                            </template>
                                        </div>
                                    </template>
                                </div>

                                <div class="mt-1 flex items-center justify-end gap-1">
                                    <span class="text-xs text-gray-500" x-text="formatTime(msg.created_at)"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- صندوق الإرسال -->
        <div class="flex items-end gap-3 p-4 border-t border-gray-200 bg-white">
            <div class="flex-1 relative">
                <textarea x-model="newMessage" @keydown.enter.prevent="handleEnterKey" @input="adjustTextareaHeight"
                          x-ref="messageInput" placeholder="اكتب رسالتك هنا..."
                          class="w-full min-h-[40px] max-h-32 rounded-lg border border-gray-300 px-3 py-2 text-sm placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                          style="height: 40px;"></textarea>
            </div>

            <div class="flex flex-wrap gap-2 mt-2" x-show="filePreviews.length > 0">
                <template x-for="(file, index) in filePreviews" :key="index">
                    <div class="relative w-20 h-20 border border-gray-300 rounded p-1 flex flex-col items-center justify-center">
                        <button @click="removeFile(file)"
                                class="absolute -top-2 -right-2 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center text-xs font-bold">×</button>
                        <template x-if="file.preview">
                            <img :src="file.preview" class="object-cover w-full h-full rounded" />
                        </template>
                        <template x-if="!file.preview">
                            <div class="flex items-center justify-center w-full h-full text-gray-500 text-xs">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <span class="text-xs truncate" x-text="file.name"></span>
                            </div>
                        </template>
                    </div>
                </template>
            </div>

            <div class="relative">
                <input type="file" multiple x-ref="fileInput" @change="handleFileSelect" class="hidden" id="fileUpload" />
                <label for="fileUpload" class="cursor-pointer p-2 rounded-full hover:bg-gray-200 transition-colors">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828L18 9.828a4 4 0 10-5.656-5.656L6 11.172a6 6 0 108.485 8.485L21 13.828" />
                    </svg>
                </label>
            </div>

            <button @click="sendMessage" :disabled="!newMessage.trim() && files.length === 0"
                    class="px-4 py-2 rounded-lg bg-blue-500 text-white font-medium hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed transition-colors flex items-center gap-2">
                <div x-show="sendingMessage" class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                <span x-text="sendingMessage ? 'جاري الإرسال' : 'إرسال'"></span>
            </button>
        </div>
    </div>
</div>

<script>
function chatApp(routes, authId, perPage) {
    const storage = @json($storage);
    return {
        routes,
        authId,
        perPage,
        chats: [],
        filteredChats: [],
        searchQuery: '',
        messages: [],
        activeChat: null,
        newMessage: "",
        sendingMessage: false,
        currentPage: 1,
        hasMoreMessages: true,
        loadingOldMessages: false,
        autoScrollEnabled: true,
        files: [],
        filePreviews: [],

        normalizeFiles(files) {
            try {
                if (typeof files === "string") files = JSON.parse(files);
            } catch(e) { files = []; }
            return files.map(file => {
                if (file.type?.startsWith('image/') || file.type?.startsWith('video/')) {
                    return { ...file, preview: storage + '/' + file.path.replace(/\\/g, '/') };
                } else {
                    return { ...file, preview: null };
                }
            });
        },

        async init() {
            await this.loadChats();
            setInterval(() => { if(this.activeChat) this.refreshMessages(); }, 3000);
        },

        async loadChats() {
            try { let res = await axios.get(this.routes.getChats); this.chats = res.data; this.filteredChats = [...this.chats]; }
            catch(e){ console.error("خطأ في تحميل المحادثات", e); }
        },

        filterChats() {
            if (!this.searchQuery.trim()) { this.filteredChats = [...this.chats]; return; }
            this.filteredChats = this.chats.filter(chat =>
                chat.subject.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                (chat.last_message && chat.last_message.toLowerCase().includes(this.searchQuery.toLowerCase()))
            );
        },

        async selectChat(chat) {
            if(this.activeChat?.id===chat.id) return;
            this.activeChat=chat; this.messages=[]; this.currentPage=1; this.hasMoreMessages=true; this.autoScrollEnabled=true;
            await this.loadMessages();
        },

        async loadMessages() {
            if(!this.activeChat) return;
            try {
                let url = this.routes.getMessages.replace(":chat_id", this.activeChat.id).replace(":page", this.currentPage).replace(":per_page", this.perPage);
                let res = await axios.get(url);
                let newMessages = res.data.messages ?? res.data.data ?? res.data;
                newMessages = newMessages.map(msg=>{
                    msg.metaFiles=this.normalizeFiles(msg.meta);
                    return msg;
                });
                if(this.currentPage===1) { this.messages=newMessages.reverse(); this.$nextTick(()=>this.scrollToBottom(false)); }
                else { const oldHeight=this.$refs.messagesContainer.scrollHeight; this.messages=[...newMessages.reverse(),...this.messages]; this.$nextTick(()=>{ const newHeight=this.$refs.messagesContainer.scrollHeight; this.$refs.messagesContainer.scrollTop=newHeight-oldHeight; }); }
                this.hasMoreMessages = newMessages.length===this.perPage;
            } catch(e){ console.error("خطأ في تحميل الرسائل", e); }
        },

        async loadOlderMessages() { if(this.loadingOldMessages || !this.hasMoreMessages) return; this.loadingOldMessages=true; this.currentPage++; try{ await this.loadMessages(); }catch(e){ this.currentPage--; console.error(e); } finally{ this.loadingOldMessages=false; } },

        handleScroll() { const c=this.$refs.messagesContainer; if(c.scrollTop<100 && this.hasMoreMessages && !this.loadingOldMessages) this.loadOlderMessages(); this.autoScrollEnabled=(c.scrollHeight-c.scrollTop-c.clientHeight)<100; },
        scrollToBottom(smooth=false){ this.$refs.messagesContainer?.scrollTo({top:this.$refs.messagesContainer.scrollHeight,behavior:smooth?'smooth':'auto'}); },
        adjustTextareaHeight(){ const ta=this.$refs.messageInput; ta.style.height='auto'; ta.style.height=Math.min(ta.scrollHeight,130)+'px'; },
        handleEnterKey(){ if(!event.shiftKey) this.sendMessage(); },

        handleFileSelect(e){ const sel=[...e.target.files]; sel.forEach(file=>{ const reader=new FileReader(); reader.onload=(ev)=>{ this.filePreviews.push({name:file.name,size:file.size,preview:ev.target.result,rawFile:file}); }; if(file.type.startsWith('image/')||file.type.startsWith('video/')) reader.readAsDataURL(file); else reader.readAsArrayBuffer(file); this.files.push(file); }); e.target.value=''; },

        removeFile(file){ const i=this.filePreviews.indexOf(file); if(i!==-1) this.filePreviews.splice(i,1); const j=this.files.indexOf(file.rawFile); if(j!==-1) this.files.splice(j,1); },

        createTempMessage(content){ return {id:null,tempId:Date.now().toString()+Math.random().toString(36).substring(2,9),sender_id:this.authId,chat_id:this.activeChat?.id,message:content,created_at:new Date().toISOString(),isPending:true,failed:false,metaFiles:this.filePreviews}; },

        async sendMessage(){ if(!this.activeChat||(!this.newMessage.trim()&&this.filePreviews.length===0)) return; const msg=this.createTempMessage(this.newMessage); this.messages.push(msg); this.scrollToBottom(true); const fd=new FormData(); fd.append('chat_id',this.activeChat.id); fd.append('message',this.newMessage); this.filePreviews.forEach((f,i)=>fd.append(`files[${i}]`,f.rawFile||f.blob,f.name)); this.newMessage=''; this.filePreviews=[]; this.files=[]; this.sendingMessage=true; try{ let res=await axios.post(this.routes.sendMessage,fd,{headers:{'Content-Type':'multipart/form-data'}}); const idx=this.messages.findIndex(m=>m.tempId===msg.tempId); if(idx!==-1) this.messages[idx]=res.data.message??res.data; }catch(e){ console.error(e); msg.isPending=false; msg.failed=true; }finally{ this.sendingMessage=false; this.$nextTick(()=>this.scrollToBottom()); } },

        async retrySendMessage(failedMessage){ if(!this.activeChat) return; failedMessage.isPending=true; failedMessage.failed=false; const fd=new FormData(); fd.append('chat_id',this.activeChat.id); fd.append('message',failedMessage.message); if(failedMessage.metaFiles) failedMessage.metaFiles.forEach((file,i)=>{ if(file.rawFile) fd.append(`files[${i}]`,file.rawFile); else if(file.preview) fetch(file.preview).then(r=>r.blob()).then(b=>fd.append(`files[${i}]`,b,file.name)); }); try{ let res=await axios.post(this.routes.sendMessage,fd,{headers:{'Content-Type':'multipart/form-data'}}); const idx=this.messages.findIndex(m=>m.tempId===failedMessage.tempId); if(idx!==-1){ this.messages[idx].isPending=false; this.messages[idx].failed=false; this.messages[idx]=res.data.message??res.data; } }catch(e){ console.error(e); failedMessage.isPending=false; failedMessage.failed=true; } },

        formatTime(dateStr){ const d=new Date(dateStr); return d.toLocaleTimeString([],{hour:'2-digit',minute:'2-digit'}); },
        formatTimeAgo(dateStr){ const d=new Date(dateStr); const diff=(Date.now()-d.getTime())/1000; if(diff<60) return 'الآن'; if(diff<3600) return Math.floor(diff/60)+' دقيقة'; if(diff<86400) return Math.floor(diff/3600)+' ساعة'; return Math.floor(diff/86400)+' يوم'; },
    }
}
</script>
