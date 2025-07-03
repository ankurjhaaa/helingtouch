import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

console.log('✅ Echo initialized');

window.Echo.channel('appointments')
    .listen('.new-appointment', (e) => {
        console.log('📢 Appointment received:', e);

        const box = document.getElementById('notification-box');
        const items = document.getElementById('notification-items');
        const count = document.getElementById('notification-count');

        const html = `<div class="alert alert-info mb-1 py-1 px-2">
            ${e.appointment.name} booked at ${e.appointment.time}
        </div>`;
        items.innerHTML = html + items.innerHTML;

        let c = parseInt(localStorage.getItem('notificationCount') || '0') + 1;
        localStorage.setItem('notificationCount', c);
        count.innerText = c;
        count.classList.remove('hidden');

        if (!localStorage.getItem('muted')) {
            new Audio('/sound/notify.mp3').play();
        }
    });

window.toggleMute = function () {
    if (localStorage.getItem('muted')) {
        localStorage.removeItem('muted');
        alert("🔊 Sound ON");
    } else {
        localStorage.setItem('muted', true);
        alert("🔇 Sound OFF");
    }
}

window.toggleNotificationPanel = function () {
    const panel = document.getElementById('notification-box');
    const count = document.getElementById('notification-count');
    if (panel.style.display === 'none') {
        panel.style.display = 'block';
        localStorage.setItem('notificationCount', 0);
        count.innerText = '0';
        count.classList.add('hidden');
    } else {
        panel.style.display = 'none';
    }
}
