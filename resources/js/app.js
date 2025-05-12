import './bootstrap';

import 'turn.js';


import $ from 'jquery';
window.$ = $;
window.jQuery = $;

Livewire.on('escolas', ([{ escolas }]) => {
    setTimeout(() => {
        escolas.forEach(escola => {
            const el = document.querySelector(".swiper_" + escola.id);
            if (el) {
                new Swiper(".swiper_" + escola.id, {
                    loop: true,
                    slidesPerView: 4.5,
                    spaceBetween: 40,
                    slidesPerGroup: 2,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                    navigation: {
                        nextEl: ".swiper_" + escola.id + "_next",
                        prevEl: ".swiper_" + escola.id + "_prev",
                    },
                });
            }
        });
    }, 300); // espera o DOM atualizar
});

