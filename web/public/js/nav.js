const navToggleBtns = document.querySelectorAll('.toggle-nav');
const mainNav = document.getElementById('main-nav');

for (const btn of navToggleBtns) {
    btn.addEventListener('click', () => {
      mainNav.classList.toggle('display');
    });
}