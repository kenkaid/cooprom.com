import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

if (window.Echo) {
    const userId = document.querySelector('meta[name="user-id"]')?.content;
    if (userId) {
        window.Echo.private(`App.Models.User.${userId}`)
            .notification((notification) => {
                console.log('Nouvelle notification reçue:', notification);

                // Mettre à jour le compteur
                const badge = document.getElementById('notification-count');
                if (badge) {
                    const currentCount = parseInt(badge.innerText) || 0;
                    badge.innerText = currentCount + 1;
                    badge.style.display = 'flex';
                }

                // Ajouter à la liste
                const list = document.getElementById('notification-list');
                if (list) {
                    // Supprimer le message "Aucune notification" s'il existe
                    const emptyMsg = list.querySelector('.text-center');
                    if (emptyMsg) emptyMsg.remove();

                    const icon = notification.icon || 'bi-info-circle-fill';
                    const title = notification.title || 'Notification';
                    const message = notification.message || '';
                    const url = notification.url || '#';

                    // Détecter si on est sur l'admin ou le front
                    const isAdmin = document.querySelector('.wrapper') !== null;

                    let newItem = '';
                    if (isAdmin) {
                        // Structure compatible avec le header admin actuel
                        newItem = `
                            <a class="dropdown-item" href="${url}">
                                <div class="d-flex align-items-center">
                                    <div class="notification-box bg-light-primary text-primary"><i class="bi ${icon}"></i></div>
                                    <div class="ms-3 flex-grow-1" style="min-width: 0;">
                                        <h6 class="mb-0 dropdown-msg-user text-truncate">${title}</h6>
                                        <small class="mb-0 dropdown-msg-text text-secondary d-flex align-items-center text-truncate">${message}</small>
                                    </div>
                                </div>
                            </a>
                        `;
                    } else {
                        // Structure compatible avec le header front actuel
                        newItem = `
                            <a href="${url}" class="dropdown-item p-3 border-bottom d-flex align-items-start" style="white-space: normal;">
                                <div class="bg-light text-info rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 35px; height: 35px; flex-shrink: 0;">
                                    <i class="fa ${icon.replace('bi-', 'fa-')}" style="font-size: 14px;"></i>
                                </div>
                                <div>
                                    <div class="small font-weight-bold">${title}</div>
                                    <div class="small text-muted">${message.length > 50 ? message.substring(0, 50) + '...' : message}</div>
                                    <div class="very-small text-muted mt-1" style="font-size: 10px;">À l'instant</div>
                                </div>
                            </a>
                        `;
                    }
                    list.insertAdjacentHTML('afterbegin', newItem);
                }

                // Optionnel: Afficher un toast/alerte
                if (window.Lobibox) {
                    window.Lobibox.notify('info', {
                        pauseDelayOnHover: true,
                        continueDelayOnInactiveTab: false,
                        position: 'top right',
                        icon: `bi ${icon}`,
                        title: title,
                        msg: message || 'Vous avez une nouvelle notification'
                    });
                }
            });
    }
}
