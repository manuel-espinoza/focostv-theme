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
  /*************************************LOAD MORE POSTS SCRIPTS ************************************/
  function getPostsContainer(categoryName) {
    if (categoryName === 'research') {
      return 'focostv-research-posts-container';
    }
    else if (categoryName === 'topicality') {
      return 'focostv-topicality-posts-container';
    }
    else if (categoryName === 'documentaries') {
      return 'focostv-documentaries-posts-container';
    }
  }


  let page = 2;
  let loading = false;
  let lastScrollTop = 0;

  const currentURL = window.location.pathname;
  let category;

  if (currentURL.includes('investigacion')) {
    category = 'research';
  } else if (currentURL.includes('actualidad')) {
    category = 'topicality';
  }
  else if (currentURL.includes('documentales')) {
    category = 'documentaries';
  }

  const containerId = getPostsContainer(category);
  const loaderMorePosts = document.getElementById('focostv-load-more-posts');
  const container = document.getElementById(containerId);

  // Obtén el número máximo de páginas desde el atributo data-max-pages
  const maxPages = container ? parseInt(container.getAttribute('data-max-pages'), 10) : 0;

  // Solo agrega el event listener de scroll si hay más de una página
  if (maxPages > 1) {
    window.addEventListener('scroll', handleScroll);
  }

  function loadMorePosts() {
    if (loading) return;

    if (category) {
      loading = true;
      loaderMorePosts.style.display = 'block';

      const xhr = new XMLHttpRequest();
      xhr.open('POST', '/wp-admin/admin-ajax.php', true);
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

      xhr.onload = function () {
        if (xhr.status === 200) {
          const response = JSON.parse(xhr.responseText);
          container.innerHTML += response.posts_html;
          page++;
          loading = false;
          loaderMorePosts.style.display = 'none';
          if (page > response.max_pages) {
            window.removeEventListener('scroll', handleScroll);
          }
        }
      };

      xhr.send('action=focostv_load_more_' + category + '_posts&page=' + page);
    }
  }

  function handleScroll() {
    let st = window.scrollY || document.documentElement.scrollTop;

    if (st > lastScrollTop) {
      const footer = document.querySelector('footer');
      const footerHeight = footer.offsetHeight;

      if (window.innerHeight + window.scrollY >= document.body.scrollHeight - (footerHeight + 100)) {
        loadMorePosts();
      }
    }
    lastScrollTop = st;
  }

  function togglePaginationVisibility() {
    if (window.innerWidth >= 1024) {
      window.removeEventListener('scroll', handleScroll);
    } else if (maxPages > 1) { // Asegúrate de que solo se añada el event listener si hay más de una página
      window.addEventListener('scroll', handleScroll);
    }
  }

  /*************************AUDIO POSTS SCRIPTS *************************/
  const audioPostButton = document.getElementById('focostv-post-audio-btn');
  const containerAudioPost = document.getElementById('focostv-audio-post');
  const containerAudioPostClose = document.getElementById('focostv-audio-post-close-btn');
  const audioPlayButton = document.getElementById('focostv-audio-post-play-btn');
  const progressBar = document.getElementById('audio-progress-bar');

  let isPaused = false;
  audioPostButton?.addEventListener('click', () => {
    containerAudioPost.style.display = 'block';
  })

  containerAudioPostClose?.addEventListener('click', () => {
    containerAudioPost.style.display = 'none';

    if (responsiveVoice.isPlaying()) {
      responsiveVoice.cancel();
    }
    stopProgressBar();
    const playIcon = document.getElementById('audio-post-play');
    playIcon.classList.remove('fa-pause');
    playIcon.classList.add('fa-play');
    isPaused = false;
  })


  audioPlayButton?.addEventListener('click', () => {
    let textToRead = '';
    const audioContent = document.querySelector('.focostv-post-content');
    const playIcon = document.getElementById('audio-post-play');

    if (audioContent) {
      textToRead = audioContent.innerText;
    }

    if (!responsiveVoice.isPlaying() && !isPaused) {
      responsiveVoice.speak(textToRead, "Spanish Latin American Male", {
        onstart: function () {
          playIcon.classList.remove('fa-play');
          playIcon.classList.add('fa-pause');
          startProgressBar();
        },
        onend: function () {
          playIcon.classList.remove('fa-pause');
          playIcon.classList.add('fa-play');
          isPaused = false;
          stopProgressBar();
        }
      });
    } else if (isPaused) {
      responsiveVoice.resume();
      playIcon.classList.remove('fa-play');
      playIcon.classList.add('fa-pause');
      startProgressBar();
      isPaused = false;
    } else {
      responsiveVoice.pause();
      playIcon.classList.remove('fa-pause');
      playIcon.classList.add('fa-play');
      isPaused = true;
      stopProgressBar();
    }
  });

  function startProgressBar() {
    progressBar.classList.add('loading');
  }

  function stopProgressBar() {
    progressBar.classList.remove('loading');
  }

  /*************************** POSTS VIDEO COMPONENT *******************/
  const videoModal = document.getElementById('focostv-video-post');
  const postVideoButton = document.getElementById('focostv-post-video-btn');
  const postVideoCloseButton = document.getElementById('focostv-video-post-close-btn');

  postVideoButton?.addEventListener('click', () => {
    videoModal.style.display = 'flex';
  });

  postVideoCloseButton?.addEventListener('click', () => {
    videoModal.style.display = 'none';
  });

  /*************************  POSTS SHARE FUNCTIONS */
  var modal = document.getElementById("focostv-social-media-share-modal");
  var postShareButton = document.getElementById("focostv-post-shared-btn");
  var postShareCloseButton = document.getElementsByClassName("focostv-share-modal-close")[0];
  var copyPostButton = document.getElementById("copy-link-btn");
  var shareLink = document.getElementById("share-link");

  postShareButton?.addEventListener('click',
    () => {
      modal.style.display = 'flex';
    }
  )

  postShareCloseButton?.addEventListener('click', () => {
    modal.style.display = 'none';
  })

  copyPostButton?.addEventListener('click', () => {
    navigator.clipboard.writeText(shareLink.value).then()
  })

  /************************* */


  // Execute the function on page load
  updatePostVisibility();
  updateTopicalityPostClass();
  /**load more posts */
  togglePaginationVisibility();

  // Execute the function on window resize
  window.addEventListener('resize', () => {
    updatePostVisibility();
    updateTopicalityPostClass();
    // togglePaginationVisibility(); // temporaly disabled
  });



});

/*********CAROUSEL SCRIPTS ***************************/
let currentIndex = 0;
const cards = document.querySelectorAll('.focostv-research-carousel-card');
const totalCards = cards.length;

document.querySelector('.focostv-research-carousel-next')?.addEventListener('click', nextSlide);
document.querySelector('.focostv-research-carousel-prev')?.addEventListener('click', prevSlide);

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
  if (carousel) {
    carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
  }
  const dots = document.querySelectorAll('.focostv-research-carousel-dot');
  dots.forEach((dot, index) => {
    dot.classList.toggle('focostv-research-carousel-dot-active', index === currentIndex);
  });
}

// CAROUSEL SCRIPTS Swipe functionality
const carousel = document.querySelector('.focostv-research-carousel');

carousel?.addEventListener('touchstart', (event) => {
  startX = event.touches[0].clientX;
});

carousel?.addEventListener('touchmove', (event) => {
  endX = event.touches[0].clientX;
});

carousel?.addEventListener('touchend', () => {
  if (startX > endX + 50) { // Swipe left
    nextSlide();
  } else if (startX < endX - 50) { // Swipe right
    prevSlide();
  }
});

updateCarousel();

