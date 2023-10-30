<x-layout>
    @include('posts._header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        {{--if there are posts, then display them--}}
        @if ($posts->count())
            <x-posts-grid :posts="$posts"/>

            {{--show pagination--}}
            {{$posts->links()}}

        {{--else there are NO posts, so display the message below--}}
        @else
            <p class="text-center">No posts yet. Please check back later.</p>
        @endif
    </main>
</x-layout>
