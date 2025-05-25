<x-layout>
    <main
        class="grid min-h-full place-items-center h-[calc(100dvh-220px)] rounded-lg border border-slate-200 bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="text-center">
            <p class="text-base font-semibold text-blue-500">404</p>
            <h1 class="mt-4 text-5xl font-semibold tracking-tight text-balance text-gray-900 sm:text-7xl">Page not found
            </h1>
            <p class="mt-6 text-lg font-medium text-pretty text-gray-500 sm:text-xl/8">Sorry, we couldn’t find the page
                you’re looking for.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="{{route('home')}}"
                    class="rounded-md bg-blue-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-blue-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500">Go
                    back home</a>
            </div>
        </div>
    </main>
</x-layout>