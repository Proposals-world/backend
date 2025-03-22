$(document).ready(function () {
  const $flowerContainer = $('#flower-container');

  function createFlower() {
      const $flower = $('<div class="flower"></div>').css({
          left: Math.random() * $(window).width() + 'px',
          animationDuration: (3 + Math.random() * 5) + 's'
      });

      $flowerContainer.append($flower);

      $flower.on('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd', function () {
          $(this).remove();
      });
  }

  setInterval(createFlower, 300);
});


