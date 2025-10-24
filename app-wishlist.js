/* app-filter.js - loads data/<category>.json, renders cards, supports search */
const categories = {
  destinations: 'data/destinations.json',
  hotels: 'data/hotels.json',
  resorts: 'data/resorts.json'
};

function renderCardsList(items, containerSelector = '#cardContainer') {
  const $c = $(containerSelector);
  $c.empty();
  items.forEach(it => {
    const $card = $(`
      <div class="card" data-id="${it.id}" data-name="${it.name}" data-img="${it.img}" data-page="${it.page||'Unknown'}">
        <img src="${it.img}" alt="${it.name}">
        <h3>${it.name}</h3>
        <p>${it.description||''}</p>
        <button class="wishlist-btn">♡ Add to Wishlist</button>
      </div>
    `);
    $c.append($card);
  });
}

function loadCategory(category, opts = {}) {
  const file = categories[category];
  if (!file) return;
  $.getJSON(file)
    .done(data => {
      // attach page field so wishlist shows category
      const normalized = data.map(d => ({ ...d, page: category.charAt(0).toUpperCase() + category.slice(1) }));
      renderCardsList(normalized);
    })
    .fail(() => {
      renderCardsList([]);
    });
}

/* simple search function: pass a selector that contains the rendered cards */
function searchCards(term, containerSelector = '#cardContainer') {
  const t = (term||'').trim().toLowerCase();
  $(containerSelector).children('.card').each(function() {
    const $this = $(this);
    const name = ($this.data('name') || '').toString().toLowerCase();
    const desc = ($this.find('p').text() || '').toLowerCase();
    const match = !t || name.includes(t) || desc.includes(t);
    $this.toggle(match);
  });
}

$(document).ready(function() {
  // initial load using your existing select or default
  const initialCategory = $('#categorySelect').val() || 'destinations';
  loadCategory(initialCategory);

  $('#categorySelect').on('change', function() {
    loadCategory(this.value);
  });

  // wire a search input if present
  $(document).on('input', '#searchInput', function() {
    searchCards(this.value);
  });

  // ensure wishlist is loaded (wishlist.js handles it)
});
