document.addEventListener("DOMContentLoaded", function() {
    var videos = document.querySelectorAll("video");

    function checkVideo() {
      videos.forEach(function(video) {
        var rect = video.getBoundingClientRect();
        var viewportHeight = window.innerHeight || document.documentElement.clientHeight;

        // Check if the video is in the viewport
        if (rect.top >= 0 && rect.bottom <= viewportHeight) {
          if (video.paused) {
            video.play();
          }
          video.loop = true;
        } else {
          video.pause();
        }
      });
    }

    // Initial check when the page loads
    checkVideo();

    // Check again on scroll or resize
    window.addEventListener("scroll", checkVideo);
    window.addEventListener("resize", checkVideo);
  });