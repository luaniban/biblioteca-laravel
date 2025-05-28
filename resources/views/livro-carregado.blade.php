<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    *{
margin: 0;
padding: 0;
box-sizing: border-box;
font-family: "Poppins", sans-serif;
}

#body {
  display: grid;
  place-content: center;
  overflow: hidden;

  height: 100vh;
  width: 100vw;

  background-image: url('/img/fundoDoLivro.png');
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover; /* ou 'contain', veja observação abaixo */
}


.flipbook {


/* width: 1300px;
height: 400px; */

}

.flipbook .hard {
background: #ffffff !important;
color: #fff;
font-weight: bold;
border: none;

}

.flipbook .hard small{
font-style: italic;
font-weight: lighter;
opacity: 0.7;
font-size: 14px;
}

.flipbook .page {
background: white;
display: flex;
flex-direction: column;
justify-content: center;
align-items: center;
gap: 10px;
border: 1px solid rgba(0, 0, 0, 0.11);
}

.page img{
width: 100%;

margin: 2px;
box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.flipbook .page small{
font-size: 14px;
margin-bottom: 10px;
}

img{
width: 100%;
height: 100%;
}


</style>



<div id="body" >


<div class="flipbook" style="width: {{ $width }}; height: {{ $height }};">

    @php
        $count = 0;
    @endphp
    @foreach ($images as $image)
        <div class="hard"><img src="{{ asset($image) }}"/></div>
        @if($count == 1)
            @break
        @endif
        @php
            $count++;
        @endphp
    @endforeach

    @php
        $count = 0;
    @endphp

    @foreach ($images as $image)

    @if ($count >= 2)
        <div class="page"><img src="{{ asset($image) }}"/></div>

    @endif
    @php
    $count++;
    @endphp


    @endforeach


</div>
</div>


<script src="js/jquery.js"></script>
<script src="js/turn.js"></script>
<script>
$(".flipbook").turn();


  // Função para ir para a próxima página
//   function nextPage() {
//         $(".flipbook").turn('next');  // Usando a classe flipbook no jQuery
//     }

//     // Função para ir para a página anterior
//     function previousPage() {
//         $(".flipbook").turn('previous');  // Usando a classe flipbook no jQuery
//     }

//     // Vinculando as funções de navegação aos botões
//     $("button").click(function() {
//         if ($(this).text().includes("Próxima Página")) {
//             nextPage();
//         } else {
//             previousPage();
//         }
//     });

</script>
