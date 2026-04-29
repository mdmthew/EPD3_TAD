@extends('layouts.app')

@section('title', 'Nosotros')

@section('content')

<main>

  <section class="about-hero py-5">
    <div class="section-container container py-3">
      <div class="row align-items-center g-4">

        <div class="col-lg-6">
          <span class="section-subtitle">QUIÉNES SOMOS</span>
          <h1 class="display-5 fw-bold hero-title mb-3">
            Viajar bien no debería costar una fortuna
          </h1>

          <p class="lead text-secondary mb-4">
            Creamos guías en PDF con rutas reales, consejos útiles y recomendaciones seleccionadas a mano para que puedas viajar con criterio, sin perder tiempo ni dinero.
          </p>

          <div class="d-flex flex-wrap gap-3">
            <a href="{{ url('/guias') }}" class="btn-primary">
              <span>Ver guías</span>
              <i class="fas fa-arrow-right"></i>
            </a>

            <a href="#contacto" class="btn-secondary">
              Contacto directo
            </a>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="about-card glass-card p-4">
            <div class="d-flex align-items-center gap-3 mb-3">
              <div class="icon-circle">
                <i class="fas fa-map-location-dot"></i>
              </div>
              <div>
                <h2 class="h4 mb-1">Contenido práctico</h2>
                <p class="mb-0 text-secondary">
                  Guías pensadas para usar en viaje real.
                </p>
              </div>
            </div>

            <div class="row g-3">
              <div class="col-6">
                <div class="mini-stat">
                  <span>+20</span>
                  <small>Rutas creadas</small>
                </div>
              </div>

              <div class="col-6">
                <div class="mini-stat">
                  <span>2€</span>
                  <small>Precio medio</small>
                </div>
              </div>

              <div class="col-6">
                <div class="mini-stat">
                  <span>PDF</span>
                  <small>Descarga inmediata</small>
                </div>
              </div>

              <div class="col-6">
                <div class="mini-stat">
                  <span>24h</span>
                  <small>Soporte</small>
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="team-section py-5">
    <div class="section-container container">

      <div class="section-header text-center mb-4">
        <span class="section-subtitle">EQUIPO</span>
        <h2 class="section-title">Detrás del proyecto</h2>
      </div>

      <div class="row g-4">

        <div class="col-md-6">
          <article class="team-card guide-card h-100 p-4">

            <div class="d-flex align-items-center gap-3 mb-3">
              <div class="avatar-circle">A</div>
              <div>
                <h3 class="h5 mb-1">Ariel</h3>
                <p class="mb-0 text-secondary">Tecnología y seguridad</p>
              </div>
            </div>

            <p class="mb-0">
              Experto en seguridad digital con pasión por las culturas ancestrales. Reconocible por su estilo único y sus rastas a lo Bob Marley. Descifra códigos de programación y códigos culturales con igual destreza.
            </p>

          </article>
        </div>

        <div class="col-md-6">
          <article class="team-card guide-card h-100 p-4">

            <div class="d-flex align-items-center gap-3 mb-3">
              <div class="avatar-circle">Ab</div>
              <div>
                <h3 class="h5 mb-1">Abel</h3>
                <p class="mb-0 text-secondary">Contenido, rutas y edición</p>
              </div>
            </div>

            <p class="mb-0">
              Especialista en diseño de sistemas. Viaja siempre con sus herramientas por lo que pueda pasar. Encuentra la belleza en la funcionalidad y la autenticidad en cada destino.
            </p>

          </article>
        </div>

      </div>
    </div>
  </section>

  <section class="contact-section py-5" id="contacto">
    <div class="section-container container">

      <div class="row g-4 align-items-stretch">

        <div class="col-lg-5">
          <div class="contact-card guide-card h-100 p-4">

            <span class="section-subtitle">CONTACTO</span>
            <h2 class="section-title mb-3">
              Hablemos de tu próximo viaje
            </h2>

            <p class="text-secondary mb-4">
              Si necesitas modificar una guía, resolver una duda o proponer un destino nuevo, escríbenos por aquí.
            </p>

            <div class="contact-item mb-3">
              <i class="fas fa-phone"></i>
              <div>
                <small class="text-secondary d-block">Teléfono</small>
                <a href="tel:+34646795526">+34 646795526</a>
              </div>
            </div>

            <div class="contact-item mb-3">
              <i class="fas fa-envelope"></i>
              <div>
                <small class="text-secondary d-block">Correo</small>
                <a href="mailto:aarzocc@alu.upo.es">aarzocc@alu.upo.es</a>
              </div>
            </div>

            <div class="contact-item">
              <i class="fas fa-location-dot"></i>
              <div>
                <small class="text-secondary d-block">Base</small>
                <span>Sevilla, Andalucía</span>
              </div>
            </div>

          </div>
        </div>

        <div class="col-lg-7">
          <form class="guide-card h-100 p-4 needs-validation" novalidate>

            <div class="row g-3">

              <div class="col-md-6">
                <label class="form-label" for="nombre">Nombre</label>
                <input class="form-control" id="nombre" required>
                <div class="invalid-feedback">Introduce tu nombre.</div>
              </div>

              <div class="col-md-6">
                <label class="form-label" for="email">Correo</label>
                <input type="email" class="form-control" id="email" required>
                <div class="invalid-feedback">Introduce un correo válido.</div>
              </div>

              <div class="col-12">
                <label class="form-label" for="asunto">Asunto</label>
                <input class="form-control" id="asunto" required>
              </div>

              <div class="col-12">
                <label class="form-label" for="mensaje">Mensaje</label>
                <textarea class="form-control" id="mensaje" rows="4" required></textarea>
              </div>

              <div class="col-12">
                <button class="btn-primary w-100" type="submit">
                  Enviar mensaje
                </button>
              </div>

            </div>

          </form>
        </div>

      </div>

    </div>
  </section>

</main>

@endsection