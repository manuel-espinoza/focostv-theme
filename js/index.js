document.addEventListener('DOMContentLoaded', function () {

  // toogle menu
  const focostvToggleButton = document.getElementById('focostv-toggle-button')
  const focostvSiteToggleNavigation = document.getElementById('focostv-site-toggle-navigation')

  focostvToggleButton.addEventListener('click', () => {

    focostvToggleButton.classList.toggle('focostv-menu-open')
    focostvSiteToggleNavigation.classList.toggle('focostv-menu-open')

    const icon = focostvToggleButton.querySelector("i")

    if (focostvToggleButton.classList.contains('focostv-menu-open')) {
      icon.classList.remove('fa-bars')
      icon.classList.add('fa-xmark')
    } else {
      icon.classList.remove("fa-xmark");
      icon.classList.add("fa-bars");
    }
  })

  //toggle search
  const focostvToggleSearch = document.getElementById('focostv-toggle-search')
  const focostvSearch = document.getElementById('focostv-site-search')

  focostvToggleSearch.addEventListener('click', () => {
    focostvToggleSearch.classList.toggle('focostv-search-open')
    focostvSearch.classList.toggle('focostv-search-open')

    const icon = focostvToggleSearch.querySelector("i")

    if (focostvToggleSearch.classList.contains('focostv-search-open')) {
      icon.classList.remove('fa-bars')
      icon.classList.add('fa-xmark')
    }
    else {
      icon.classList.remove("fa-xmark");
      icon.classList.add("fa-bars");
    }
  })

  function updatePostVisibility() {
    const posts = document.querySelectorAll('.focostv-documentaries-post-item');
    const windowWidth = window.innerWidth;

    posts.forEach((post, index) => {
      if (windowWidth >= 1024) {
        // Show all posts if the screen width is 1024px or more
        post.style.display = 'flex';
      } else {
        // Show only the first post if the screen width is less than 1024px
        post.style.display = (index === 0) ? 'block' : 'none';
      }
    });
  }

  function updateTopicalityPostClass() {

    const fifthPost = document.querySelectorAll('.focostv-basic-page-post-item')[5]; // middle element for each 10 posts
    if (fifthPost) {
      if (window.innerWidth >= 1024) {
        // Remove the class if screen width is 1024px or more
        fifthPost.classList.remove('focostv-basic-page-first-post');
        fifthPost.querySelector('.focostv-front-page-post-excerpt').style.display = 'none';
      } else {
        // Add the class back if screen width is less than 1024px
        fifthPost.classList.add('focostv-basic-page-first-post');
        fifthPost.querySelector('.focostv-front-page-post-excerpt').style.display = 'block';
      }
    }
  }

  // Execute the function on page load
  updatePostVisibility();
  updateTopicalityPostClass();

  // Execute the function on window resize
  window.addEventListener('resize', () => {
    updatePostVisibility();
    updateTopicalityPostClass();
  });

  /*************************************LOAD MORE POSTS SCRIPTS */
  let page = 2;
  let loading = false;

  function loadMorePosts() {
    loading = true;
    const xhr = new XMLHttpRequest();
    xhr.open('POST', '/wp-admin/admin-ajax.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
      if (xhr.status === 200) {
        const container = document.getElementById('focostv-topicality-posts-container');
        container.innerHTML += xhr.responseText;
        page++;
        loading = false;
      }
    };

    xhr.send('action=focostv_load_more_topicality_posts&page=' + page);
  }

  const loadMoreBtn = document.getElementById('load-more-posts');

  loadMoreBtn.addEventListener('click', () => {
    loadMorePosts();
  })
  // const onScrollTopicality = () => {
  //   if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 500) {
  //     loadMorePosts()
  //   }
  // }

  // window.addEventListener('scroll', onScrollTopicality())
});

/*********CAROUSEL SCRIPTS ***************************/
let currentIndex = 0;
const cards = document.querySelectorAll('.focostv-research-carousel-card');
const totalCards = cards.length;

document.querySelector('.focostv-research-carousel-next').addEventListener('click', nextSlide);
document.querySelector('.focostv-research-carousel-prev').addEventListener('click', prevSlide);

function nextSlide() {
  currentIndex = (currentIndex + 1) % totalCards;
  updateCarousel();
}

function prevSlide() {
  currentIndex = (currentIndex - 1 + totalCards) % totalCards;
  updateCarousel();
}

function currentSlide(index) {
  currentIndex = index - 1;
  updateCarousel();
}

function updateCarousel() {
  const carousel = document.querySelector('.focostv-research-carousel');
  carousel.style.transform = `translateX(-${currentIndex * 100}%)`;

  const dots = document.querySelectorAll('.focostv-research-carousel-dot');
  dots.forEach((dot, index) => {
    dot.classList.toggle('focostv-research-carousel-dot-active', index === currentIndex);
  });
}

// CAROUSEL SCRIPTS Swipe functionality
const carousel = document.querySelector('.focostv-research-carousel');

carousel.addEventListener('touchstart', (event) => {
  startX = event.touches[0].clientX;
});

carousel.addEventListener('touchmove', (event) => {
  endX = event.touches[0].clientX;
});

carousel.addEventListener('touchend', () => {
  if (startX > endX + 50) { // Swipe left
    nextSlide();
  } else if (startX < endX - 50) { // Swipe right
    prevSlide();
  }
});

updateCarousel();

