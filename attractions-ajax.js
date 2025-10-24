/* attractions-ajax.js
   Loads data/attractions.json via AJAX and appends cards into the first .cards container.
   Each card contains data-* attributes so wishlist.js can read metadata.
*/

$(function() {
  const dataSource = 'data/attractions.json';
  const pageName = 'Attractions';

  $.getJSON(dataSource)
    .done(function(data) {
      if (!Array.isArray(data) || !data.length) return;
      const $cards = $('.cards').first();
      data.forEach(function(item) {
        const id = item.id || (item.name || '').replace(/\s+/g, '-').toLowerCase();
        const img = item.img || '';
        const name = item.name || '';
        const desc = item.description || '';

        const $card = $(`
          <div class="card" data-id="${escapeAttr(id)}" data-name="${escapeAttr(name)}" data-img="${escapeAttr(img)}" data-page="${pageName}">
            <img src="${escapeAttr(img)}" alt="${escapeAttr(name)}" />
            <h3>${escapeHtml(name)}</h3>
            <p>${escapeHtml(desc)}</p>
            <button class="wishlist-btn">♡ Add to Wishlist</button>
          </div>
        `);

        $cards.append($card);
      });
    })
    .fail(function() {
      console.warn('Could not load attractions data from', dataSource);
    });

  // escape helpers
  function escapeHtml(str) {
    return String(str || '').replace(/[&<>"']/g, s => ({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' })[s]);
  }
  function escapeAttr(s) { return escapeHtml(s); }
});
















 

 












