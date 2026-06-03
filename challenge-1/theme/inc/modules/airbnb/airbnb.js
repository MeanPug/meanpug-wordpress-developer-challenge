/**
 * Airbnb clone interactions
 * - Category tab switching
 * - Wishlist heart toggle
 */

( function () {
  'use strict';

  // Category tabs
  function initCategoryTabs() {
    var tabs = document.querySelectorAll( '.airbnb-category-tabs__tab' );
    if ( ! tabs.length ) return;

    tabs.forEach( function ( tab ) {
      tab.addEventListener( 'click', function () {
        tabs.forEach( function ( t ) {
          t.classList.remove( 'airbnb-category-tabs__tab--active' );
          t.setAttribute( 'aria-selected', 'false' );
        } );

        tab.classList.add( 'airbnb-category-tabs__tab--active' );
        tab.setAttribute( 'aria-selected', 'true' );

        // Scroll tab into view on mobile
        tab.scrollIntoView( { behavior: 'smooth', block: 'nearest', inline: 'center' } );
      } );
    } );
  }

  // Wishlist toggle
  function initWishlistButtons() {
    var buttons = document.querySelectorAll( '.airbnb-card__wishlist' );
    if ( ! buttons.length ) return;

    buttons.forEach( function ( btn ) {
      btn.addEventListener( 'click', function () {
        var pressed = btn.getAttribute( 'aria-pressed' ) === 'true';
        btn.setAttribute( 'aria-pressed', String( ! pressed ) );
      } );
    } );
  }

  // Search pill — highlight segment on click
  function initSearchPill() {
    var segments = document.querySelectorAll( '.airbnb-search-pill__segment' );
    if ( ! segments.length ) return;

    segments.forEach( function ( seg ) {
      seg.addEventListener( 'click', function () {
        segments.forEach( function ( s ) {
          s.classList.remove( 'airbnb-search-pill__segment--focused' );
        } );
        seg.classList.add( 'airbnb-search-pill__segment--focused' );
      } );
    } );

    document.addEventListener( 'click', function ( e ) {
      if ( ! e.target.closest( '.airbnb-search-pill' ) ) {
        segments.forEach( function ( s ) {
          s.classList.remove( 'airbnb-search-pill__segment--focused' );
        } );
      }
    } );
  }

  if ( document.readyState === 'loading' ) {
    document.addEventListener( 'DOMContentLoaded', function () {
      initCategoryTabs();
      initWishlistButtons();
      initSearchPill();
    } );
  } else {
    initCategoryTabs();
    initWishlistButtons();
    initSearchPill();
  }

} )();