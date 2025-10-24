const modeSwitch = document.getElementById('mode-switch');
const modeText = document.getElementById('mode-text');
// Check saved mode on page load
let isDark = localStorage.getItem('theme') === 'dark';

if (isDark) {
  document.body.classList.add('dark');

  modeSwitch.src = 'images/lightmode.png';
  modeSwitch.alt = 'Light Mode';
  modeText.textContent = 'Switch to Light Mode';
} else {
  document.body.classList.remove('dark');
  modeSwitch.src = 'images/darkmode.png';
  modeSwitch.alt = 'Dark Mode';
  modeText.textContent = 'Switch to Dark Mode';
}

// Toggle mode on click
modeSwitch.addEventListener('click', () => {
  isDark = !isDark;
  document.body.classList.toggle('dark');

  if (isDark) {
    modeSwitch.src = 'images/lightmode.png';
    modeSwitch.alt = 'Light Mode';
    modeText.textContent = 'Switch to Light Mode';
    localStorage.setItem('theme', 'dark');
  } else {
    modeSwitch.src = 'images/darkmode.png';
    modeSwitch.alt = 'Dark Mode';
    modeText.textContent = 'Switch to Dark Mode';
    localStorage.setItem('theme', 'light');
  }
});
