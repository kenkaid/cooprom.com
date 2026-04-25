<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/admin/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">COOPROM</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class="bi bi-chevron-double-left"></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class="bi bi-house-door"></i>
                </div>
                <div class="menu-title">Tableau de bord</div>
            </a>
        </li>
        <li class="menu-label">Communauté & Utilisateurs</li>
        <li>
            <a href="{{ route('admin.users.index') }}">
                <div class="parent-icon"><i class="bi bi-people-fill"></i>
                </div>
                <div class="menu-title">Tous les Utilisateurs</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.cultural-sectors.index') }}">
                <div class="parent-icon"><i class="bi bi-layers-fill"></i>
                </div>
                <div class="menu-title">Secteurs Culturels</div>
            </a>
        </li>
        <li class="menu-label">Opérations Métiers</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-file-earmark-text-fill"></i>
                </div>
                <div class="menu-title">Contrats (Juridique)</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.contracts.index') }}"><i class="bi bi-arrow-right-short"></i>Tous les contrats</a>
                </li>
                <li> <a href="{{ route('admin.contracts.templates') }}"><i class="bi bi-arrow-right-short"></i>Modèles de contrats</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-camera-reels-fill"></i>
                </div>
                <div class="menu-title">Production Artistique</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.productions.index') }}"><i class="bi bi-arrow-right-short"></i>Projets de production</a>
                </li>
                <li> <a href="{{ route('admin.productions.monitoring') }}"><i class="bi bi-arrow-right-short"></i>Suivi technique</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fas fa-plane-departure"></i>
                </div>
                <div class="menu-title">Voyages & Mobilité</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.travels.index') }}"><i class="bi bi-arrow-right-short"></i>Voyages (Missions)</a>
                </li>
                <li> <a href="{{ route('admin.visa_applications.index') }}"><i class="bi bi-arrow-right-short"></i>Demandes de Visa</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Assistance & Conseil</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-info-circle-fill"></i>
                </div>
                <div class="menu-title">Orientation Visa</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.visa-guides.index') }}"><i class="bi bi-arrow-right-short"></i>Guides par pays</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-shield-lock-fill"></i>
                </div>
                <div class="menu-title">Conseil Juridique</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.legal-consultations.index') }}"><i class="bi bi-arrow-right-short"></i>Demandes de conseil</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-heart-fill"></i>
                </div>
                <div class="menu-title">Aide Sociale</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.solidarity-fund.index') }}"><i class="bi bi-arrow-right-short"></i>Fonds de solidarité</a>
                </li>
                <li> <a href="{{ route('admin.health-insurances.index') }}"><i class="bi bi-arrow-right-short"></i>Assurance Santé</a>
                </li>
                <li> <a href="{{ route('admin.retirement-simulations.index') }}"><i class="bi bi-arrow-right-short"></i>Accompagnement retraite</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">Organisation & Événements</li>
        <li>
            <a href="{{ route('admin.appointments.index') }}">
                <div class="parent-icon"><i class="bi bi-calendar-check-fill"></i>
                </div>
                <div class="menu-title">Agenda</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.events.index') }}">
                <div class="parent-icon"><i class="bi bi-calendar-event-fill"></i>
                </div>
                <div class="menu-title">Événements</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.partners.index') }}">
                <div class="parent-icon"><i class="bi bi-star-fill"></i>
                </div>
                <div class="menu-title">Partenaires</div>
            </a>
        </li>
        <li class="menu-label">Communication</li>
        <li>
            <a href="{{ route('admin.contacts.index') }}">
                <div class="parent-icon"><i class="bi bi-chat-dots-fill"></i>
                </div>
                <div class="menu-title">Messages Contacts</div>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.media-library.index') }}">
                <div class="parent-icon"><i class="bi bi-images"></i>
                </div>
                <div class="menu-title">Médiathèque</div>
            </a>
        </li>
        <li class="menu-label">Paramètres</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bi bi-gear-fill"></i>
                </div>
                <div class="menu-title">Configuration</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.roles.index') }}"><i class="bi bi-arrow-right-short"></i>Rôles</a>
                </li>
                <li> <a href="{{ route('admin.permissions.index') }}"><i class="bi bi-arrow-right-short"></i>Permissions</a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->
