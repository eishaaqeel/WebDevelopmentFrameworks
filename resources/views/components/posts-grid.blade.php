@props(['posts'])

<x-post-featured-card :post="$posts[0]"/>

{{--if there are more then 1 posts, then show them --}}
@if ($posts->count() > 1)
    <div class="lg:grid lg:grid-cols-6">
        <!--For each posts, skip the first one (because its already going to be shown as the featured post above)
        show the rest of the posts-->
        @foreach ($posts->skip(1) as $post)
            <x-post-card
                :post="$post"
                {{--check the loop to see if we are on a post that is less then 3rd (1st and 2nd posts after the featured post)
                if so then the coloum span should be 3 out of 6 otherwise 2 out of 6 --}}
                class="{{$loop->iteration < 3 ? 'col-span-3' : 'col-span-2'}}"
            />
        @endforeach
    </div>
@endif
