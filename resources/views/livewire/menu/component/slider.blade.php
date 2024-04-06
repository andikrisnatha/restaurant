<div x-data="modal">
    <template x-if="open">
        <div x-data="{ show: false }" x-init="$nextTick(() => { show = true })" x-show="show"
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 overflow-hidden z-[9999999]"
            x-transition:enter="transform transition-all duration-300 ease-in-out"
            x-transition:leave="transform transition-all duration-300 ease-in-out"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="flex items-center justify-center h-full w-full p-11">
                <div @click.away="closeModal" class="mx-auto h-auto w-full max-w-xl relative">
                    <!-- Background -->
                    <div class="absolute top-0 right-0">
                        <div class="-mt-2 transform -translate-y-full">
                            <button @click.prevent="closeModal"
                                class="rounded-full bg-white/30 hover:bg-white/70 text-neutral-800 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 fill-current">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="h-80 w-80 relative">
                        <div id="default-carousel" class="relative w-full h-full" data-carousel="slide">
                            <div class="relative w-full h-full overflow-hidden flex justify-center items-center">
                                @foreach ($promotions as $promotion)
                                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                                    <img src="{{ asset('/storage/menu/promotion/' . $promotion->image) }}"
                                    class="absolute inset-0 object-cover object-center w-full h-full" alt="...">
                                </div>
                                @endforeach
                            </div>
                            
                            <button type="button" class="absolute top-1/2 left-4 transform -translate-y-1/2 z-30 bg-white/30 hover:bg-white/70 text-neutral-800 rounded-full p-2 cursor-pointer group focus:outline-none" data-carousel-prev>
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 3L4 9l6 6m4-6h-6"/></svg>
                            </button>
                            <button type="button" class="absolute top-1/2 right-4 transform -translate-y-1/2 z-30 bg-white/30 hover:bg-white/70 text-neutral-800 rounded-full p-2 cursor-pointer group focus:outline-none" data-carousel-next>
                                <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 3L16 9l-6 6m-4-6h6"/></svg>
                            </button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

<script>
    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    
    document.addEventListener('alpine:init', () => {
        Alpine.data('modal', () => ({
            open: !getCookie("modal"),
            
            closeModal() {
                this.open = !this.open
                var now = new Date();
                var time = now.getTime();
                var expireTime = time + (30 * 60 * 1000); //30 = menit
                now.setTime(expireTime);
                document.cookie = 'modal=true;expires=' + now.toUTCString() + ';path=/';
            },
        }))
    })
</script>
