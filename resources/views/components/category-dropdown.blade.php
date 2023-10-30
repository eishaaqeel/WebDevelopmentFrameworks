<x-dropdown>
    <x-slot name="trigger">
        <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">
            {{--if the user has slected a spcific category from the list and is now on that page, then where it's supposed to say the word 'Categories' it should instead show the spcific category they are on --}}
            {{isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories'}}
            <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;" />
        </button>
    </x-slot>

    <x-dropdown-item href="/?{{http_build_query(request()->except('category', 'page'))}}"
        {{--look at the current URI and check if it matches the route named 'home'--}}
        :active="request()->routeIs('home')">All
    </x-dropdown-item>

    @foreach ($categories as $category)
        <x-dropdown-item
            href="/?category={{$category->slug}}&{{http_build_query(request()->except('category', 'page'))}}"
            :active="request()->is('categories/' . $category->slug)">
                {{--ucwords = Make the first letter upercase --}}
                {{ucwords($category->name)}}
        </x-dropdown-item>
    @endforeach
</x-dropdown>
