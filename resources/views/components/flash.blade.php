{{--if the session contains the 'success' message--}}
@if (session()->has('success'))
    {{--set the success message, from the session, to show for about 4 seconds--}}
    <div x-data="{show:true}"
            x-init="setTimeout(()=>show=false, 4000)"
            x-show="show"
            class="fixed bg-blue-500 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm"
    >
        <p>
            {{session('success')}}
        </p>
    </div>
@endif
