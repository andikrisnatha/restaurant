import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import 'flowbite';
import('preline');
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();
