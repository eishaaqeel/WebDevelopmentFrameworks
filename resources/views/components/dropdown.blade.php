@props(['trigger'])
{{--using alpine javascript here to make the Categories list NOT show unless the Categories button is clicked--}}
<div x-data="{show: false}" @click.away="show = false">
    {{--Trigger--}}
    {{--everytime the button is clicked agian, make it the oppisite of what it was,
    so if the categories were hidden and I clicked the button, the categories should show, and if I click it agian the categories show go back to being hidden--}}
    <div @click="show = ! show">
        {{$trigger}}
    </div>

    {{--Links in the dropdown--}}
    <div x-show="show" class="py-2 absolute bg-gray-100 mt-2 rounded-xl w-full z-50 overflow-auto max-h-52" style="display: none">
        {{$slot}}
    </div>
</div>
