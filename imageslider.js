const cardItems = document.querySelectorAll('.card-item');
const leftArrow = document.querySelector('.arrow.left');
const rightArrow = document.querySelector('.arrow.right');
let currentIndex = 0;

function showSlide(index) {
  cardItems.forEach((item, i) => {
    item.classList.toggle('active', i === index);
  });
}

leftArrow.addEventListener('click', () => {
  currentIndex = (currentIndex - 1 + cardItems.length) % cardItems.length;
  showSlide(currentIndex);
});

rightArrow.addEventListener('click', () => {
  currentIndex = (currentIndex + 1) % cardItems.length;
  showSlide(currentIndex);
});

showSlide(currentIndex);
