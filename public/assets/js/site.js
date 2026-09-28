(() => {
  const root = document.documentElement;
  document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
    button.addEventListener('click', () => {
      const dark = !root.classList.contains('dark');
      root.classList.toggle('dark', dark);
      localStorage.setItem('karedit-theme', dark ? 'dark' : 'light');
    });
  });

  const menuButton = document.querySelector('[data-menu-button]');
  const menu = document.getElementById('mobile-menu');
  if (menuButton && menu) {
    menuButton.addEventListener('click', () => {
      const open = menu.classList.toggle('hidden') === false;
      menuButton.setAttribute('aria-expanded', String(open));
    });
  }

  document.querySelectorAll('pre').forEach((pre) => {
    const button = document.createElement('button');
    button.type = 'button';
    button.className = 'copy-code';
    button.textContent = 'Copiar';
    button.addEventListener('click', async () => {
      await navigator.clipboard.writeText(pre.innerText);
      button.textContent = 'Copiado';
      window.setTimeout(() => { button.textContent = 'Copiar'; }, 1800);
    });
    pre.appendChild(button);
  });

  const search = document.getElementById('blog-search');
  const cards = [...document.querySelectorAll('[data-post-card]')];
  const noResults = document.querySelector('[data-no-results]');
  let category = '';
  let tag = '';
  const normalize = (value) => value.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
  const applyFilters = () => {
    const query = normalize(search?.value || '');
    let visible = 0;
    cards.forEach((card) => {
      const haystack = normalize([card.dataset.title, card.dataset.summary, card.dataset.category, card.dataset.tags].join(' '));
      const matchesText = !query || haystack.includes(query);
      const matchesCategory = !category || normalize(card.dataset.category || '') === normalize(category);
      const matchesTag = !tag || normalize(card.dataset.tags || '').split(' ').includes(normalize(tag));
      const show = matchesText && matchesCategory && matchesTag;
      card.classList.toggle('hidden', !show);
      if (show) visible += 1;
    });
    noResults?.classList.toggle('hidden', visible !== 0);
  };
  search?.addEventListener('input', applyFilters);
  document.querySelectorAll('[data-category-filter]').forEach((button) => {
    button.addEventListener('click', () => {
      category = category === button.dataset.categoryFilter ? '' : button.dataset.categoryFilter;
      document.querySelectorAll('[data-category-filter]').forEach((item) => item.classList.toggle('active', item.dataset.categoryFilter === category));
      applyFilters();
    });
  });
  document.querySelectorAll('[data-tag-filter]').forEach((button) => {
    button.addEventListener('click', () => { tag = button.dataset.tagFilter || ''; applyFilters(); });
  });
  document.querySelector('[data-clear-filters]')?.addEventListener('click', () => {
    category = '';
    tag = '';
    if (search) search.value = '';
    document.querySelectorAll('[data-category-filter]').forEach((item) => item.classList.remove('active'));
    applyFilters();
  });

  document.querySelectorAll('[data-copy-link]').forEach((button) => {
    button.addEventListener('click', async () => {
      await navigator.clipboard.writeText(button.dataset.copyLink || window.location.href);
      const original = button.textContent;
      button.textContent = 'Enlace copiado';
      window.setTimeout(() => { button.textContent = original; }, 1800);
    });
  });

  const lightbox = document.querySelector('[data-lightbox]');
  const lightboxImg = lightbox?.querySelector('img');
  const closeLightbox = () => lightbox?.classList.add('hidden');
  document.querySelectorAll('[data-lightbox-image]').forEach((img) => {
    img.addEventListener('click', () => {
      if (!lightbox || !lightboxImg) return;
      lightboxImg.src = img.src;
      lightboxImg.alt = img.alt;
      lightbox.classList.remove('hidden');
      lightbox.classList.add('flex');
    });
  });
  lightbox?.addEventListener('click', (event) => { if (event.target === lightbox) closeLightbox(); });
  document.querySelector('[data-lightbox-close]')?.addEventListener('click', closeLightbox);
  document.addEventListener('keydown', (event) => { if (event.key === 'Escape') closeLightbox(); });
})();
