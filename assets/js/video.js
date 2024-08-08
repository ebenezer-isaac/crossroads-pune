document.addEventListener("DOMContentLoaded", function() {
    // Select all videos inside the gallery div
    var videos = document.querySelectorAll("#gallery video");

    videos.forEach(function(video) {
        // Add a click event listener to each video
        video.addEventListener("click", function() {
            if (video.paused) {
                video.play();
                video.loop = true;
            } else {
                video.pause();
            }
        });
    });
});