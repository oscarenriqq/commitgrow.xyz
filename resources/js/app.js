import './bootstrap';

import Clipboard from '@ryangjchandler/alpine-clipboard';

import Alpine from 'alpinejs';

Alpine.plugin(Clipboard);

window.Alpine = Alpine;
Alpine.start();
