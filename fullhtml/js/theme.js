const themeIcon = {
  dark:'<i class="fa-regular fa-moon-stars fa-fw"></i>',
  light:'<i class="fa-regular fa-sun fa-fw"></i>'
}

const themeSwitch = document.querySelector('#themeSwitch');
const btnTheme = document.querySelector('#btn-theme');

// Cargar tema inicial
const storedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');

function setTheme(theme) {
    document.documentElement.setAttribute('data-bs-theme', theme);
    localStorage.setItem('theme', theme);
    if (btnTheme) btnTheme.innerHTML = themeIcon[theme];
    if (themeSwitch) themeSwitch.checked = (theme === 'dark');
}

// Inicializar
setTheme(storedTheme);

function toggleTheme() {
    const newTheme = themeSwitch.checked ? 'dark' : 'light';
    setTheme(newTheme);
}
