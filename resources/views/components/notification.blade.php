{{--<!-- Notification libox js -->--}}
<script src="{{asset('assets/admin/plugins/notifications/js/lobibox.js')}}"></script>
<script src="{{asset('assets/admin/plugins/notifications/js/notifications.js')}}"></script>
<script src="{{asset('assets/admin/plugins/notifications/js/notification-custom-script.js')}}"></script>

<style>
    /* Esthétique premium pour les toasts Lobibox dans l'admin */
    .lobibox-notify-wrapper.top.right { right: 18px; top: 18px; }

    .lobibox-notify {
        border: 0 !important;
        border-radius: 16px !important;
        padding: 14px 16px 14px 14px !important;
        box-shadow: 0 10px 30px rgba(3, 7, 18, 0.18), 0 2px 10px rgba(3,7,18,.08) !important;
        backdrop-filter: saturate(140%) blur(6px);
        -webkit-backdrop-filter: saturate(140%) blur(6px);
        overflow: hidden;
        transform: translateZ(0);
        animation: toast-pop .35s cubic-bezier(.2,.9,.22,1.2);
    }

    /* Barre d’élégance (progress) */
    .lobibox-notify .lobibox-progressbar {
        height: 3px !important;
        bottom: 0; left: 0; right: 0;
        border-radius: 0 0 12px 12px;
        opacity: .9;
    }

    /* Icône + typographie */
    .lobibox-notify .lobibox-notify-icon { font-size: 20px !important; margin-top: 1px; }
    .lobibox-notify .lobibox-notify-body { padding-left: 10px !important; }
    .lobibox-notify .lobibox-notify-title { font-weight: 700 !important; font-size: 14px; margin-bottom: 2px; }
    .lobibox-notify .lobibox-notify-msg { font-size: 13px; line-height: 1.45; opacity: .95; }

    /* Thèmes par type (verre coloré) */
    .lobibox-notify-info, .lobibox-notify-default {
        background: linear-gradient(135deg, rgba(0,148,255,.10), rgba(0,148,255,.06)) !important;
        color: #0B5ED7 !important;
    }
    .lobibox-notify-success {
        background: linear-gradient(135deg, rgba(9,183,109,.12), rgba(9,183,109,.07)) !important;
        color: #0F9D58 !important;
    }
    .lobibox-notify-warning {
        background: linear-gradient(135deg, rgba(255,193,7,.16), rgba(255,193,7,.09)) !important;
        color: #A36E00 !important;
    }
    .lobibox-notify-error {
        background: linear-gradient(135deg, rgba(230,57,70,.16), rgba(230,57,70,.09)) !important;
        color: #B00020 !important;
    }

    /* Mode sombre: lisibilité accrue */
    .dark-theme .lobibox-notify-info { color: #5AB2FF !important; }
    .dark-theme .lobibox-notify-success { color: #46E3A8 !important; }
    .dark-theme .lobibox-notify-warning { color: #FFD166 !important; }
    .dark-theme .lobibox-notify-error { color: #FF6B81 !important; }

    /* Ligne lumineuse à gauche selon le type */
    .lobibox-notify:before {
        content: "";
        position: absolute; left: 0; top: 0; bottom: 0; width: 4px;
        background: currentColor; opacity: .28;
    }

    /* Bouton de fermeture discret */
    .lobibox-notify .lobibox-close { opacity: .6; transition: opacity .2s ease; }
    .lobibox-notify .lobibox-close:hover { opacity: .95; }

    /* Animation d’apparition */
    @keyframes toast-pop {
        from { transform: translate3d(0,-8px,0) scale(.98); opacity: 0; }
        to   { transform: translate3d(0,0,0) scale(1);   opacity: 1; }
    }

    /* Espacement vertical harmonieux */
    .lobibox-notify-wrapper .lobibox-notify { margin-top: 10px !important; }
</style>

<script type="text/javascript">

    @if(isset($errors) && $errors instanceof \Illuminate\Support\ViewErrorBag && $errors->any())
        @foreach($errors->all() as $error)
            warning_noti('<?= addslashes($error) ?>');
        @endforeach
    @endif

    @if(session('error'))
    error_noti('<?= addslashes(session('error')) ?>');
    @endif

    @if(session('success'))
    success_noti('<?= addslashes(session('success')) ?>');
    @endif
</script>
