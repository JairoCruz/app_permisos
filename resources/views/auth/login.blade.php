<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="col-md-5">
        <!-- Este error se muestra en caso el form de login lance un error -->
        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fase show " role="alert">
                <div class="row">

                    @foreach ($errors->all() as $message)
                        <div class="col-1">
                            <i class="bi-exclamation-triangle-fill"></i>
                        </div>
                        <div class="col-10">
                            <ul class="list-unstyled" style="margin-bottom: 0px">
                                <li><small>{{ $message }}</small></li>
                            </ul>
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach

                </div>
                
            </div>
        @endif
        <div class="">
            <div class="card px-4 py-4 border-dark-subtle">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
                        @csrf

                        <div class="form-group mb-3">
                            <label for="dui" class="form-label">Dui</label>
                            <div class="input-group has-validation">
                                <input type="text" class="form-control form-control-lg" id="dui" name="dui"
                                    value="{{ old('dui') }}" aria-describedby="duiHelp"
                                    placeholder="Ingrese el numero de DUI" required>
                                <div class="invalid-feedback">
                                    No puede quedar vacio el numero de DUI
                                </div>
                            </div>

                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group has-validation">
                                <input type="password" name="password" id="password"
                                    placeholder="Ingrese su contraseña" class="form-control form-control-lg"
                                    aria-describedby="passHelp" required>
                                <div class="invalid-feedback">
                                    No puede quedar vacio el password
                                </div>
                            </div>
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" class="form-check-input" id="remember_me">
                            <label for="remember_me">Recuerdame</label>
                        </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button class="btn btn-primary btn-lg">Acceder</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')
            console.log(forms);
            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>


</x-guest-layout>