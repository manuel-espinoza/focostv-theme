<?php
?>

<div class="focostv-multimedia-post-container">
    <button type="button" id="focostv-post-audio-btn" class="focostv-multimedia-post-button">
        <div class="multimedia-icon-container">
            <!-- https://feathericons.dev/?search=headphones&iconset=feather -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="2">
                <path d="M3 18v-6a9 9 0 0 1 18 0v6" />
                <path
                    d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z" />
            </svg>
        </div>
        Escuchar
    </button>

    <button type="button" id="focostv-post-video-btn" class="focostv-multimedia-post-button">
        <div class="multimedia-icon-container">
            <!-- https://feathericons.dev/?search=play-circle&iconset=feather -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="2">
                <circle cx="12" cy="12" r="10" />
                <polygon points="10 8 16 12 10 16 10 8" />
            </svg>

        </div>
        Video
    </button>
    <button type="button" id="focostv-post-summary-btn" class="focostv-multimedia-post-button">
        <div class="multimedia-icon-container">
            <!-- https://feathericons.dev/?search=star&iconset=feather -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="2">
                <polygon
                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
            </svg>

        </div>
        Resumen
    </button>

    <button type="button" id="focostv-post-shared-btn" class="focostv-multimedia-post-button">
        <div class="multimedia-icon-container">
            <!-- https://feathericons.dev/?search=share&iconset=feather -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="2">
                <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                <polyline points="16 6 12 2 8 6" />
                <line x1="12" x2="12" y1="2" y2="15" />
            </svg>

        </div>
        Compartir
    </button>
</div>

<div id="focostv-social-media-share-modal" class="focostv-share-modal">
    <div class="focostv-share-modal-content">
        <span class="focostv-share-modal-close"><!-- https://feathericons.dev/?search=xcircle&iconset=feather -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                class="main-grid-item-icon" fill="none" stroke="currentColor" stroke-linecap="round"
                stroke-linejoin="round" stroke-width="2">
                <circle cx="12" cy="12" r="10" />
                <line x1="15" x2="9" y1="9" y2="15" />
                <line x1="9" x2="15" y1="9" y2="15" />
            </svg>
        </span>
        <h3 class="focostv-share-modal-title">Compartir</h3>
        <div class="focostv-share-options">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
                target="_blank" class="focostv-share-option" id="share-facebook">
                <div class="focostv-share-option-icon">
                    <i class="fa-brands fa-square-facebook"></i>
                </div>
                Facebook
            </a>
            <a href="https://www.instagram.com/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank"
                class="focostv-share-option" id="share-instagram">
                <div class="focostv-share-option-icon">
                    <i class="fa-brands fa-instagram"></i>
                </div>
                Instagram
            </a>
            <a href="https://www.tiktok.com/share?url=<?php echo urlencode(get_permalink()); ?>" target="_blank"
                class="focostv-share-option" id="share-tiktok">
                <div class="focostv-share-option-icon">
                    <i class="fa-brands fa-tiktok"></i>
                </div>
                TikTok
            </a>
            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>" target="_blank"
                class="focostv-share-option" id="share-twitter">
                <div class="focostv-share-option-icon">
                    <i class="fa-brands fa-x-twitter"></i>
                </div>
                Twitter
            </a>
        </div>
        <h4 class="focostv-share-modal-title">As a message</h4>
        <div class="focostv-share-options">
            <a href="fb-messenger://share?link=<?php echo urlencode(get_permalink()); ?>" target="_blank"
                class="focostv-share-option" id="share-messenger">
                <div class="focostv-share-option-icon">
                    <i class="fa-brands fa-facebook-messenger"></i>
                </div>
                Messenger
            </a>
            <a href="https://api.whatsapp.com/send?text=<?php echo urlencode(get_permalink()); ?>" target="_blank"
                class="focostv-share-option" id="share-whatsapp">
                <div class="focostv-share-option-icon">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                WhatsApp
            </a>
            <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink()); ?>" target="_blank"
                class="focostv-share-option" id="share-telegram">
                <div class="focostv-share-option-icon">
                    <i class="fa-brands fa-telegram"></i>
                </div>Telegram
            </a>
            <a href="https://web.wechat.com/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank"
                class="focostv-share-option" id="share-wechat">
                <div class="focostv-share-option-icon">
                    <i class="fa-brands fa-weixin"></i>
                </div>
                WeChat
            </a>
        </div>
        <h4 class="focostv-share-modal-title">Or copy link</h4>

        <div class="focostv-copy-link-container">
            <input type="text" id="share-link" value="<?php the_permalink(); ?>" readonly>
            <button id="copy-link-btn">Copiar</button>
        </div>
    </div>
</div>