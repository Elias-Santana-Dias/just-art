<script>
//inicialização paralax
$(document).ready(function(){
$('.parallax').parallax();
});
//inicialização menu lateral
$(document).ready(function(){
$('.sidenav').sidenav();
});
//Codigo para inicialização dos modais
$(document).ready(function(){
$('.modal').modal();
});

//Inicialização datepicker
$(document).ready(function(){
  $('.datepicker').datepicker({
 i18n: {
 months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
 monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
 weekdays: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'],
 weekdaysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
 weekdaysAbbrev: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
 today: 'Hoje',
 clear: 'Limpar',
 cancel: 'Sair',
 done: 'Confirmar',
 labelMonthNext: 'Próximo mês',
 labelMonthPrev: 'Mês anterior',
 labelMonthSelect: 'Selecione um mês',
 labelYearSelect: 'Selecione um ano',
 selectMonths: true,
 selectYears: 15,
 },
 format: 'dd/mm/yyyy',
 container: 'body'
 });

});

// select Formularios
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, options);
  });
  $(document).ready(function(){
    $('select').formSelect();
  });

//Carrossel
var instance = M.Carousel.init({
   fullWidth: true,
   indicators: true
 });
 $('.carousel.carousel-slider').carousel({
   fullWidth: true,
   indicators: true
 });

//Inicialização do material box
  $(document).ready(function(){
    $('.materialboxed').materialbox();
  });
// Slider Home
    $(document).ready(function(){
      $('.slider').slider({
        interval:6000000,
        duration:1500
      });
    });

//animação de opacidade
const debounce = function(func, wait, immediate) {
let timeout;
return function(...args) {
  const context = this;
  const later = function () {
    timeout = null;
    if (!immediate) func.apply(context, args);
  };
  const callNow = immediate && !timeout;
  clearTimeout(timeout);
  timeout = setTimeout(later, wait);
  if (callNow) func.apply(context, args);
};
};

const target = document.querySelectorAll('[data-anime]');
const animationClass = 'animate';

function animeScroll() {
const windowTop = window.pageYOffset + (window.innerHeight * 0.75);
target.forEach((element) => {
  if(windowTop > element.offsetTop) {
    element.classList.add(animationClass);
  }/* else {
    element.classList.remove(animationClass);
  }*/
})
}

animeScroll();

const handleScroll = debounce(animeScroll, 200);

if(target.length) {
window.addEventListener('scroll', handleScroll);
}

//explorar

function executar(){
  var texto= document.getElementById('pesquisar').value;
  var lista = document.getElementById('historico');
  var adicionar = true;
  var opt = document.createElement('option');

  for(i=0; i <lista.options.length; i++){
    if (texto==lista.options[i].value){
      adicionar=false;
    }
  }
  if(adicionar==true){
    opt.value=texto;
    lista.appendChild(opt);
  }
}

//Menu dropdraw
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems, options);
  });

  // Or with jQuery

  $('.dropdown-trigger').dropdown({
    coverTrigger:false
  });
//Contador
$(document).ready(function() {
    $('input#input_text, textarea#textarea').characterCounter();
  });
  //olho para mostrar senha
  function mostrarSenha(){
    var tipo = document.getElementById('password2');
    if (tipo.type == 'password'){
      tipo.type = 'text';
    }else{
      tipo.type = 'password';
    }
  }

  $(function(){
    $('.upload-perfil').change(function(){
      const file = $(this)[0].files[0]
      const fileReader = new FileReader()
      fileReader.onloadend = function(){
        $('.img-perfil').attr('src', fileReader.result)
      }
      fileReader.readAsDataURL(file)
    })
  })
</script>
<script type="text/javascript">
/*exibição de sugerencia de busca*/
  $('input.autocomplete').autocomplete({
      data: {
        <?php

        $ultimo = count($categorias);
        $categorias[$ultimo-1] = str_replace(",", "", $categorias[$ultimo-1]);
        foreach($categorias as $valor){

          echo $valor;

        }

        ?>
      },
    })
</script>
