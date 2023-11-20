function showLandingPage() {
  const loaderWrapper = document.querySelector('.loader-wrapper');
  const cons = document.querySelector('.cons');
  const loader = document.querySelector('.loader');

  loaderWrapper.style.display = 'none';
  loader.style.display = 'none';
  cons.style.display = 'block';

  console.log('showLandingPage function is called');
  console.log('cons, style:', cons.style);
}

// When the page is fully loaded
window.addEventListener('load', function () {
  const loader = document.querySelector(".loader");

  loader.classList.add("loader--hidden");

  loader.addEventListener("transitionend", () => {
    document.body.removeChild(loader);
  });

  console.log('Window load event is triggered');

  // Hide the loader after a delay
  setTimeout(showLandingPage, 500);
});
