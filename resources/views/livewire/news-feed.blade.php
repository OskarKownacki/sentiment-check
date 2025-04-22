<div>
  @if(!$error)
    <div class="w-100 container-fluid g-2 d-flex align-items-center justify-content-end mt-2">
    <div style="width: 15%">
      <form wire:submit="fetchArticles" class="w-15">
      <div class="input-group mb-3">
        <input type="search" wire:model="search" class="form-control" placeholder="Search...">
        <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-magnifying-glass"></i></button>
      </div>
      </form>
    </div>
    </div>
    <div class="row w-100 p-5 g-2">
    @if(!$search)
    <div class="container-fluid g-2 d-flex align-items-center justify-content-center mt-2 alert alert-primary"
      role="alert" style="width: 30vw">
      <p class="fs-1"> Search for something!</p>
    </div>

  @endif
    @foreach($articles as $index => $article)
    <div class="col-md-4  mb-2">
      <div class="card h-100 border border-dark p-3 bg-dark text-white">
      <h3 role="button" wire:click="openFullscreen({{$index}})">{{$article->title}}</h3>
      <p class="mb-0">{{ $article->description }}</p>
      </div>
    </div>
  @endforeach

    @if($selectedArticle)
    <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5)" wire:transition>
      <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title">{{$selectedArticle->title}}</h5>
      <button type="button" class="btn-close" wire:click="closeFullscreen" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <img src="{{ $selectedArticle->urlToImage }}" class="img-fluid rounded mb-4">
      <p>{{$selectedArticle->description}}</p>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-secondary" wire:click="closeFullscreen">Close</button>
      <a class="btn btn-primary" href={{ $selectedArticle->url }}>Check out the article!</a>
      </div>
      </div>
      </div>
    </div>
  @endif
    </div>
  @else
    <p>An error ocurred: {{ $error }} </p>
  @endif
</div>