<div class="py-12" x-data="{ 
    currency: 'IDR',
    t: {
        IDR: {
            title: 'Langganan Anda',
            desc: 'Kelola paket dan pantau penggunaan sumber daya Anda.',
            current_plan: 'Paket Saat Ini',
            limit_reached: 'Limit tercapai. Tingkatkan paket untuk menambah lebih banyak.',
            per_month: '/bulan',
            active_plan: 'Paket Saat Ini',
            choose: 'Pilih'
        },
        USD: {
            title: 'Your Subscription',
            desc: 'Manage your plan and monitor your resource usage.',
            current_plan: 'Current Plan',
            limit_reached: 'Limit reached. Upgrade your plan to add more.',
            per_month: '/month',
            active_plan: 'Current Plan',
            choose: 'Choose'
        }
    }
}">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        <!-- Current Plan & Usage -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
            <div class="p-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white" x-text="t[currency].title">Langganan Anda</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400" x-text="t[currency].desc">Kelola paket dan pantau penggunaan sumber daya Anda.</p>
                    </div>
                    <div class="inline-flex items-center px-4 py-2 rounded-full bg-indigo-50 dark:bg-indigo-500/10 border border-indigo-100 dark:border-indigo-500/20">
                        <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">
                            <span x-text="t[currency].current_plan">Paket Saat Ini</span>: {{ $owner->plan->label() }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($stats as $key => $stat)
                        <div class="space-y-3">
                            <div class="flex justify-between items-end">
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300" x-text="currency === 'IDR' ? '{{ $stat['label']['IDR'] }}' : '{{ $stat['label']['USD'] }}'">{{ $stat['label']['IDR'] }}</span>
                                <span class="text-xs text-gray-500">
                                    {{ $stat['current'] }} / {{ $stat['limit'] === -1 ? '∞' : $stat['limit'] }}
                                </span>
                            </div>
                            <div class="h-2 w-full bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                                @php
                                    $percentage = 0;
                                    if ($stat['limit'] === -1) {
                                        $percentage = 100;
                                    } elseif ($stat['limit'] > 0) {
                                        $percentage = min(($stat['current'] / $stat['limit']) * 100, 100);
                                    } else {
                                        $percentage = $stat['current'] > 0 ? 100 : 0;
                                    }

                                    $color = $percentage >= 90 ? 'bg-red-500' : ($percentage >= 70 ? 'bg-yellow-500' : 'bg-indigo-500');
                                @endphp
                                <div class="h-full {{ $color }} transition-all duration-500" style="width: {{ $percentage . '%' }}"></div>
                            </div>
                            @if($stat['limit'] !== -1 && $stat['current'] >= $stat['limit'])
                                <p class="text-[10px] text-red-500 font-medium" x-text="t[currency].limit_reached">Limit tercapai. Tingkatkan paket untuk menambah lebih banyak.</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Plan Selection -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="col-span-1 md:col-span-3 flex justify-center mb-4">
                <div class="flex items-center space-x-4">
                    <span :class="{ 'text-gray-900 dark:text-white font-bold': currency === 'IDR', 'text-gray-500': currency !== 'IDR' }" class="text-xs transition-colors cursor-pointer" @click="currency = 'IDR'">IDR</span>
                    <button 
                        @click="currency = currency === 'IDR' ? 'USD' : 'IDR'" 
                        class="relative inline-flex h-5 w-10 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none bg-gray-200 dark:bg-gray-700"
                    >
                        <span aria-hidden="true" :class="currency === 'USD' ? 'translate-x-5' : 'translate-x-0'" class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                    </button>
                    <span :class="{ 'text-gray-900 dark:text-white font-bold': currency === 'USD', 'text-gray-500': currency !== 'USD' }" class="text-xs transition-colors cursor-pointer" @click="currency = 'USD'">USD</span>
                </div>
            </div>

            @foreach($plans as $id => $plan)
                <div class="flex flex-col p-6 bg-white dark:bg-gray-800 rounded-2xl border {{ $owner->plan->value === $id ? 'border-indigo-500 ring-1 ring-indigo-500' : 'border-gray-200 dark:border-gray-700' }} shadow-sm">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1" x-text="currency === 'IDR' ? '{{ $plan['name']['IDR'] }}' : '{{ $plan['name']['USD'] }}'">{{ $plan['name']['IDR'] }}</h3>
                    <div class="text-2xl font-black text-gray-900 dark:text-white mb-6">
                        <span x-show="currency === 'IDR'">{{ $plan['price'] }}</span>
                        <span x-show="currency === 'USD'">{{ $plan['price_usd'] }}</span>
                        <span class="text-xs font-normal text-gray-500" x-text="t[currency].per_month">/bulan</span>
                    </div>
                    
                    <ul class="space-y-3 mb-8 flex-1">
                        <template x-if="currency === 'IDR'">
                            @foreach($plan['features']['IDR'] as $feature)
                                <li class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </template>
                        <template x-if="currency === 'USD'">
                            @foreach($plan['features']['USD'] as $feature)
                                <li class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </template>
                    </ul>

                    @if($owner->plan->value === $id)
                        <button disabled class="w-full py-2.5 px-4 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-400 text-sm font-bold cursor-not-allowed" x-text="t[currency].active_plan">
                            Paket Saat Ini
                        </button>
                    @else
                        <button 
                            wire:click="upgrade('{{ $id }}')"
                            class="w-full py-2.5 px-4 rounded-xl {{ $id === 'pro' ? 'bg-indigo-600 text-white hover:bg-indigo-700 shadow-lg shadow-indigo-500/20' : 'bg-gray-900 dark:bg-gray-700 text-white hover:bg-black dark:hover:bg-gray-600' }} text-sm font-bold transition active:scale-95"
                        >
                            <span x-text="t[currency].choose">Pilih</span> <span x-text="currency === 'IDR' ? '{{ $plan['name']['IDR'] }}' : '{{ $plan['name']['USD'] }}'">{{ $plan['name']['IDR'] }}</span>
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
