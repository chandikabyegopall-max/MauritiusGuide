/* wishlist.js - shared across pages (include after jQuery)
   Uses localStorage key 'mg_wishlist'. Works with existing static cards and AJAX-rendered cards.
*/

(function(window, $) {
  const STORAGE_KEY = 'mg_wishlist';

  function _read() {
    try { return JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]'); } catch (e) { return []; }
  }

  function _write(list) { localStorage.setItem(STORAGE_KEY, JSON.stringify(list)); }

  function toggleWishlist() {
    $('#wishlistSidebar').toggleClass('hidden');
    const hidden = $('#wishlistSidebar').hasClass('hidden');
    $('#wishlistSidebar').attr('aria-hidden', hidden ? 'true' : 'false');
  }

  function loadWishlist() {
    const list = _read();
    const $container = $('#wishlistItems');
    $container.empty();

    if (!list.length) {
      $('#wishlistEmpty').show();
      return;
    }
    $('#wishlistEmpty').hide();

    list.forEach((item, idx) => {
      const $li = $(`
        <li>
          <img src="${escapeAttr(item.img)}" alt="${escapeAttr(item.name)}">
          <div class="wishlist-item-meta">
            <h4>${escapeHtml(item.name)}</h4>
            <p>${escapeHtml(item.page || '')}</p>
          </div>
          <button class="remove-btn" data-idx="${idx}">Remove</button>
        </li>
      `);
      $container.append($li);
    });
  }

  function addToWishlistFromCard(cardEl) {
    const el = cardEl instanceof jQuery ? cardEl[0] : cardEl;
    const id = el.dataset.id || (el.querySelector('h3')?.textContent || '').trim();
    const name = el.dataset.name || el.querySelector('h3')?.textContent || 'Untitled';
    const img = el.dataset.img || (el.querySelector('img')?.src || '');
    const page = el.dataset.page || document.title || window.location.pathname.split('/').pop() || 'Unknown';

    if (!id) return;

    const list = _read();
    const exists = list.some(i => i.id === id && i.page === page);
    if (exists) return;

    list.push({ id, name, img, page });
    _write(list);
    loadWishlist();
  }

  // delegated remove
  $(document).on('click', '.remove-btn', function() {
    const idx = parseInt($(this).attr('data-idx'), 10);
    const list = _read();
    if (!isNaN(idx) && list[idx]) {
      list.splice(idx, 1);
      _write(list);
      loadWishlist();
    }
  });

  // delegated add: binds to any .wishlist-btn on page (works for static or AJAX cards)
  $(document).on('click', '.wishlist-btn', function(e) {
    e.preventDefault();
    const $card = $(this).closest('.card');
    if ($card.length) addToWishlistFromCard($card);
  });

  // UI toggle buttons
  $(document).on('click', '#wishlistToggle', function() { toggleWishlist(); });
  $(document).on('click', '#closeWishlist', function() { toggleWishlist(); });

  // init on ready
  $(function() { loadWishlist(); });

  // helper escaping
  function escapeHtml(str) {
    return String(str || '').replace(/[&<>"']/g, s => ({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' })[s]);
  }
  function escapeAttr(s) { return escapeHtml(s); }

  // expose for manual usage
  window.mgWishlist = { load: loadWishlist, addFromCard: addToWishlistFromCard, toggle: toggleWishlist };
})(window, jQuery);



// Add this once on page load to append a button to any .card that doesn't have one
$(function() {
  $('.card').each(function() {
    if (!$(this).find('.wishlist-btn').length) {
      $(this).append('<button class="wishlist-btn">♡ Add to Wishlist</button>');
    }
  });
});
