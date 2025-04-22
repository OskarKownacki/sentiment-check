<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-white" href="/">Home</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link text-white" href="https://github.com/OskarKownacki/sentiment-check">Github page!</a>
          </li>
        </ul>
        @if(isset($username))
        <a class="link-offset-2 text-white mx-2 align-middle link-underline-opacity-0" href="/dashboard">Hello, {{$username}}</a>
        @else
        <a class="d-flex p-2 btn btn-primary mx-2" href="/login">Login</a>
        <a class="d-flex p-2 btn btn-secondary" href="/register">Register</a>
        @endif
      </div>
    </div>
  </nav>