@php
    $providerID = $provider->id;
    $routes = [
        "getChats" => route('provider.Dashboard.ProviderGetChat', $providerID),
        "getMessages" => route('provider.Dashboard.ProviderGetChatMessage', ':chat_id'),
        "sendMessage" => route('provider.Dashboard.ProviderChat.store'),
    ];
    //dd($routes);
@endphp

<div class="h-screen flex overflow-hidden bg-gray-50"
     x-data="chatApp({{ Js::from($routes) }})">

    <!-- القائمة الجانبية -->
    <div class="hidden md:flex md:w-1/3 lg:w-1/4 border-l bg-white flex-col">
        <div class="p-4 border-b">
            <input type="text" placeholder="بحث..."
                class="w-full h-10 rounded-lg border border-slate-300 px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:outline-none">
        </div>

        <div class="flex-1 p-2 space-y-2 overflow-y-auto">
            <template x-for="chat in chats" :key="chat.id">
                <div class="p-3 rounded-lg cursor-pointer flex items-center gap-3 hover:bg-slate-100"
                     @click="selectChat(chat)">
                    <div class="h-10 w-10 rounded-full bg-slate-200"></div>
                    <div class="flex-1">
                        <p class="font-semibold text-sm truncate" x-text="chat.client_name"></p>
                        <p class="text-xs text-slate-500 truncate" x-text="chat.last_message"></p>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <!-- منطقة المحادثة -->
    <div class="flex-1 flex flex-col">
        <!-- الهيدر -->
        <div class="p-4 border-b flex items-center gap-3 bg-white shrink-0">
            <div class="h-10 w-10 rounded-full bg-slate-200"></div>
            <div>
                <p class="font-bold" x-text="activeChat?.client_name || 'اختر محادثة'"></p>
                <p class="text-xs text-green-500" x-show="activeChat">متصل الآن</p>
            </div>
        </div>

        <!-- الرسائل -->
        <div class="flex-1 p-6 space-y-6 bg-slate-50 flex flex-col justify-end overflow-y-auto">
            <template x-for="msg in messages" :key="msg.id">
                <div :class="msg.sender === 'provider' ? 'flex justify-end' : 'flex justify-start'">
                    <div :class="msg.sender === 'provider'
                                ? 'max-w-xs lg:max-w-md p-3 rounded-2xl bg-primary text-white rounded-br-none'
                                : 'max-w-xs lg:max-w-md p-3 rounded-2xl bg-white rounded-bl-none shadow-sm'">
                        <p x-text="msg.content"></p>
                        <p class="text-xs mt-1"
                           :class="msg.sender === 'provider' ? 'text-white/70' : 'text-slate-400'"
                           x-text="msg.time"></p>
                    </div>
                </div>
            </template>
        </div>

        <!-- حقل الإدخال -->
        <div class="p-4 border-t bg-white flex items-center gap-2 shrink-0" x-show="activeChat">
            <input type="text" placeholder="اكتب رسالتك..."
                x-model="newMessage"
                @keydown.enter="sendMessage"
                class="flex-1 h-10 rounded-lg border border-slate-300 px-3 py-2 text-sm focus:ring-2 focus:ring-primary focus:outline-none">
            <button @click="sendMessage"
                class="h-10 px-4 py-2 bg-primary text-white rounded-lg shadow hover:bg-primary/90">
                إرسال
            </button>
        </div>
    </div>
</div>

<script>
function chatApp(routes) {
    return {
        routes,
        chats: [],
        messages: [],
        activeChat: null,
        newMessage: "",

        async init() {
            try {
                let res = await axios.get(this.routes.getChats);
                this.chats = res.data;
            } catch (e) {
                console.error("خطأ في تحميل المحادثات", e);
            }
        },

        async selectChat(chat) {
            this.activeChat = chat;
            this.messages = [];
            try {
                let url = this.routes.getMessages.replace(":chat_id", chat.id);
                let res = await axios.get(url);
                this.messages = res.data;
            } catch (e) {
                console.error("خطأ في تحميل الرسائل", e);
            }
        },

        async sendMessage() {
            if (!this.newMessage.trim() || !this.activeChat) return;
            try {
                let res = await axios.post(this.routes.sendMessage, {
                    chat_id: this.activeChat.id,
                    content: this.newMessage
                });
                this.messages.push(res.data);
                this.newMessage = "";
            } catch (e) {
                console.error("خطأ في إرسال الرسالة", e);
            }
        }
    }
}
</script>
