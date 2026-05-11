@extends('front.layouts.app')

@section('title', 'Inscription Adhérent - COOPROM')

@section('content')
    <section class="auth-section-creative py-5 d-flex align-items-center justify-content-center overflow-hidden" style="min-height: 100vh; background: #fcfcfc; padding-top: 10px !important;">
        <!-- Animated Background Decor -->
        <div class="auth-bg-shapes position-absolute w-100 h-100 overflow-hidden" style="z-index: 1; top:0; left:0;">
            <div class="shape-1 position-absolute bg-danger opacity-05 rounded-circle" style="width: 600px; height: 600px; top: -300px; right: -200px; filter: blur(100px);"></div>
            <div class="shape-2 position-absolute bg-dark opacity-05 rounded-circle" style="width: 500px; height: 500px; bottom: -200px; left: -200px; filter: blur(80px);"></div>
        </div>

        <div class="auto-container position-relative z-index-2" style="max-width: 1200px;">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="auth-card-modern bg-white rounded-3xl shadow-2xl overflow-hidden animate-up">
                        <div class="row no-gutters m-0" x-data="{
                            step: 1,
                            role: '{{ old('role_type', 'artiste') }}',
                            sectorId: '{{ old('cultural_sector_id', '') }}',
                            sectors: @js($sectors),
                            globalAttributes: @js($globalAttributes),
                            get filteredSectors() {
                                return this.sectors.filter(s => s.allowed_roles && s.allowed_roles.includes(this.role));
                            },
                            get isOtherSectorSelected() {
                                let sector = this.sectors.find(s => s.id == this.sectorId);
                                return sector && sector.name.toUpperCase() === 'AUTRES';
                            },
                            get dynamicAttributes() {
                                let globals = this.globalAttributes.filter(a => !a.allowed_roles || a.allowed_roles.includes(this.role));
                                let sector = this.sectors.find(s => s.id == this.sectorId);
                                let sectorSpecific = sector ? sector.attributes.filter(a => !a.allowed_roles || a.allowed_roles.includes(this.role)) : [];
                                return [...globals, ...sectorSpecific].sort((a, b) => a.order_column - b.order_column);
                            },
                            nextStep() { if(this.step < 3) this.step++; window.scrollTo(0,0); },
                            prevStep() { if(this.step > 1) this.step--; window.scrollTo(0,0); }
                        }">
                            <!-- Sidebar Steps Info -->
                            <div class="col-lg-4 d-none d-lg-block bg-dark position-relative overflow-hidden">
                                <div class="side-img-wrapper h-100">
                                    <div class="bg-img h-100 w-100 position-absolute" style="background: url({{ asset('assets/front/images/background/12.jpg') }}) center/cover; opacity: 0.3;"></div>
                                    <div class="overlay position-absolute w-100 h-100" style="background: linear-gradient(135deg, rgba(255,60,54,0.8) 0%, rgba(0,0,0,0.95) 100%);"></div>

                                    <div class="side-content position-relative z-index-2 p-5 h-100 d-flex flex-column justify-content-between text-white">
                                        <div>
                                            <h2 class="display-5 font-weight-bold mb-4 text-white">Rejoignez <br><span class="text-transparent-stroke-white">l'Élite</span></h2>
                                            <p class="lead text-white small mb-5" style="opacity: 0.9;">Devenez membre de la plus grande coopérative artistique de Côte d'Ivoire.</p>
                                        </div>

                                        <!-- Progress Stepper -->
                                        <div class="stepper-vertical mt-4">
                                            <div class="step-item d-flex align-items-center mb-5" :class="step >= 1 ? 'active' : ''">
                                                <div class="step-icon mr-3 d-flex align-items-center justify-content-center" :class="step > 1 ? 'bg-success' : (step == 1 ? 'bg-danger' : 'bg-secondary')">
                                                    <i class="fas" :class="step > 1 ? 'fa-check' : 'fa-user'"></i>
                                                </div>
                                                <div class="step-text">
                                                    <h6 class="mb-0 font-weight-bold" :class="step == 1 ? 'text-white' : 'text-muted'">Identité</h6>
                                                    <span class="very-small text-muted">Rôle & Coordonnées</span>
                                                </div>
                                            </div>
                                            <div class="step-item d-flex align-items-center mb-5" :class="step >= 2 ? 'active' : ''">
                                                <div class="step-icon mr-3 d-flex align-items-center justify-content-center" :class="step > 2 ? 'bg-success' : (step == 2 ? 'bg-danger' : 'bg-secondary')">
                                                    <i class="fas" :class="step > 2 ? 'fa-check' : 'fa-briefcase'"></i>
                                                </div>
                                                <div class="step-text">
                                                    <h6 class="mb-0 font-weight-bold" :class="step == 2 ? 'text-white' : 'text-muted'">Profil Pro</h6>
                                                    <span class="very-small text-muted">Secteur & Détails</span>
                                                </div>
                                            </div>
                                            <div class="step-item d-flex align-items-center" :class="step >= 3 ? 'active' : ''">
                                                <div class="step-icon mr-3 d-flex align-items-center justify-content-center" :class="step == 3 ? 'bg-danger' : 'bg-secondary'">
                                                    <i class="fas fa-shield-alt"></i>
                                                </div>
                                                <div class="step-text">
                                                    <h6 class="mb-0 font-weight-bold" :class="step == 3 ? 'text-white' : 'text-muted'">Sécurité</h6>
                                                    <span class="very-small text-muted">Accès au compte</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-5 pt-5">
                                            <img src="{{ asset('assets/front/images/logo-white.png') }}" alt="COOPROM" style="height: 40px; opacity: 0.8;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Side -->
                            <div class="col-lg-8 p-4 p-md-5">
                                <div class="form-wrapper">
                                    <form method="post" action="{{ route('register') }}" id="creative-register-form">
                                        @csrf
                                        <input type="hidden" name="role_type" x-model="role">

                                        <!-- STEP 1: IDENTITY -->
                                        <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4">
                                            <div class="mb-5">
                                                <h3 class="font-weight-bold mb-2">Dites-nous qui vous êtes</h3>
                                                <p class="text-muted small">Choisissez votre profil pour commencer l'aventure.</p>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-5">
                                                    <label class="small text-uppercase font-weight-bold text-muted mb-4 d-block text-center">Je m'inscris en tant que :</label>
                                                    <div class="row text-center">
                                                        <div class="col-6 col-md-4 mb-3">
                                                            <div class="role-card p-3 p-md-4 rounded-xl border-2 transition cursor-pointer h-100 d-flex flex-column align-items-center justify-content-center" :class="role === 'artiste' ? 'border-danger bg-danger-soft' : 'border-light bg-light'" @click="role = 'artiste'">
                                                                <div class="icon-md mb-2 mb-md-3 text-danger"><i class="fas fa-palette fa-2x"></i></div>
                                                                <h6 class="font-weight-bold mb-0 small text-nowrap">Artiste</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 col-md-4 mb-3">
                                                            <div class="role-card p-3 p-md-4 rounded-xl border-2 transition cursor-pointer h-100 d-flex flex-column align-items-center justify-content-center" :class="role === 'organisation' ? 'border-danger bg-danger-soft' : 'border-light bg-light'" @click="role = 'organisation'">
                                                                <div class="icon-md mb-2 mb-md-3 text-danger"><i class="fas fa-building fa-2x"></i></div>
                                                                <h6 class="font-weight-bold mb-0 small text-nowrap">Organisation</h6>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-4 mb-3">
                                                            <div class="role-card p-3 p-md-4 rounded-xl border-2 transition cursor-pointer h-100 d-flex flex-column align-items-center justify-content-center" :class="role === 'individuel' ? 'border-danger bg-danger-soft' : 'border-light bg-light'" @click="role = 'individuel'">
                                                                <div class="icon-md mb-2 mb-md-3 text-danger"><i class="fas fa-user-circle fa-2x"></i></div>
                                                                <h6 class="font-weight-bold mb-0 small text-nowrap">Individuel</h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Common Fields Identity -->
                                                <template x-if="role === 'artiste' || role === 'individuel'">
                                                    <div class="col-md-6 mb-4">
                                                        <div class="form-floating-creative group">
                                                            <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Prénom</label>
                                                            <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                                <i class="fas fa-user text-muted mr-3"></i>
                                                                <input type="text" name="name" class="form-control-minimal" placeholder="Jean" value="{{ old('name') }}">
                                                            </div>
                                                            @error('name') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </template>

                                                <template x-if="role === 'artiste' || role === 'individuel'">
                                                    <div class="col-md-6 mb-4">
                                                        <div class="form-floating-creative group">
                                                            <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Nom</label>
                                                            <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                                <i class="fas fa-id-card text-muted mr-3"></i>
                                                                <input type="text" name="last_name" class="form-control-minimal" placeholder="Kouassi" value="{{ old('last_name') }}">
                                                            </div>
                                                            @error('last_name') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </template>

                                                <template x-if="role === 'organisation'">
                                                    <div class="col-md-6 mb-4">
                                                        <div class="form-floating-creative group">
                                                            <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Raison Sociale</label>
                                                            <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                                <i class="fas fa-building text-muted mr-3"></i>
                                                                <input type="text" name="company_name" class="form-control-minimal" placeholder="Ma Société SARL" value="{{ old('company_name') }}">
                                                            </div>
                                                            @error('company_name') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </template>

                                                <template x-if="role === 'organisation'">
                                                    <div class="col-md-6 mb-4">
                                                        <div class="form-floating-creative group">
                                                            <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Nom du Dirigeant</label>
                                                            <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                                <i class="fas fa-user-tie text-muted mr-3"></i>
                                                                <input type="text" name="manager_name" class="form-control-minimal" placeholder="Nom Complet" value="{{ old('manager_name') }}">
                                                            </div>
                                                            @error('manager_name') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </template>

                                                <div class="col-md-6 mb-4">
                                                    <div class="form-floating-creative group">
                                                        <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Email Professionnel</label>
                                                        <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                            <i class="fas fa-envelope text-muted mr-3"></i>
                                                            <input type="text" name="email" class="form-control-minimal" placeholder="votre@email.com" value="{{ old('email') }}" autocomplete="email">
                                                        </div>
                                                        @error('email') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6 mb-4">
                                                    <div class="form-floating-creative group">
                                                        <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Téléphone</label>
                                                        <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                            <i class="fas fa-phone text-muted mr-3"></i>
                                                            <input type="text" name="phone_number" class="form-control-minimal" placeholder="07XXXXXXXX" value="{{ old('phone_number') }}">
                                                        </div>
                                                        @error('phone_number') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <template x-if="role === 'organisation'">
                                                    <div class="col-md-6 mb-4">
                                                        <div class="form-floating-creative group">
                                                            <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Lieu d'implantation</label>
                                                            <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                                <i class="fas fa-map-marker-alt text-muted mr-3"></i>
                                                                <input type="text" name="implementation_place" class="form-control-minimal" placeholder="Abidjan, Cocody" value="{{ old('implementation_place') }}">
                                                            </div>
                                                            @error('implementation_place') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </template>

                                                <template x-if="role === 'artiste' || role === 'individuel'">
                                                    <div class="col-md-6 mb-4">
                                                        <div class="form-floating-creative group">
                                                            <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Lieu d'habitation</label>
                                                            <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                                <i class="fas fa-home text-muted mr-3"></i>
                                                                <input type="text" name="habitation_place" class="form-control-minimal" placeholder="Ville, Quartier" value="{{ old('habitation_place') }}">
                                                            </div>
                                                            @error('habitation_place') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>

                                        <!-- STEP 2: PROFESSIONAL PROFILE -->
                                        <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4">
                                            <div class="mb-5">
                                                <h3 class="font-weight-bold mb-2">Profil Professionnel</h3>
                                                <p class="text-muted small">Valorisez votre parcours avec des détails précis.</p>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-4" x-show="role !== 'individuel'">
                                                    <div class="form-floating-creative group">
                                                        <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">
                                                            <span x-text="role === 'organisation' ? 'Secteur d\'Activité' : 'Secteur Artistique'">Secteur Artistique</span>
                                                        </label>
                                                        <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                            <i class="fas fa-palette text-muted mr-3"></i>
                                                            <select name="cultural_sector_id" class="form-control-minimal cursor-pointer" x-model="sectorId">
                                                                <option value="" disabled selected>Choisir votre domaine</option>
                                                                <template x-for="sector in filteredSectors" :key="sector.id">
                                                                    <option :value="sector.id" x-text="sector.name" :selected="sector.id == sectorId"></option>
                                                                </template>
                                                            </select>
                                                        </div>
                                                        @error('cultural_sector_id') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <!-- Field for "AUTRES" or "Individuel" -->
                                                <div class="col-md-12 mb-4" x-show="role === 'individuel' || isOtherSectorSelected">
                                                    <div class="form-floating-creative group">
                                                        <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">
                                                            Précisez votre secteur d'activité
                                                        </label>
                                                        <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                            <i class="fas fa-pencil-alt text-muted mr-3"></i>
                                                            <input type="text" name="other_sector" class="form-control-minimal" placeholder="Ex: Sculpteur, Digital Artist..." value="{{ old('other_sector') }}">
                                                        </div>
                                                        @error('other_sector') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <!-- Role Specific Fields -->
                                                <template x-if="role === 'organisation'">
                                                    <div class="col-md-12 mb-4">
                                                        <div class="form-floating-creative group">
                                                            <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">N° Immatriculation (MC)</label>
                                                            <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                                <i class="fas fa-certificate text-muted mr-3"></i>
                                                                <input type="text" name="registration_number_mc" class="form-control-minimal" placeholder="MC-XXXX-XX" value="{{ old('registration_number_mc') }}">
                                                            </div>
                                                            @error('registration_number_mc') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </template>

                                                <template x-if="role === 'artiste'">
                                                    <div class="col-md-6 mb-4">
                                                        <div class="form-floating-creative group">
                                                            <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Numéro BURIDA</label>
                                                            <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                                <i class="fas fa-hashtag text-muted mr-3"></i>
                                                                <input type="text" name="burida_number" class="form-control-minimal" placeholder="4 chiffres" value="{{ old('burida_number') }}">
                                                            </div>
                                                            @error('burida_number') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </template>

                                                <template x-if="role === 'artiste'">
                                                    <div class="col-md-6 mb-4">
                                                        <div class="form-floating-creative group">
                                                            <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">N° CNI (Ivoirienne)</label>
                                                            <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                                <i class="fas fa-id-card-alt text-muted mr-3"></i>
                                                                <input type="text" name="cni_number" class="form-control-minimal" placeholder="CXXXXXXXX" value="{{ old('cni_number') }}">
                                                            </div>
                                                            @error('cni_number') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </template>

                                                <template x-if="role === 'artiste'">
                                                    <div class="col-md-12 mb-4">
                                                        <div class="form-floating-creative group">
                                                            <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Pseudonyme</label>
                                                            <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                                <i class="fas fa-mask text-muted mr-3"></i>
                                                                <input type="text" name="pseudonym" class="form-control-minimal" placeholder="Votre nom d'artiste" value="{{ old('pseudonym') }}">
                                                            </div>
                                                            @error('pseudonym') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </template>

                                                <template x-if="role === 'individuel'">
                                                    <div class="col-md-6 mb-4">
                                                        <div class="form-floating-creative group">
                                                            <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">N° CNPS</label>
                                                            <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                                <i class="fas fa-notes-medical text-muted mr-3"></i>
                                                                <input type="text" name="cnps_number" class="form-control-minimal" placeholder="Numéro CNPS" value="{{ old('cnps_number') }}">
                                                            </div>
                                                            @error('cnps_number') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </template>

                                                <template x-if="role === 'individuel'">
                                                    <div class="col-md-6 mb-4">
                                                        <div class="form-floating-creative group">
                                                            <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Profession</label>
                                                            <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                                <i class="fas fa-briefcase text-muted mr-3"></i>
                                                                <input type="text" name="profession" class="form-control-minimal" placeholder="Votre métier" value="{{ old('profession') }}">
                                                            </div>
                                                            @error('profession') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                        </div>
                                                    </div>
                                                </template>

                                                <!-- Attributs Dynamiques EAV -->
                                                <template x-for="attr in dynamicAttributes" :key="attr.name">
                                                    <div class="col-md-6 mb-4">
                                                        <div class="form-floating-creative group">
                                                            <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block" x-text="attr.label"></label>
                                                            <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                                <i class="fas fa-plus-circle text-muted mr-3"></i>
                                                                <template x-if="['text', 'email', 'number', 'password'].includes(attr.type)">
                                                                    <input :type="attr.type" :name="'attrs[' + attr.name + ']'" class="form-control-minimal" :placeholder="attr.label">
                                                                </template>
                                                                <template x-if="attr.type === 'select'">
                                                                    <select :name="'attrs[' + attr.name + ']'" class="form-control-minimal cursor-pointer">
                                                                        <option value="" disabled selected x-text="'Choisir ' + attr.label"></option>
                                                                        <template x-for="(optLabel, optValue) in attr.options" :key="optValue">
                                                                            <option :value="optValue" x-text="optLabel"></option>
                                                                        </template>
                                                                    </select>
                                                                </template>
                                                            </div>
                                                            <template x-if="Object.keys(@js($errors->get('attrs.*'))).some(k => k.startsWith('attrs.' + attr.name))">
                                                                <span class="text-danger very-small mt-1 d-block" x-text="'Champ ' + attr.label + ' invalide'"></span>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>

                                        <!-- STEP 3: SECURITY -->
                                        <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4">
                                            <div class="mb-5">
                                                <h3 class="font-weight-bold mb-2">Sécurisez votre accès</h3>
                                                <p class="text-muted small">Dernière étape avant de rejoindre la communauté.</p>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <div class="form-floating-creative group">
                                                        <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Mot de passe</label>
                                                        <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                            <i class="fas fa-lock text-muted mr-3"></i>
                                                            <input type="password" name="password" class="form-control-minimal" placeholder="••••••••">
                                                        </div>
                                                        @error('password') <span class="text-danger very-small mt-1 d-block">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mb-4">
                                                    <div class="form-floating-creative group">
                                                        <label class="small text-uppercase font-weight-bold text-muted mb-2 d-block">Confirmation du mot de passe</label>
                                                        <div class="input-group-modern d-flex align-items-center border-bottom pb-2">
                                                            <i class="fas fa-shield-alt text-muted mr-3"></i>
                                                            <input type="password" name="password_confirmation" class="form-control-minimal" placeholder="••••••••">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-3">
                                                    <div class="alert alert-info border-0 rounded-xl small">
                                                        <i class="fas fa-info-circle mr-2"></i> En cliquant sur "Finaliser mon inscription", vous acceptez nos conditions générales d'utilisation.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Navigation Buttons -->
                                        <div class="form-navigation d-flex justify-content-between align-items-center mt-5">
                                            <div>
                                                <button type="button" class="btn btn-link text-muted font-weight-bold p-0" x-show="step > 1" @click="prevStep()">
                                                    <i class="fas fa-arrow-left mr-2"></i> Retour
                                                </button>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <p class="text-muted small mb-0 mr-4 d-none d-md-block">Étape <span x-text="step"></span> sur 3</p>

                                                <button type="button" class="theme-btn btn-style-one py-3 px-5 shadow-lg border-0" x-show="step < 3" @click="nextStep()">
                                                    <span class="btn-title font-weight-bold">Continuer <i class="fas fa-arrow-right ml-2"></i></span>
                                                </button>

                                                <button type="submit" form="creative-register-form" class="theme-btn btn-style-one py-3 px-5 shadow-lg border-0" x-show="step === 3">
                                                    <span class="btn-title font-weight-bold">Finaliser l'inscription <i class="fas fa-check-circle ml-2"></i></span>
                                                </button>
                                            </div>
                                        </div>

                                        <p class="text-center mt-5 small text-muted">
                                            Déjà membre ? <a href="{{ route('login') }}" class="text-danger font-weight-bold text-decoration-none">Connectez-vous ici</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_js')
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<style>
    .auth-section-creative { position: relative; z-index: 1; }
    .z-index-2 { z-index: 2; }
    .rounded-3xl { border-radius: 40px !important; }
    .rounded-xl { border-radius: 15px !important; }
    .shadow-2xl { box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.15); }
    .opacity-05 { opacity: 0.05; }
    .border-2 { border-width: 2px !important; }
    .bg-danger-soft { background-color: rgba(255, 60, 54, 0.05) !important; }
    .transition { transition: all 0.3s ease; }

    .text-transparent-stroke-white { -webkit-text-stroke: 1px white; color: transparent; }

    .animate-up { opacity: 0; animation: fadeInUp 1s forwards; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }

    .form-control-minimal {
        border: none !important;
        background: transparent !important;
        padding: 5px 0 !important;
        font-weight: 600;
        color: #222 !important;
        width: 100%;
        font-size: 14px;
    }
    .form-control-minimal:focus { outline: none !important; box-shadow: none !important; }
    .input-group-modern { transition: 0.3s; border-bottom: 2px solid #f0f0f0 !important; }
    .group:focus-within .input-group-modern { border-bottom-color: #ff3c36 !important; }
    .group:focus-within i { color: #ff3c36 !important; }

    .role-card:hover { transform: translateY(-5px); border-color: #ff3c36 !important; }

    .step-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        transition: 0.3s;
    }
    .stepper-vertical .step-item { position: relative; }
    .stepper-vertical .step-item:not(:last-child):after {
        content: '';
        position: absolute;
        left: 20px;
        top: 40px;
        height: 40px;
        width: 2px;
        background: rgba(255,255,255,0.1);
    }
    .stepper-vertical .step-item.active:after { background: #ff3c36; }

    .very-small { font-size: 10px; }
    .no-gutters { margin-right: 0; margin-left: 0; }
    .no-gutters > .col, .no-gutters > [class*="col-"] { padding-right: 0; padding-left: 0; }

    .btn-style-one { background-color: #ff3c36; color: white; border-radius: 50px; transition: 0.4s; }
    .btn-style-one:hover { background-color: #222; transform: translateY(-3px); color: white; }

    .cursor-pointer { cursor: pointer; }
</style>
@endsection
