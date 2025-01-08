// sw.js

const CACHE_NAME = "v1";
const CACHE_ASSETS = [
  // Cache all files by using a wildcard approach in the fetch event
];

// Install event
self.addEventListener("install", (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      console.log("Caching files");
      // No specific files to cache at install, as we will cache on fetch
    })
  );
});

// Fetch event
self.addEventListener("fetch", (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      // Check if the response is in the cache
      if (response) {
        return response; // Return the cached response
      }
      return fetch(event.request).then((networkResponse) => {
        return caches.open(CACHE_NAME).then((cache) => {
          // Cache the new response
          cache.put(event.request, networkResponse.clone());
          return networkResponse; // Return the network response
        });
      });
    })
  );
});

// Activate event
self.addEventListener("activate", (event) => {
  const cacheWhitelist = [CACHE_NAME];
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (cacheWhitelist.indexOf(cacheName) === -1) {
            return caches.delete(cacheName); // Delete old caches
          }
        })
      );
    })
  );
});
