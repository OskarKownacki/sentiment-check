<div class="d-flex align-items-center justify-content-center" style="height:80vh">
    <div class="fs-4 card text-bg-dark mb-3" style="width: 30%">
        <div class="card-header fs-2">Log into your account
        </div>
        <div class="card-body">
            <form wire:submit="login">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" wire:model="email" name="email" placeholder="email@domain.com">
                    <label for="emailInput">Email address</label>
                </div>
                <div>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="passwordInput" wire:model="password" name="password" placeholder="Your password">
                    <label for="passwordInput">Password</label>
                </div>
                <div>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-lg">Log in</button>
            </form>
        </div>
    </div>
</div>