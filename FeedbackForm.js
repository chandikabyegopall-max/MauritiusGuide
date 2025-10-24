const stars = document.querySelectorAll('.rating i');
const ratingInput = document.querySelector('.rating input[name="rating"]');

stars.forEach((star, index) => {
  star.addEventListener('click', () => {
    // Reset all stars
    stars.forEach(s => {
      s.classList.replace('bxs-star', 'bx-star');
      s.classList.remove('active');
    });

    // Activate selected stars
    for (let i = 0; i <= index; i++) {
      stars[i].classList.replace('bx-star', 'bxs-star');
      stars[i].classList.add('active');
    }

    // Update hidden input value
    ratingInput.value = index + 1;
  });
});


document.querySelector('.btn-submit').addEventListener('click', function(e) {
  e.preventDefault(); // Prevent form from refreshing

  const email = document.querySelector('input[name="emailaddress"]').value;
  const firstName = document.querySelector('input[name="firstname"]').value;
  const lastName = document.querySelector('input[name="lastname"]').value;
  const rating = document.querySelector('input[name="rating"]').value;
  const opinion = document.querySelector('textarea[name="opinion"]').value;

  const feedback = {
    email,
    firstName,
    lastName,
    rating,
    opinion,
    timestamp: new Date().toISOString()
  };

  // Store in localStorage
  const allFeedback = JSON.parse(localStorage.getItem('feedbackList')) || [];
  allFeedback.push(feedback);
  localStorage.setItem('feedbackList', JSON.stringify(allFeedback));

  alert("Thanks for your feedback!");
});



console.log(JSON.parse(localStorage.getItem('feedbackList')));
