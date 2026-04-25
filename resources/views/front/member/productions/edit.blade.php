@extends('front.layouts.app')

@section('title', 'Modifier le Projet - COOPROM')

@section('content')
    @php
        $image_link = 'assets/front/images/resource/members/production.jpeg';
        $title = 'Modifier la Production';
        $breadcumb_table = ['member.productions.index'=>'Productions', 'Modifier'];
    @endphp
    @include('front.member.partials.slide_header')

    <section class="dashboard-section pt-5 pb-5">
        <div class="auto-container">
            <div class="row">
                @include('front.member.partials.sidebar')

                <div class="col-lg-9 col-md-12 col-12">
                    <div class="inner-column bg-white p-4 rounded shadow-sm">
                        <h3>Modifier mon projet de production</h3>
                        <p>Vous pouvez modifier les détails de votre projet tant qu'il est en attente.</p>
                        <hr>

                        <div class="contact-form default-form">
                            <form method="post" action="{{ route('member.productions.update', $production->uuid) }}"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                @include('front.member.productions._form')

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group text-right">
                                    <a href="{{ route('member.productions.index') }}"
                                       class="theme-btn btn-style-two mr-2"><span class="btn-title">Annuler</span></a>
                                    <button class="theme-btn btn-style-one bg_orange text-white" type="submit"><span
                                            class="btn-title">Enregistrer les modifications</span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('extra_css')
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .bg_orange {
            background-color: #fa584d !important;
        }

        .text_orange {
            color: #fa584d !important;
        }

        .ql-toolbar.ql-snow {
            border: 1px solid #ddd;
            border-radius: 5px 5px 0 0;
        }

        .ql-container.ql-snow {
            border: 1px solid #ddd;
            border-radius: 0 0 5px 5px;
        }
    </style>
@endsection

@section('extra_js')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        var quill = new Quill('#quill-editor', {
            theme: 'snow',
            placeholder: 'Détaillez votre projet, vos besoins techniques, etc.',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{'list': 'ordered'}, {'list': 'bullet'}],
                    ['link', 'clean']
                ]
            }
        });

        // Pré-remplir l'input avec le contenu actuel
        var descriptionInput = document.getElementById('description-input');
        descriptionInput.value = quill.root.innerHTML;

        // Synchronisation en temps réel
        quill.on('text-change', function () {
            var html = quill.root.innerHTML;
            if (quill.getText().trim().length === 0) {
                descriptionInput.value = '';
            } else {
                descriptionInput.value = html;
            }
        });

        var form = document.querySelector('.contact-form form');
        form.onsubmit = function (e) {
            var quillHtml = quill.root.innerHTML;

            // Debug
            console.log('Quill HTML at submit:', quillHtml);

            // Double check avant l'envoi
            if (quill.getText().trim().length === 0) {
                descriptionInput.value = '';
            } else {
                descriptionInput.value = quillHtml;
            }

            console.log('Description Input Value before FormData:', descriptionInput.value);

            e.preventDefault();
            var formData = new FormData(form);
            console.log('FormData description:', formData.get('description'));

            uploadWithProgress(formData);
        };

        function uploadWithProgress(formData) {
            var xhr = new XMLHttpRequest();
            var progressBar = document.querySelector('.progress');
            var progressBarInner = document.getElementById('upload-progress');
            var submitBtn = form.querySelector('button[type="submit"]');

            progressBar.style.display = 'flex';
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="btn-title">Mise à jour...</span>';

            xhr.upload.addEventListener('progress', function (e) {
                if (e.lengthComputable) {
                    var percentComplete = (e.loaded / e.total) * 100;
                    progressBarInner.style.width = percentComplete + '%';
                }
            }, false);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        try {
                            var response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                window.location.href = response.redirect;
                            } else {
                                alert(response.message || "Une erreur est survenue.");
                                resetSubmitState();
                            }
                        } catch (e) {
                            window.location.href = "{{ route('member.productions.index') }}";
                        }
                    } else if (xhr.status === 422) {
                        var errors = JSON.parse(xhr.responseText).errors;
                        var errorMsg = "Erreurs de validation :\n";
                        for (var key in errors) {
                            errorMsg += "- " + errors[key][0] + "\n";
                        }
                        alert(errorMsg);
                        resetSubmitState();
                    } else {
                        alert("Une erreur est survenue lors de l'envoi (Code: " + xhr.status + ")");
                        resetSubmitState();
                    }
                }
            };

            function resetSubmitState() {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span class="btn-title">Enregistrer les modifications</span>';
                progressBar.style.display = 'none';
                progressBarInner.style.width = '0%';
            }

            xhr.open('POST', form.action, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.send(formData);
        }
    </script>
@endsection
