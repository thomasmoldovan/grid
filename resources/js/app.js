import './bootstrap';
import './bootstrapicon-iconpicker.min';

import Alpine from 'alpinejs';
import Trix from "trix"

document.addEventListener("trix-before-initialize", () => {
  // Change Trix.config if you need
})

window.Alpine = Alpine;

Alpine.start();
