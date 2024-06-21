@aware(['page'])
<div class="px-4 py-4 md:py-8 d-flex">
    <div class="max-w-7xl mx-auto">
        <h1>{{$title}}</h1>
        <p>{{$content}}</p>
        <p>{{$image}}</p>
    </div>

    <img src="{{ storage_path('./app/public/'.$image)}}" alt="">
</div>
