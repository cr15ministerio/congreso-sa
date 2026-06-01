<div class="bg-white border-bottom py-2 mb-4">
    <div class="container d-flex justify-content-between align-items-center">

        <div>
            <a href="/talleres" class="btn btn-outline-dark btn-sm me-2">
                Talleres
            </a>

            <a href="/consultar-inscripcion" class="btn btn-outline-dark btn-sm">
                Consultar inscripción
            </a>

             <!-- <a href="/proponer-taller" class="btn btn-outline-dark btn-sm">
                Proponer un taller
            </a> -->
            <a href="/mesas" class="btn btn-outline-dark btn-sm me-2">
                Mesas
            </a>
            <a href="/stands" class="btn btn-outline-dark btn-sm me-2">
                Stands
            </a>
        </div>

        <div>
            @auth
                <span class="me-2 small">
                    {{ Auth::user()->nombre }}
                </span>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm">
                        Salir
                    </button>
                </form>
            @endauth

           @guest
    <a href="{{ route('login') }}" class="btn btn-outline-dark btn-sm me-2">
        Ingresar
    </a>

    <a href="{{ route('register') }}" class="btn btn-dark btn-sm">
        Registrarse
    </a>
@endguest
        </div>

    </div>
</div>