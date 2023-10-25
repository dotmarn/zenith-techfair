import './bootstrap';
import '../css/app.css';

import Alpine from 'alpinejs';
import { createPopper } from "@popperjs/core";

import intlTelInput from 'intl-tel-input';

window.intlTelInput = intlTelInput;

window.Alpine = Alpine;

Alpine.start();
window.createPopper = createPopper;