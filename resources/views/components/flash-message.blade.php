@if(session()->has('message'))
{{-- https://alpinejs.dev we need to import this very simple js to layout and use it to make the message disapears after 3 seconds --}}
<div x-data="{show: true}" x-init="setTimeout(()=> show = false , 3000)" x-show="show" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">
    <p>
        {{session('message')}}
    </p>
</div>
@endif