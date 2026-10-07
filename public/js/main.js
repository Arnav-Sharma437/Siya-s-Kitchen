/**
 * Siya's Kitchen - Complete Client Application Script
 * Vanilla JavaScript (No heavy frameworks, QR-optimized & Ultra-fast)
 */

(() => {
    'use strict';

    // =========================================================================
    // 1. STATE & STORAGE MANAGEMENT
    // =========================================================================
    const CART_STORAGE_KEY = 'siyas_kitchen_cart_v1';
    const ORDER_SETTINGS_KEY = 'siyas_kitchen_order_settings_v1';

    let cart = [];
    let orderSettings = {
        orderType: 'dine_in', // 'dine_in' | 'takeaway'
        tableNumber: '',
        orderNotes: ''
    };

    // Load Cart from LocalStorage
    const loadCart = () => {
        try {
            const saved = localStorage.getItem(CART_STORAGE_KEY);
            cart = saved ? JSON.parse(saved) : [];
        } catch (e) {
            cart = [];
        }

        try {
            const savedSettings = localStorage.getItem(ORDER_SETTINGS_KEY);
            if (savedSettings) {
                orderSettings = Object.assign(orderSettings, JSON.parse(savedSettings));
            }
        } catch (e) {}

        // Check URL for table parameter
        const urlParams = new URLSearchParams(window.location.search);
        const urlTable = urlParams.get('table');
        if (urlTable) {
            orderSettings.tableNumber = urlTable;
            orderSettings.orderType = 'dine_in';
            saveOrderSettings();
        }
    };

    const saveCart = () => {
        try {
            localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cart));
        } catch (e) {}
        renderCartUI();
    };

    const saveOrderSettings = () => {
        try {
            localStorage.setItem(ORDER_SETTINGS_KEY, JSON.stringify(orderSettings));
        } catch (e) {}
    };

    const formatPounds = (pence) => {
        return '£' + (pence / 100).toFixed(2);
    };

    // =========================================================================
    // 2. TOAST NOTIFICATION HELPER
    // =========================================================================
    const showToast = (message, icon = '✓') => {
        let container = document.getElementById('toastContainer');
        if (!container) {
            container = document.createElement('div');
            container.id = 'toastContainer';
            container.className = 'toast-notification-container';
            document.body.appendChild(container);
        }

        const toast = document.createElement('div');
        toast.className = 'toast-message';
        toast.innerHTML = `<span style="color: var(--gold-accent); font-weight: 800;">${icon}</span> <span>${message}</span>`;
        container.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateY(10px)';
            toast.style.transition = 'all 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }, 3200);
    };

    // =========================================================================
    // 3. CART OPERATIONS
    // =========================================================================
    const addToCart = (itemData) => {
        // Generate unique key based on item ID, variation and selected addons
        const addonsKey = (itemData.addons || []).map(a => a.name).sort().join('|');
        const varKey = itemData.variation ? itemData.variation.name : 'default';
        const noteKey = (itemData.specialInstructions || '').trim().toLowerCase();
        const uniqueKey = `${itemData.menuItemId}_${varKey}_${addonsKey}_${noteKey}`;

        const existingIndex = cart.findIndex(c => c.cartKey === uniqueKey);

        const unitPrice = (itemData.variation ? itemData.variation.price : itemData.price) +
                          (itemData.addons || []).reduce((sum, a) => sum + a.price, 0);

        if (existingIndex > -1) {
            cart[existingIndex].quantity += itemData.quantity;
            cart[existingIndex].lineTotal = cart[existingIndex].quantity * unitPrice;
        } else {
            cart.push({
                cartKey: uniqueKey,
                menuItemId: itemData.menuItemId,
                name: itemData.name,
                image: itemData.image,
                basePrice: itemData.price,
                unitPrice: unitPrice,
                quantity: itemData.quantity,
                lineTotal: itemData.quantity * unitPrice,
                variation: itemData.variation || null,
                addons: itemData.addons || [],
                specialInstructions: itemData.specialInstructions || ''
            });
        }

        saveCart();
        showToast(`Added <strong>${itemData.name}</strong> to your order`);
    };

    const updateCartItemQuantity = (cartKey, delta) => {
        const index = cart.findIndex(c => c.cartKey === cartKey);
        if (index === -1) return;

        cart[index].quantity += delta;
        if (cart[index].quantity <= 0) {
            cart.splice(index, 1);
        } else {
            cart[index].lineTotal = cart[index].quantity * cart[index].unitPrice;
        }

        saveCart();
    };

    const removeCartItem = (cartKey) => {
        cart = cart.filter(c => c.cartKey !== cartKey);
        saveCart();
        showToast('Item removed from order');
    };

    const clearCart = () => {
        if (confirm('Are you sure you want to clear your order basket?')) {
            cart = [];
            saveCart();
            showToast('Basket cleared');
        }
    };

    // =========================================================================
    // 4. RENDER CART UI
    // =========================================================================
    const renderCartUI = () => {
        const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
        const subtotalPence = cart.reduce((sum, item) => sum + item.lineTotal, 0);
        const vatPence = Math.round(subtotalPence * 0.2); // 20% UK VAT included in price

        // 1. Update all global count badges
        document.querySelectorAll('.global-cart-count').forEach(el => {
            el.textContent = totalItems;
        });

        // 2. Update Mobile Floating Sticky Bar
        const mobileBar = document.getElementById('mobileStickyCartBar');
        const mobileTotal = document.getElementById('mobileBarTotal');
        if (mobileBar && mobileTotal) {
            if (totalItems > 0) {
                mobileBar.style.display = 'flex';
                mobileTotal.textContent = formatPounds(subtotalPence);
            } else {
                mobileBar.style.display = 'none';
            }
        }

        // 3. Update Cart Drawer Items List & Footer
        const itemsList = document.getElementById('cartItemsList');
        const emptyState = document.getElementById('emptyCartState');
        const drawerFooter = document.getElementById('cartDrawerFooter');
        const subtotalEl = document.getElementById('cartSubtotal');
        const vatEl = document.getElementById('cartVat');
        const totalEl = document.getElementById('cartTotal');
        const checkoutTotalTag = document.getElementById('checkoutBtnTotal');

        if (!itemsList) return;

        if (cart.length === 0) {
            if (emptyState) emptyState.style.display = 'flex';
            if (drawerFooter) drawerFooter.style.display = 'none';
            itemsList.querySelectorAll('.cart-item-row').forEach(r => r.remove());
        } else {
            if (emptyState) emptyState.style.display = 'none';
            if (drawerFooter) drawerFooter.style.display = 'block';

            // Rebuild items
            itemsList.querySelectorAll('.cart-item-row').forEach(r => r.remove());

            cart.forEach(item => {
                const row = document.createElement('div');
                row.className = 'cart-item-row';
                
                let addonsHtml = '';
                if (item.addons && item.addons.length > 0) {
                    addonsHtml = item.addons.map(a => `<span class="cart-item-addon-tag">+ ${a.name} (${formatPounds(a.price)})</span>`).join('');
                }

                let variationHtml = '';
                if (item.variation) {
                    variationHtml = `<span class="cart-item-variation-tag">Portion: ${item.variation.name}</span>`;
                }

                let noteHtml = '';
                if (item.specialInstructions) {
                    noteHtml = `<span class="cart-item-note">Note: "${item.specialInstructions}"</span>`;
                }

                row.innerHTML = `
                    <div class="cart-item-details">
                        <div class="cart-item-title">${item.name}</div>
                        ${variationHtml}
                        ${addonsHtml}
                        ${noteHtml}
                    </div>
                    <div class="cart-item-price-actions">
                        <div class="cart-item-line-total">${formatPounds(item.lineTotal)}</div>
                        <div class="cart-item-stepper">
                            <button type="button" class="cart-stepper-btn" data-action="minus" data-key="${item.cartKey}" aria-label="Decrease">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            </button>
                            <span class="cart-stepper-qty">${item.quantity}</span>
                            <button type="button" class="cart-stepper-btn" data-action="plus" data-key="${item.cartKey}" aria-label="Increase">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            </button>
                        </div>
                    </div>
                `;

                itemsList.appendChild(row);
            });

            if (subtotalEl) subtotalEl.textContent = formatPounds(subtotalPence);
            if (vatEl) vatEl.textContent = formatPounds(vatPence);
            if (totalEl) totalEl.textContent = formatPounds(subtotalPence);
            if (checkoutTotalTag) checkoutTotalTag.textContent = formatPounds(subtotalPence);
        }

        // Sync order settings inputs
        const tableInput = document.getElementById('cartTableInput');
        const tableVerified = document.getElementById('tableVerifiedBadge');
        if (tableInput) {
            tableInput.value = orderSettings.tableNumber || '';
            if (tableVerified) {
                tableVerified.style.display = orderSettings.tableNumber ? 'inline-block' : 'none';
            }
        }

        const tableGroup = document.getElementById('cartTableGroup');
        if (tableGroup) {
            tableGroup.style.display = orderSettings.orderType === 'dine_in' ? 'block' : 'none';
        }

        document.querySelectorAll('.order-type-btn').forEach(btn => {
            btn.classList.toggle('active', btn.getAttribute('data-type') === orderSettings.orderType);
        });

        document.querySelectorAll('.qr-mode-pill').forEach(btn => {
            btn.classList.toggle('active', btn.getAttribute('data-mode') === orderSettings.orderType);
        });
    };

    // =========================================================================
    // 5. ITEM CUSTOMIZATION MODAL ENGINE
    // =========================================================================
    let activeModalItem = null;
    let modalQuantity = 1;
    let selectedVariation = null;
    let selectedAddons = [];

    const calculateModalTotal = () => {
        if (!activeModalItem) return;
        const base = selectedVariation ? selectedVariation.price : activeModalItem.price;
        const addonsTotal = selectedAddons.reduce((sum, a) => sum + a.price, 0);
        const total = (base + addonsTotal) * modalQuantity;

        const totalEl = document.getElementById('modalCalculatedTotal');
        if (totalEl) totalEl.textContent = formatPounds(total);
    };

    const openItemModal = (dishCard) => {
        const rawVariations = dishCard.getAttribute('data-variations');
        const rawAddons = dishCard.getAttribute('data-addons');

        activeModalItem = {
            menuItemId: parseInt(dishCard.getAttribute('data-item-id'), 10),
            name: dishCard.getAttribute('data-name'),
            category: dishCard.getAttribute('data-category'),
            desc: dishCard.getAttribute('data-desc'),
            price: parseInt(dishCard.getAttribute('data-price'), 10),
            priceFormatted: dishCard.getAttribute('data-price-formatted'),
            image: dishCard.getAttribute('data-image'),
            isVeg: dishCard.getAttribute('data-is-veg') === 'true',
            isVegan: dishCard.getAttribute('data-is-vegan') === 'true',
            isSpicy: dishCard.getAttribute('data-is-spicy') === 'true',
            variations: rawVariations ? JSON.parse(rawVariations) : [],
            addons: rawAddons ? JSON.parse(rawAddons) : []
        };

        modalQuantity = 1;
        selectedVariation = activeModalItem.variations.length > 0 ? activeModalItem.variations[0] : null;
        selectedAddons = [];

        // Populate Modal Fields
        const img = document.getElementById('itemModalImg');
        if (img) img.src = activeModalItem.image;

        const categoryTag = document.getElementById('itemModalCategory');
        if (categoryTag) categoryTag.textContent = activeModalItem.category;

        const title = document.getElementById('itemModalTitle');
        if (title) title.textContent = activeModalItem.name;

        const desc = document.getElementById('itemModalDesc');
        if (desc) desc.textContent = activeModalItem.desc || 'Prepared freshly upon order with authentic heritage spices.';

        const basePrice = document.getElementById('itemModalBasePrice');
        if (basePrice) basePrice.textContent = activeModalItem.priceFormatted;

        const instructionsInput = document.getElementById('itemModalInstructions');
        if (instructionsInput) instructionsInput.value = '';

        // Badges
        const badgesContainer = document.getElementById('itemModalBadges');
        if (badgesContainer) {
            let badgesHtml = '';
            if (activeModalItem.isVeg) {
                badgesHtml += `<span class="diet-badge veg"><span class="badge-icon-dot green"></span> Veg</span>`;
            }
            if (activeModalItem.isVegan) {
                badgesHtml += `<span class="diet-badge vegan"><svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 20A7 7 0 0 1 4 13C4 7 11 3 11 3s7 4 7 10a7 7 0 0 1-7 7Z"/></svg> Vegan</span>`;
            }
            if (activeModalItem.isSpicy) {
                badgesHtml += `<span class="diet-badge spicy"><svg width="11" height="11" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8 6 6 10 6 14a6 6 0 0 0 12 0c0-4-2-8-6-12Z"/></svg> Spicy</span>`;
            }
            badgesContainer.innerHTML = badgesHtml;
        }

        // Variations Section
        const varSection = document.getElementById('itemModalVariationsSection');
        const varList = document.getElementById('itemModalVariationsList');
        if (varSection && varList) {
            if (activeModalItem.variations.length > 0) {
                varSection.style.display = 'block';
                varList.innerHTML = activeModalItem.variations.map((v, idx) => `
                    <label class="variation-radio-label ${idx === 0 ? 'checked' : ''}">
                        <div class="option-text-wrap">
                            <input type="radio" name="modal_variation" value="${idx}" ${idx === 0 ? 'checked' : ''} style="accent-color: var(--primary-terracotta);">
                            <span>${v.name}</span>
                        </div>
                        <span class="option-price">${formatPounds(v.price)}</span>
                    </label>
                `).join('');
            } else {
                varSection.style.display = 'none';
                varList.innerHTML = '';
            }
        }

        // Add-ons Section
        const addSection = document.getElementById('itemModalAddonsSection');
        const addList = document.getElementById('itemModalAddonsList');
        if (addSection && addList) {
            if (activeModalItem.addons.length > 0) {
                addSection.style.display = 'block';
                addList.innerHTML = activeModalItem.addons.map((a, idx) => `
                    <label class="addon-checkbox-label">
                        <div class="option-text-wrap">
                            <input type="checkbox" name="modal_addon" value="${idx}" style="accent-color: var(--primary-terracotta);">
                            <span>${a.name}</span>
                        </div>
                        <span class="option-price">+ ${formatPounds(a.price)}</span>
                    </label>
                `).join('');
            } else {
                addSection.style.display = 'none';
                addList.innerHTML = '';
            }
        }

        // Quantity Display
        const qtyDisplay = document.getElementById('modalQtyDisplay');
        if (qtyDisplay) qtyDisplay.textContent = '1';

        calculateModalTotal();

        // Open Dialog
        const backdrop = document.getElementById('itemModalBackdrop');
        const dialog = document.getElementById('itemModalDialog');
        if (backdrop) backdrop.classList.add('open');
        if (dialog) dialog.classList.add('open');
        document.body.style.overflow = 'hidden';
    };

    const closeItemModal = () => {
        const backdrop = document.getElementById('itemModalBackdrop');
        const dialog = document.getElementById('itemModalDialog');
        if (backdrop) backdrop.classList.remove('open');
        if (dialog) dialog.classList.remove('open');
        document.body.style.overflow = '';
        activeModalItem = null;
    };

    // =========================================================================
    // 6. CART DRAWER OPEN / CLOSE
    // =========================================================================
    const openCartDrawer = () => {
        const backdrop = document.getElementById('cartBackdrop');
        const drawer = document.getElementById('cartDrawer');
        if (backdrop) backdrop.classList.add('open');
        if (drawer) drawer.classList.add('open');
        document.body.style.overflow = 'hidden';
    };

    const closeCartDrawer = () => {
        const backdrop = document.getElementById('cartBackdrop');
        const drawer = document.getElementById('cartDrawer');
        if (backdrop) backdrop.classList.remove('open');
        if (drawer) drawer.classList.remove('open');
        document.body.style.overflow = '';
    };

    // =========================================================================
    // 7. INITIALIZATION & EVENT LISTENERS
    // =========================================================================
    document.addEventListener('DOMContentLoaded', () => {
        loadCart();
        renderCartUI();

        // --- 1. Sticky Header ---
        const siteHeader = document.querySelector('.site-header');
        const handleScroll = () => {
            if (!siteHeader) return;
            if (window.scrollY > 30) {
                siteHeader.classList.add('scrolled');
            } else {
                siteHeader.classList.remove('scrolled');
            }
        };
        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();

        // --- 2. Mobile Nav Toggle ---
        const mobileToggle = document.querySelector('.mobile-toggle');
        const mobileNav = document.querySelector('.mobile-nav');
        if (mobileToggle && mobileNav) {
            mobileToggle.addEventListener('click', () => {
                const isOpen = mobileNav.classList.toggle('open');
                mobileToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
        }

        // --- 3. Open Cart Trigger Buttons ---
        const headerCartBtn = document.getElementById('headerCartBtn');
        if (headerCartBtn) headerCartBtn.addEventListener('click', openCartDrawer);

        const mobileViewCartBtn = document.getElementById('mobileViewCartBtn');
        if (mobileViewCartBtn) mobileViewCartBtn.addEventListener('click', openCartDrawer);

        const closeCartBtn = document.getElementById('closeCartBtn');
        if (closeCartBtn) closeCartBtn.addEventListener('click', closeCartDrawer);

        const cartBackdrop = document.getElementById('cartBackdrop');
        if (cartBackdrop) cartBackdrop.addEventListener('click', closeCartDrawer);

        const clearCartBtn = document.getElementById('clearCartBtn');
        if (clearCartBtn) clearCartBtn.addEventListener('click', clearCart);

        // --- 4. Cart Order Type & Table Listeners ---
        document.querySelectorAll('.order-type-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                orderSettings.orderType = this.getAttribute('data-type');
                saveOrderSettings();
                renderCartUI();
            });
        });

        document.querySelectorAll('.qr-mode-pill').forEach(btn => {
            btn.addEventListener('click', function () {
                orderSettings.orderType = this.getAttribute('data-mode');
                saveOrderSettings();
                renderCartUI();
            });
        });

        const tableInput = document.getElementById('cartTableInput');
        if (tableInput) {
            tableInput.addEventListener('input', function () {
                orderSettings.tableNumber = this.value.trim();
                saveOrderSettings();
            });
        }

        const notesInput = document.getElementById('cartOrderNotes');
        if (notesInput) {
            notesInput.addEventListener('input', function () {
                orderSettings.orderNotes = this.value.trim();
                saveOrderSettings();
            });
        }

        // --- 5. Cart Item Stepper Delegation ---
        const cartItemsList = document.getElementById('cartItemsList');
        if (cartItemsList) {
            cartItemsList.addEventListener('click', (e) => {
                const btn = e.target.closest('.cart-stepper-btn');
                if (!btn) return;

                const action = btn.getAttribute('data-action');
                const key = btn.getAttribute('data-key');
                if (action === 'plus') {
                    updateCartItemQuantity(key, 1);
                } else if (action === 'minus') {
                    updateCartItemQuantity(key, -1);
                }
            });
        }

        // --- 6. Checkout CTA ---
        const proceedCheckoutBtn = document.getElementById('proceedCheckoutBtn');
        if (proceedCheckoutBtn) {
            proceedCheckoutBtn.addEventListener('click', () => {
                if (cart.length === 0) {
                    showToast('Your order basket is empty', 'ℹ');
                    return;
                }

                if (orderSettings.orderType === 'dine_in' && !orderSettings.tableNumber) {
                    alert('Please enter your Table Number to proceed with Dine-In ordering.');
                    const input = document.getElementById('cartTableInput');
                    if (input) input.focus();
                    return;
                }

                const summaryText = orderSettings.orderType === 'dine_in'
                    ? `Dine-In Order for Table #${orderSettings.tableNumber}`
                    : `Takeaway Order`;

                alert(`Order Confirmed!\n\n${summaryText}\nItems: ${cart.length}\nTotal: ${formatPounds(cart.reduce((sum, i) => sum + i.lineTotal, 0))}\n\nYour order has been recorded for kitchen preparation.`);
            });
        }

        // --- 7. Modal Open / Close / Actions ---
        document.querySelectorAll('.menu-item-card').forEach(card => {
            card.addEventListener('click', (e) => {
                // If clicked inside the card, open modal
                openItemModal(card);
            });
        });

        const closeItemModalBtn = document.getElementById('closeItemModalBtn');
        if (closeItemModalBtn) closeItemModalBtn.addEventListener('click', closeItemModal);

        const itemModalBackdrop = document.getElementById('itemModalBackdrop');
        if (itemModalBackdrop) itemModalBackdrop.addEventListener('click', closeItemModal);

        // Modal Quantity Stepper
        const modalMinus = document.getElementById('modalQtyMinus');
        const modalPlus = document.getElementById('modalQtyPlus');
        const modalQtyDisplay = document.getElementById('modalQtyDisplay');

        if (modalMinus && modalPlus && modalQtyDisplay) {
            modalMinus.addEventListener('click', () => {
                if (modalQuantity > 1) {
                    modalQuantity--;
                    modalQtyDisplay.textContent = modalQuantity;
                    calculateModalTotal();
                }
            });

            modalPlus.addEventListener('click', () => {
                modalQuantity++;
                modalQtyDisplay.textContent = modalQuantity;
                calculateModalTotal();
            });
        }

        // Modal Variation Radio Change
        const varList = document.getElementById('itemModalVariationsList');
        if (varList) {
            varList.addEventListener('change', (e) => {
                if (e.target.name === 'modal_variation' && activeModalItem) {
                    const idx = parseInt(e.target.value, 10);
                    selectedVariation = activeModalItem.variations[idx];

                    varList.querySelectorAll('.variation-radio-label').forEach((label, lIdx) => {
                        label.classList.toggle('checked', lIdx === idx);
                    });

                    calculateModalTotal();
                }
            });
        }

        // Modal Add-ons Checkbox Change
        const addList = document.getElementById('itemModalAddonsList');
        if (addList) {
            addList.addEventListener('change', (e) => {
                if (e.target.name === 'modal_addon' && activeModalItem) {
                    selectedAddons = [];
                    addList.querySelectorAll('input[name="modal_addon"]:checked').forEach(cb => {
                        const idx = parseInt(cb.value, 10);
                        selectedAddons.push(activeModalItem.addons[idx]);
                    });

                    addList.querySelectorAll('.addon-checkbox-label').forEach(label => {
                        const cb = label.querySelector('input');
                        label.classList.toggle('checked', cb.checked);
                    });

                    calculateModalTotal();
                }
            });
        }

        // Add To Cart Button inside Modal
        const modalAddToCartBtn = document.getElementById('modalAddToCartBtn');
        if (modalAddToCartBtn) {
            modalAddToCartBtn.addEventListener('click', () => {
                if (!activeModalItem) return;

                const instructions = (document.getElementById('itemModalInstructions')?.value || '').trim();

                addToCart({
                    menuItemId: activeModalItem.menuItemId,
                    name: activeModalItem.name,
                    image: activeModalItem.image,
                    price: activeModalItem.price,
                    quantity: modalQuantity,
                    variation: selectedVariation,
                    addons: selectedAddons,
                    specialInstructions: instructions
                });

                closeItemModal();
            });
        }

        // --- 8. Search & Filter Engine ---
        const searchInput = document.getElementById('menuSearchInput');
        const clearSearchBtn = document.getElementById('clearSearchBtn');
        const dietChips = document.querySelectorAll('.diet-chip');
        const resultsCountEl = document.getElementById('searchResultsCount');

        let currentSearchQuery = '';
        let currentDietFilter = 'all';

        const filterMenuDishes = () => {
            const cards = document.querySelectorAll('.menu-item-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const name = (card.getAttribute('data-name') || '').toLowerCase();
                const desc = (card.getAttribute('data-desc') || '').toLowerCase();
                const category = (card.getAttribute('data-category') || '').toLowerCase();
                const isVeg = card.getAttribute('data-is-veg') === 'true';
                const isVegan = card.getAttribute('data-is-vegan') === 'true';
                const isSpicy = card.getAttribute('data-is-spicy') === 'true';
                const isPopular = card.getAttribute('data-is-popular') === 'true';

                // Search Match
                const matchesSearch = !currentSearchQuery || 
                    name.includes(currentSearchQuery) || 
                    desc.includes(currentSearchQuery) || 
                    category.includes(currentSearchQuery);

                // Dietary Match
                let matchesDiet = true;
                if (currentDietFilter === 'veg') matchesDiet = isVeg;
                if (currentDietFilter === 'vegan') matchesDiet = isVegan;
                if (currentDietFilter === 'spicy') matchesDiet = isSpicy;
                if (currentDietFilter === 'popular') matchesDiet = isPopular;

                if (matchesSearch && matchesDiet) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Hide empty category sections
            document.querySelectorAll('.menu-category-section').forEach(section => {
                const visibleInCat = section.querySelectorAll('.menu-item-card[style="display: flex;"]').length;
                section.style.display = (visibleInCat > 0 || (!currentSearchQuery && currentDietFilter === 'all')) ? 'block' : 'none';
            });

            // Feedback Banner
            if (resultsCountEl) {
                if (currentSearchQuery || currentDietFilter !== 'all') {
                    resultsCountEl.style.display = 'block';
                    resultsCountEl.textContent = `Showing ${visibleCount} delicious dish${visibleCount === 1 ? '' : 'es'} matching your selection.`;
                } else {
                    resultsCountEl.style.display = 'none';
                }
            }
        };

        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                currentSearchQuery = e.target.value.trim().toLowerCase();
                if (clearSearchBtn) clearSearchBtn.style.display = currentSearchQuery ? 'block' : 'none';
                filterMenuDishes();
            });
        }

        if (clearSearchBtn) {
            clearSearchBtn.addEventListener('click', () => {
                if (searchInput) searchInput.value = '';
                currentSearchQuery = '';
                clearSearchBtn.style.display = 'none';
                filterMenuDishes();
            });
        }

        dietChips.forEach(chip => {
            chip.addEventListener('click', function () {
                dietChips.forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                currentDietFilter = this.getAttribute('data-filter');
                filterMenuDishes();
            });
        });

        // --- 9. Category Scroll-Spy & Smooth Navigation ---
        const categorySections = document.querySelectorAll('.menu-category-section');
        const categoryPills = document.querySelectorAll('.category-pill');
        const pillsScrollWrapper = document.getElementById('categoryPillsScroll');

        if (categorySections.length > 0 && categoryPills.length > 0) {
            const onScrollSpy = () => {
                const scrollPos = window.scrollY + 180;
                let activeSlug = null;

                categorySections.forEach(sec => {
                    if (sec.style.display !== 'none') {
                        const top = sec.offsetTop;
                        const height = sec.offsetHeight;
                        if (scrollPos >= top && scrollPos < top + height) {
                            activeSlug = sec.getAttribute('data-category-slug');
                        }
                    }
                });

                if (activeSlug) {
                    categoryPills.forEach(pill => {
                        const isMatch = pill.getAttribute('data-category-slug') === activeSlug;
                        pill.classList.toggle('active', isMatch);
                        if (isMatch && pillsScrollWrapper) {
                            // Keep active pill scrolled inside viewport
                            const left = pill.offsetLeft - pillsScrollWrapper.offsetLeft - 20;
                            pillsScrollWrapper.scrollTo({ left: left, behavior: 'smooth' });
                        }
                    });
                }
            };

            window.addEventListener('scroll', onScrollSpy, { passive: true });
        }

        // --- 10. Smooth Anchor Links ---
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const targetId = this.getAttribute('href');
                if (targetId && targetId !== '#' && targetId.startsWith('#')) {
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        e.preventDefault();
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });
    });
})();
