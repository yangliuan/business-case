import Echo from 'laravel-echo';

const pusher = require('pusher-js');

const echo = new Echo({
    broadcaster: 'pusher',
    key: 'yangliuan',
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    enabledTransports: ['ws', 'wss'],
})

export { echo }
