/* app-filter.js
   Filters static .card elements on the page (search, tags, sort).
   Optional: merges in data from data/activities.json if present.
   Do not include wishlist logic here.
*/
(function(window, $) {
  const DATA_URL = 'data/activities.json'; // optional; keep or set to null
  const PAGE_NAME = 'Activities';
  let allItems = [];
  let activeTags = new Set();
  let searchTerm = '';
  let currentSort = 'default';
  const $cardsContainer = $('.cards').first();

  function debounce(fn, wait = 160) {
    let t;
    return function(...args) {
      clearTimeout(t);
      t = setTimeout(() => fn.apply(this, args), wait);
    };
  }

  // Build items from existing DOM .card elements
  function buildFromDom() {
    const items = [];
    $cardsContainer.children('.card').each(function() {
      const $c = $(this);
      const id = $c.data('id') || ($c.find('h3').text()||'').trim().replace(/\s+/g,'-').toLowerCase();
      const name = $c.data('name') || $c.find('h3').text() || 'Untitled';
      const img = $c.data('img') || $c.find('img').attr('src') || '';
      const desc = $c.find('p').text() || '';
      // tags may be in data-tags (comma separated) or .tag spans
      let tags = $c.data('tags') || [];
      if (!Array.isArray(tags) || !tags.length) {
        const tagEls = $c.find('.tag').map((i,el) => $(el).text().trim()).get();
        if (tagEls.length) tags = tagEls;
      }
      if (typeof tags === 'string') tags = tags.split(',').map(t => t.trim()).filter(Boolean);
      items.push({ id, name, img, description: desc, tags: Array.isArray(tags)?tags:[], page: PAGE_NAME });
    });
    return items;
  }

  // Render given items into the .cards container (replaces current content)
  function render(items) {
    $cardsContainer.empty();
    if (!items.length) {
      $cardsContainer.append('<p class="no-results">No activities found.</p>');
      return;
    }
    items.forEach(item => {
      const tagsHtml = (item.tags||[]).map(t => `<span class="tag">${escapeHtml(t)}</span>`).join(' ');
      const $card = $(`
        <div class="card" data-id="${escapeAttr(item.id)}" data-name="${escapeAttr(item.name)}" data-img="${escapeAttr(item.img)}" data-page="${escapeAttr(item.page)}">
          ${item.img ? `<img src="${escapeAttr(item.img)}" alt="${escapeAttr(item.name)}" />` : ''}
          <h3>${escapeHtml(item.name)}</h3>
          <p>${escapeHtml(item.description)}</p>
          <div class="card-tags">${tagsHtml}</div>
        </div>
      `);
      $cardsContainer.append($card);
    });
  }

  // Build tag filter UI from allItems
  function buildTagFilters() {
    const tagSet = new Set();
    allItems.forEach(i => (i.tags||[]).forEach(t => tagSet.add(t)));
    const tags = Array.from(tagSet).sort();
    const $tf = $('#tagFilters');
    $tf.empty();
    if (!tags.length) { $tf.attr('aria-hidden','true'); return; }
    $tf.attr('aria-hidden','false');
    tags.forEach(tag => {
      const id = `tag-${tag.replace(/\s+/g,'-').toLowerCase()}`;
      $tf.append(`<label for="${id}"><input type="checkbox" id="${id}" value="${escapeAttr(tag)}"> ${escapeHtml(tag)}</label>`);
    });
    // delegate to support rebuilds
    $tf.off('change','input[type="checkbox"]').on('change','input[type="checkbox"]', function() {
      if (this.checked) activeTags.add(this.value); else activeTags.delete(this.value);
      applyAndRender();
    });
  }

  // Apply search, tag filter, and sort to allItems
  function applyAllFilters() {
    const term = (searchTerm||'').trim().toLowerCase();
    let items = allItems.filter(item => {
      const matchesSearch = !term || (item.name && item.name.toLowerCase().includes(term)) || (item.description && item.description.toLowerCase().includes(term));
      const tags = Array.from(activeTags);
      const matchesTags = tags.length === 0 || (item.tags && tags.every(t => item.tags.includes(t)));
      return matchesSearch && matchesTags;
    });
    if (currentSort === 'alpha-asc') items.sort((a,b) => a.name.localeCompare(b.name));
    if (currentSort === 'alpha-desc') items.sort((a,b) => b.name.localeCompare(a.name));
    return items;
  }

  function applyAndRender() {
    render(applyAllFilters());
  }

  // Try to load optional JSON then fallback to DOM if not available
  function loadOptionalJson() {
    if (!DATA_URL) return $.Deferred().resolve().promise();
    return $.getJSON(DATA_URL)
      .done(function(data) {
        if (!Array.isArray(data)) data = [];
        allItems = data.map(item => ({
          id: item.id || (item.name||'').replace(/\s+/g,'-').toLowerCase(),
          name: item.name || 'Untitled',
          img: item.img || '',
          description: item.description || '',
          tags: Array.isArray(item.tags) ? item.tags : (item.tags ? [item.tags] : []),
          page: PAGE_NAME
        }));
        buildTagFilters();
        render(applyAllFilters());
      })
      .fail(function() {
        // If JSON fails, keep DOM-derived items (already set)
        buildTagFilters();
        render(applyAllFilters());
      });
  }

  // Init: ensure immediate responsiveness using DOM, then optionally replace with JSON
  $(function() {
    // Ensure minimal markup uniformity for existing cards
    $('.card').each(function() {
      const $c = $(this);
      if (!$c.data('id')) $c.attr('data-id', ($c.find('h3').text()||'').trim().replace(/\s+/g,'-').toLowerCase());
      if (!$c.data('name')) $c.attr('data-name', $c.find('h3').text()||'');
      if (!$c.data('img') && $c.find('img').length) $c.attr('data-img', $c.find('img').attr('src')||'');
    });

    // build allItems from DOM so filters work immediately
    allItems = buildFromDom();
    buildTagFilters();
    render(applyAllFilters());

    // wire controls
    $('#searchInput').off('input').on('input', debounce(function() {
      searchTerm = this.value;
      applyAndRender();
    }));

    $('#sortSelect').off('change').on('change', function() {
      currentSort = this.value;
      applyAndRender();
    });

    $('#clearFilters').off('click').on('click', function() {
      searchTerm = ''; activeTags.clear(); currentSort = 'default';
      $('#searchInput').val(''); $('#sortSelect').val('default'); $('#tagFilters').find('input[type="checkbox"]').prop('checked', false);
      applyAndRender();
    });

    // Try to load JSON and replace DOM when ready (optional)
    loadOptionalJson();
  });

  // helpers
  function escapeHtml(str) { return String(str || '').replace(/[&<>"']/g, s => ({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' })[s]); }
  function escapeAttr(s) { return escapeHtml(s); }

  // expose for debug
  window.mgFilter = { rebuildFromDom: () => { allItems = buildFromDom(); buildTagFilters(); applyAndRender(); }, getAll: () => allItems };
})(window, jQuery);

      
      
   









