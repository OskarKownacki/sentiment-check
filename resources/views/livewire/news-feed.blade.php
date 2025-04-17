<div class="container-fluid g-2">
    <div class="row p-5 g-2">
    @foreach($articles as $index => $article)
    <div class="col-md-4  mb-2">
        <div class="card h-100 border border-dark p-3 bg-dark text-white">
        <h3>{{$article->title}}</h3>
        <p class="mb-0">{{ $article->description }}</p>
        </div>
    </div>
    @endforeach
    </div>
</div>
