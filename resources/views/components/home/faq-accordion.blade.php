    <h2 class="text-3xl font-extrabold mb-12 text-center">Frequently Asked Questions</h2>
    <div class="space-y-4">
        @foreach([['q' => 'Is it free?', 'a' => 'Yes!'], ['q' => 'Is it secure?', 'a' => 'Yes, very.']] as $idx => $item)
            <div class="bg-gray-900 rounded-lg overflow-hidden">
                <button @click="open = open === {{ $idx }} ? null : {{ $idx }}" class="w-full text-left p-6 flex justify-between">
                    {{ $item['q'] }}
                    <span x-text="open === {{ $idx }} ? '-' : '+'"></span>
                </button>
                <div x-show="open === {{ $idx }}" class="p-6 text-gray-400">
                    {{ $item['a'] }}
                </div>
            </div>
        @endforeach
    </div>
</section>
