@php
    $stars = cache()->remember('github_stars', 3600, function () {
        try {
            $response = Illuminate\Support\Facades\Http::get('https://api.github.com/repos/syofyanzuhad/sshelf');
            return $response->json('stargazers_count') ?? 0;
        } catch (\Exception $e) {
            return 0;
        }
    });
@endphp

<a href="https://github.com/syofyanzuhad/sshelf" target="_blank" {{ $attributes->merge(['class' => 'flex items-center space-x-2']) }}>
    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
        <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.205 11.385.6.082.818-.26.818-.577 0-.285-.012-1.235-.018-2.23-3.338.724-4.042-1.415-4.042-1.415-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222 0 1.606-.014 2.898-.014 3.293 0 .319.216.694.825.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
    </svg>
    <span class="font-semibold">GitHub</span>
    @if($stars > 0)
        <span class="flex items-center space-x-0.5 bg-gray-100 dark:bg-gray-800 px-1.5 py-0.5 rounded text-[10px] font-bold text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700">
            <svg class="w-2.5 h-2.5 text-yellow-500 fill-current" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
            </svg>
            <span>{{ number_format($stars) }}</span>
        </span>
    @endif
</a>
