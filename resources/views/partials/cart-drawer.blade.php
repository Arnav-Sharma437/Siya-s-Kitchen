<!-- =========================================================================
     CART DRAWER & ORDERING MODALS (SIYA'S KITCHEN)
     ========================================================================= -->

<!-- Cart Backdrop Overlay -->
<div class="cart-backdrop" id="cartBackdrop" aria-hidden="true"></div>

<!-- Slide-Out Cart Drawer -->
<aside class="cart-drawer" id="cartDrawer" role="dialog" aria-labelledby="cartDrawerTitle" aria-modal="true" aria-hidden="true">
    <div class="cart-drawer-header">
        <div class="cart-header-title-box">
            <h2 id="cartDrawerTitle" class="cart-title">Your Order</h2>
            <span class="cart-items-tag"><span class="global-cart-count">0</span> items</span>
        </div>
        <button type="button" class="cart-close-btn" id="closeCartBtn" aria-label="Close cart">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
    </div>

    <!-- Order Mode Selector (Dine In / Takeaway) -->
    <div class="cart-order-type-selector">
        <button type="button" class="order-type-btn active" data-type="dine_in">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/>
                <path d="M7 2v20"/>
                <path d="M21 15V2v0a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/>
            </svg>
            <span>Dine In</span>
        </button>
        <button type="button" class="order-type-btn" data-type="takeaway">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                <path d="M3 6h18"/>
                <path d="M16 10a4 4 0 0 1-8 0"/>
            </svg>
            <span>Takeaway</span>
        </button>
    </div>

    <!-- Table Number Input (Dine-in Only) -->
    <div class="cart-table-group" id="cartTableGroup">
        <label for="cartTableInput" class="cart-field-label">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect width="18" height="18" x="3" y="3" rx="2"/>
                <path d="M3 9h18M9 21V9"/>
            </svg>
            Table Number:
        </label>
        <div class="cart-table-input-wrap">
            <input type="text" id="cartTableInput" class="cart-input" placeholder="e.g. 12 (or from QR)" value="{{ request()->query('table', '') }}">
            <span class="table-verified-badge" id="tableVerifiedBadge" style="display: none;">QR Verified</span>
        </div>
    </div>

    <!-- Scrollable Items List -->
    <div class="cart-items-container" id="cartItemsList">
        <!-- Injected via JavaScript -->
        <div class="empty-cart-state" id="emptyCartState">
            <div class="empty-cart-icon">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/>
                    <path d="M3 6h18"/>
                    <path d="M16 10a4 4 0 0 1-8 0"/>
                </svg>
            </div>
            <p class="empty-cart-text">Your basket is currently empty</p>
            <p class="empty-cart-sub">Explore our authentic digital menu and add delicious dishes to begin.</p>
            <a href="{{ route('menu') }}" class="btn btn-secondary btn-sm" style="margin-top: 1rem;">Browse Menu</a>
        </div>
    </div>

    <!-- Cart Footer & Summary -->
    <div class="cart-drawer-footer" id="cartDrawerFooter" style="display: none;">
        <!-- Kitchen Special Note -->
        <div class="cart-notes-group">
            <label for="cartOrderNotes" class="cart-field-label">Special instructions for kitchen:</label>
            <textarea id="cartOrderNotes" class="cart-textarea" rows="2" placeholder="e.g. Mild spice, allergy notes, extra napkins..."></textarea>
        </div>

        <div class="cart-summary-box">
            <div class="summary-row">
                <span>Subtotal</span>
                <span class="summary-val" id="cartSubtotal">£0.00</span>
            </div>
            <div class="summary-row text-muted" style="font-size: 0.88rem;">
                <span>VAT (Included)</span>
                <span class="summary-val" id="cartVat">£0.00</span>
            </div>
            <div class="summary-divider"></div>
            <div class="summary-row total-row">
                <span>Total Amount</span>
                <span class="total-val" id="cartTotal">£0.00</span>
            </div>
        </div>

        <button type="button" class="btn btn-primary btn-block checkout-action-btn" id="proceedCheckoutBtn">
            <span>Confirm Order</span>
            <span class="checkout-total-tag" id="checkoutBtnTotal">£0.00</span>
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
        </button>

        <button type="button" class="btn-clear-cart" id="clearCartBtn">Clear Entire Basket</button>
    </div>
</aside>

<!-- =========================================================================
     MOBILE FLOATING BOTTOM CART BAR (Sticky on Mobile Viewports)
     ========================================================================= -->
<div class="mobile-sticky-cart-bar" id="mobileStickyCartBar" style="display: none;">
    <div class="mobile-cart-info">
        <span class="mobile-cart-badge"><span class="global-cart-count">0</span> items</span>
        <span class="mobile-cart-total" id="mobileBarTotal">£0.00</span>
    </div>
    <button type="button" class="mobile-cart-view-btn" id="mobileViewCartBtn">
        <span>View Basket</span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14M12 5l7 7-7 7"/>
        </svg>
    </button>
</div>

<!-- =========================================================================
     ITEM DETAIL & CUSTOMIZATION MODAL (Pop-up on Food Card Click)
     ========================================================================= -->
<div class="item-modal-backdrop" id="itemModalBackdrop" aria-hidden="true"></div>

<div class="item-modal-dialog" id="itemModalDialog" role="dialog" aria-labelledby="itemModalTitle" aria-modal="true" aria-hidden="true">
    <button type="button" class="item-modal-close" id="closeItemModalBtn" aria-label="Close details">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </button>

    <div class="item-modal-content">
        <!-- Item Hero Header -->
        <div class="item-modal-header-img" id="itemModalImgBox">
            <img src="{{ asset('images/dishes/dish-kadai.jpg') }}" alt="Dish Photo" id="itemModalImg">
            <div class="item-modal-gradient"></div>
        </div>

        <div class="item-modal-body">
            <div class="item-modal-category-tag" id="itemModalCategory">Category</div>
            <h3 class="item-modal-title" id="itemModalTitle">Dish Name</h3>
            
            <div class="item-modal-badges" id="itemModalBadges">
                <!-- Badges injected dynamically -->
            </div>

            <p class="item-modal-desc" id="itemModalDesc">Dish description goes here...</p>

            <div class="item-modal-base-price-tag">
                Base Price: <span id="itemModalBasePrice">£0.00</span>
            </div>

            <!-- Variations / Portions (Radio Group) -->
            <div class="modal-section-options" id="itemModalVariationsSection" style="display: none;">
                <h4 class="options-group-title">Select Portion / Variation:</h4>
                <div class="variations-radio-list" id="itemModalVariationsList">
                    <!-- Injected dynamically -->
                </div>
            </div>

            <!-- Add-ons / Extras (Checkbox Group) -->
            <div class="modal-section-options" id="itemModalAddonsSection" style="display: none;">
                <h4 class="options-group-title">Choice of Extras / Add-ons:</h4>
                <div class="addons-checkbox-list" id="itemModalAddonsList">
                    <!-- Injected dynamically -->
                </div>
            </div>

            <!-- Special Cooking Instructions -->
            <div class="modal-section-options">
                <label for="itemModalInstructions" class="options-group-title">Special Instructions (Optional):</label>
                <input type="text" id="itemModalInstructions" class="cart-input" placeholder="e.g. Mild spice, less oil, no onion...">
            </div>

            <!-- Quantity Stepper & Add Action -->
            <div class="item-modal-action-bar">
                <div class="quantity-stepper">
                    <button type="button" class="qty-btn" id="modalQtyMinus" aria-label="Decrease quantity">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    </button>
                    <span class="qty-display" id="modalQtyDisplay">1</span>
                    <button type="button" class="qty-btn" id="modalQtyPlus" aria-label="Increase quantity">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    </button>
                </div>

                <button type="button" class="btn btn-primary modal-add-cart-btn" id="modalAddToCartBtn">
                    <span>Add to Order</span>
                    <span class="modal-btn-price" id="modalCalculatedTotal">£0.00</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- =========================================================================
     TOAST NOTIFICATION COMPONENT
     ========================================================================= -->
<div class="toast-notification-container" id="toastContainer" aria-live="polite"></div>
