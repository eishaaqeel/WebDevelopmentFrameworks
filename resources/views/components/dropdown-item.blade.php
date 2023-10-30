@props(['active' => false])
{{--above, we set the prop to be false by default--}}

@php
    $classes = 'block text-left px-3 text-sm leading-6 hover:bg-blue-500 focus:bg-blue-500 hover:text-white focus:text-white';

    //if dropdown active, add the following to the $classes text
    if ($active) $classes .= ' bg-blue-500 text-white';
@endphp

<a {{ $attributes(['class' => $classes]) }}>
    {{$slot}}
</a>
