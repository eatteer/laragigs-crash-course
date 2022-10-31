@props(['csvTags'])
@php
    $tags = explode(',', $csvTags);
@endphp
<ul class="flex flex-wrap gap-2">
    @foreach($tags as $tag)
        <li class="bg-black text-white rounded-xl px-3 py-1">
            <a href="/?tag={{$tag}}">{{$tag}}</a>
        </li>
    @endforeach
</ul>
