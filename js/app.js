if('serviceWorker' in navigator){
  navigator.serviceWorker.register('https://aacmanchar.edu.in/flora/sw.js')
    .then(reg => console.log('service worker registered'))
    .catch(err => console.log('service worker not registered', err));
}