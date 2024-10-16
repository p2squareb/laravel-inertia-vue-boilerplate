const setThemeOnLoad = () => {
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    }else{
        document.documentElement.classList.remove('dark');
    }

}

const switchTheme = () => {
    if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.remove('dark');
        localStorage.theme = 'light';
    }else{
        document.documentElement.classList.add('dark');
        localStorage.theme = 'dark';
    }
}

const getTheme = () => {
    return localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)
        ? 'dark'
        : 'light';
};

export { setThemeOnLoad, switchTheme, getTheme };
