document.addEventListener('DOMContentLoaded', function () {
   const mobileMenuBtn = document.getElementById('mobile-menu-btn');
   const menuMobile = document.querySelector('.menu-mobile');
   const desktopMenu = document.querySelector('.menu');

   // Función para ocultar la barra lateral
   function hideSidebar() {
      menuMobile.style.display = 'none';
      desktopMenu.style.display = 'none';
   }

   mobileMenuBtn.addEventListener('click', function () {
      if (window.innerWidth <= 768) {
         menuMobile.style.display = (menuMobile.style.display === 'block') ? 'none' : 'block';
      } else {
         desktopMenu.style.display = 'none';
      }
   });

   window.addEventListener('resize', function () {
      if (window.innerWidth > 768) {
         menuMobile.style.display = 'none';
         desktopMenu.style.display = 'block';
      } else {
         desktopMenu.style.display = 'none';
      }
   });

   // Event listener para cerrar la barra lateral al hacer clic fuera de ella
   document.addEventListener('click', function (event) {
      const isClickInsideMenu = menuMobile.contains(event.target) || mobileMenuBtn.contains(event.target);
      if (!isClickInsideMenu && window.innerWidth <= 768) {
         hideSidebar();
      }
   });
});