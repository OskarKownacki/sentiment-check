<div class="d-flex align-items-center justify-content-center" style="height:80vh">
    <div class="fs-4 card text-bg-dark mb-3" style="width: 30%">
        <div class="card-header fs-2">Register your account
        </div>
        <div class="card-body">
            <form wire:submit="register">
                <div>
                    <label for="usernameInput" class="form-label">Username</label>
                    <input type="text" id="usernameInput" wire:model="username" name="username">
                </div>
                <div>
                    @error('username') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="emailInput" class="form-label">Email address</label>
                    <input type="email" id="emailInput" wire:model="email" name="email">
                </div>
                <div>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="passwordInput" class="form-label">Password</label>
                    <input type="password" id="passwordInput" wire:model="password" name="password">
                </div>
                <div>
                    @error('password') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="passwordConfirmationInput" class="form-label">Confirm password</label>
                    <input type="password" id="passwordConfirmationInput" wire:model="password_confirmation"
                        name="password_confirmation">
                </div>
                <button type="submit" class="btn btn-primary btn-lg">Register</button>
            </form>
        </div>
    </div>
</div>