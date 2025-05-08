import './bootstrap';

import 'turn.js';


import $ from 'jquery';
window.$ = $;
window.jQuery = $;

let escolaAll = '';
Livewire.on('escolas', ([{escolas}])=>{
    escolaAll = escolas
})

document.addEventListener('DOMContentLoaded', function () {
    escolaAll.forEach(escola => {

        const swiper = new Swiper(".swiper_" + escola.id, {
        loop: true,
        slidesPerView: 5.5,
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
    });
});

