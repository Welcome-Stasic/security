let burger = document.getElementById("burger");
let menu = document.getElementById('menu-header');
burger.addEventListener('click', (e) => {
    menu.classList.toggle('show');
    burger.classList.toggle('active');
    if (menu.classList.contains('show')) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = 'unset';
    }
});
