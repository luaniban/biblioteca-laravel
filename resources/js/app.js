import './bootstrap';

import 'turn.js';

// import Alpine from 'alpinejs';
// window.Alpine = Alpine;


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
                    breakpoints: {
                        // até 1024px
                        1024: {
                            slidesPerView: 4.5,
                        },
                        // até 768px
                        768: {
                            slidesPerView: 3.5,
                        },
                        // até 640px
                        640: {
                            slidesPerView: 2.5,
                        },
                        // até 480px
                        480: {
                            slidesPerView: 1.5,

                        },
                        200: {
                            slidesPerView:1.5,

                        }
                    }
                });
            }
        });
    }, 300); // espera o DOM atualizar
});

