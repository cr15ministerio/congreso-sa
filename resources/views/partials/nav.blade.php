<div class="bg-white border-bottom py-2 mb-4">
    <div class="container d-flex justify-content-between align-items-center">

        <div>
            <a href="/talleres" class="btn btn-outline-dark btn-sm me-2">
                Talleres
            </a>

            <a href="/consultar-inscripcion" class="btn btn-outline-dark btn-sm">
                Consultar inscripción
            </a>

            <a href="/certificados" class="btn btn-outline-dark btn-sm">
                Certificados
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
            <!-- agregado para admin -->
            @auth

    @if(auth()->user()->rol == 'admin')

        <a href="/participantes"
           class="btn btn-outline-dark btn-sm me-2">
            Participantes
        </a>

        <a href="/admin/propuestas-talleres"
           class="btn btn-outline-dark btn-sm me-2">
            Propuestas de talleres
        </a>

        <a href="/acreditaciones"

       class="btn btn-outline-dark btn-sm">

        QR y acreditaciones

        </a>

        <a href="/asistencias"

       class="btn btn-outline-dark btn-sm">

        Asistencia

        </a>

    @endif

@endauth
             <!-- fin de agregado para admin -->
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