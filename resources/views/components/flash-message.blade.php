<div
    x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
    {{$attributes->merge(['class' => 'fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3'])}}
>
    <p>{{$message}}</p>
</div>
