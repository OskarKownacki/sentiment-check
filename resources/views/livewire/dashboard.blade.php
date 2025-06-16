<div class="container-flex card">
    <div class="card-header fs-1">
        Dashboard
    </div>
    <div class="card-body">
        <button wire:click="logout" class="btn btn-primary"> Logout
        </button>
        <h2 class="my-2">Saved articles</h2>
        <div class="row justify-content-center my-2">
            @foreach ($articles as $index => $article)
                <div class="col-md-4  mb-2">
                    <div class="card h-100 border border-dark p-3 pb-4 bg-dark text-white position-relative">
                        <h3 role="button" wire:click="openFullscreen({{ $index }})">{{ $article["title"] }}</h3>
                        <p class="mb-0">{{ $article["description"] }}</p>
                        @if (Auth::check())
                            <button wire:click="saveNews({{ $index }})" class="btn p-0 position-absolute"
                                style="bottom: 1rem; right: 1rem; color: white; height: 2rem; width: 2rem;">
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
            @if ($selectedArticle)
                <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5)"
                    wire:transition>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $selectedArticle["title"] }}</h5>
                                <button type="button" class="btn-close" wire:click="closeFullscreen"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ $selectedArticle["link_to_image"] }}" class="img-fluid rounded mb-4">
                                <p>{{ $selectedArticle["description"] }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    wire:click="closeFullscreen">Close</button>
                                <a class="btn btn-primary" href={{ $selectedArticle["link_to_article"] }}>Check out the article!</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div>
        </div>
    </div>
