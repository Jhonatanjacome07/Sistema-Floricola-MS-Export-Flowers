<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Actualizar contraseña') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Asegúrese de que su cuenta está usando una contraseña larga y aleatoria para mantenerse segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mx-auto" style="max-width: 900px;">
        @csrf
        @method('put')
    
        <div class="card text-white bg-amber" style="border-radius: 20px;">
            <div class="card-header">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <x-adminlte-input type="password" name="current_password" label="Contraseña actual" label-class="text-lightblue"
                            placeholder="Ingrese su contraseña actual" value="{{ old('current_password') }}">
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="invalid-feedback d-block" />
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lock text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                    <div class="col-md-6">
                        <x-adminlte-input type="password" name="password" label="Contraseña nueva" label-class="text-lightblue"
                            placeholder="Ingrese su nueva contraseña" value="{{ old('password') }}">
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="invalid-feedback d-block" />
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lock text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                    <div class="col-md-12">
                        <x-adminlte-input type="password" name="password_confirmation" label="Confirme la contraseña" label-class="text-lightblue"
                            placeholder="Confirme su nueva contraseña" value="{{ old('password_confirmation') }}">
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="invalid-feedback d-block" />
                            <x-slot name="prependSlot">
                                <div class="input-group-text">
                                    <i class="fas fa-lock text-lightblue"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    </div>
                </div>
                <div class="text-center">
                    <x-adminlte-button type="submit" label="Guardar" theme="success" icon="fas fa-save" />
                    @if (session('status') === 'password-updated')
                        <script>
                            window.onload = function() {
                                Swal.fire({
                                    title: 'Contraseña actualizada',
                                    icon: 'success',
                                    timer: 2000, // Controla la duración del mensaje
                                    showConfirmButton: false // Oculta el botón "OK"
                                });
                            };
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </form>
    
</section>
