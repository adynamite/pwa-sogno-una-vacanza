
//remember to increment the version # when you update the service worker
const version = "1.00",
    preCache = "PRECACHE-" + version,
    cacheList = [ "/manifest.json",
				"/index.html",
				"/chisiamo.html",
				"/contatti.html", 
				"/destinazioni.html",
				"/css/style.css",
				"/css/bootstrap.min.css",
				"/offline.html",
				"/images/logo.png",
				"/images/background-main.jpg",
				"/images/pwa-logo-50x50.png",
				"/favicon.ico"];

/*
create a list (array) of urls to pre-cache for your application
*/

/*  Service Worker Event Handlers */

self.addEventListener( "install", function ( event ) {

    console.log( "Installing the service worker!" );

    self.skipWaiting();

    caches.open( preCache )
        .then( cache => {

            cache.addAll( cacheList );

        } );

} );

self.addEventListener( "activate", function ( event ) {

    event.waitUntil(

        //wholesale purge of previous version caches
        caches.keys().then( cacheNames => {
            cacheNames.forEach( value => {

                if ( value.indexOf( version ) < 0 ) {
                    caches.delete( value );
                }

            } );

            console.log( "service worker activated" );

            return;

        } )

    );

} );

self.addEventListener('fetch', event => {
  // request.mode = navigate isn't supported in all browsers
  // so include a check for Accept: text/html header.
  if (event.request.mode === 'navigate' || (event.request.method === 'GET' )) {
        event.respondWith(
          fetch(event.request.url).catch(error => {
              // Return the offline page
              return caches.match("offline.html");
          })
    );
  }
  else{
        // Respond with everything else if we can
        event.respondWith(caches.match(event.request)
                        .then(function (response) {
                        return response || fetch(event.request);
                    })
            );
      }
});




