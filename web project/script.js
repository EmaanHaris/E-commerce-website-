/*swiper-home*/
var homeSwipper = new Swiper( ".home-swiper",
  {
    spaceBetween: 30,
    loop: 'true',
    pagination:
    {
      el: ".swiper-pagination",
      clickable: true,
    },
  } );
  /*new arrival swiper*/
  var newSwipper = new Swiper( ".new-swiper",
  {
    spaceBetween: 16,
    centererdSlides: true,
    slidesPerView: "auto",
    loop: 'true',
  
  } );
  /*header*/
  function header()
  {
    const header = document.getElementById( 'header' )
    if ( this.scrollY >= 50 ) header.classList.add( 'scroll-header' );
    else header.classList.remove( 'scroll-header' );
  }
  window.addEventListener( 'scroll', header );
  /*cart*/
  const cart = document.getElementById( 'cart' ),
    cartshop = document.getElementById( 'cartShop' ),
    cartclose = document.getElementById( 'cartClose' );
  if ( cartshop )
  {
    cartshop.addEventListener( 'click', () =>
    {
      cart.classList.add( 'showCart' )
    } )
  }
  if ( cartclose )
  {
    cartclose.addEventListener( 'click', () =>
    {
      cart.classList.remove( 'showCart' )
    } )
  }
  
  /*login*/
  const logIn = document.getElementById( 'login' ),
    logInBtn = document.getElementById( 'loginToggle' ),
    loginClose = document.getElementById( 'closeLogin' );
  if ( logInBtn )
  {
    logInBtn.addEventListener( 'click', () =>
    {
      logIn.classList.add( 'showLogin' )
    } )
  }
  if ( loginClose )
  {
    loginClose.addEventListener( 'click', () =>
    {
      logIn.classList.remove( 'showLogin' )
    } )
  }
  /*scrollup*/
  function scroll()
  {
    const scrollup = document.getElementById( 'scrollup' );
    if ( this.scrollY >= 350 )
    {
      scrollup.classList.add( 'show-scroll' )
    }
    else
    {
      scrollup.classList.remove( 'show-scroll' )
    }
  }
  window.addEventListener( 'scroll', scroll );
  /*show menu*/
  const menu = document.getElementById( 'nav_menu' ),
    toggle = document.getElementById( 'navToggle' ),
    navClose = document.getElementById( 'nav-close' );
  if ( toggle )
  {
    toggle.addEventListener( 'click', () =>
    {
      menu.classList.add( 'show-menu' )
    } )
  }
  if ( navClose )
  {
    navClose.addEventListener( 'click', () =>
    {
      menu.classList.remove( 'show-menu' )
    } )
  }
  /*FAQ*/
  const accordionItem = document.querySelectorAll( '.questions__items' )
  
  accordionItem.forEach( ( item ) =>
  {
    const accordionHeader = item.querySelector( '.questions__header' )
  
    accordionHeader.addEventListener( 'click', () =>
    {
      const openItem = document.querySelector( '.accordion-open' )
  
      toggleItem( item )
  
      if ( openItem && openItem !== item )
      {
        toggleItem( openItem )
      }
    } )
  } )
  
  const toggleItem = ( item ) =>
  {
    const accordionContent = item.querySelector( '.questions__content' )
    if ( item.classList.contains( 'accordion-open' ) )
    {
      accordionContent.removeAttribute( 'style' )
      item.classList.remove( 'accordion-open' )
    }
    else
    {
      accordionContent.style.height = accordionContent.scrollHeight + 'px'
      item.classList.add( 'accordion-open' )
    }
  
  }
  /*validate registeration form*/
  function validateForm()
  {
    const name = document.getElementById( 'name' ).value;
    const email = document.getElementById( 'email' ).value;
    const password = document.getElementById( 'password' ).value;
    const contact = document.getElementById( 'contact' ).value;
    const address = document.getElementById( 'address' ).value;
    const country = document.getElementById( 'country' ).value;
  
    if ( name == "" )
    {
      alert( 'name is required!' );
      return false;
    }
  
  }