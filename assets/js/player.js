document.addEventListener("DOMContentLoaded", function() {
    const waveformElement = document.getElementById("waveform");

    if (!waveformElement) {
        return;
    }

    const audioPlayer = document.getElementById("audio-player");
    const playPauseButton = document.getElementById("play-pause");
    const volumeIcon = document.getElementById("volume-icon");
    const volumeSlider = document.getElementById("volume-slider");
    const speedButton = document.getElementById("speed-toggle");
    const skipForwardButton = document.getElementById("skip-forward");
    const skipBackwardButton = document.getElementById("skip-backward");
    
    const wavesurfer = WaveSurfer.create({
        container: "#waveform",
        waveColor: "#ff427b5c",
        progressColor: "#ff427b",
        cursorColor: "#ff427b",
        height: 60,
        interact: true,
        responsive: true,
        normalize: true,
    });
    
    volumeIcon.addEventListener("click", function (event) {
        event.stopPropagation();
        
        volumeSlider.style.display = (volumeSlider.style.display === "block") ? "none" : "block";
    });

    document.addEventListener("click", function (event) {
        if (event.target !== volumeIcon && event.target !== volumeSlider) {
            volumeSlider.style.display = "none";
        }
    });

    volumeSlider.addEventListener("input", (e) => {
        wavesurfer.setVolume(e.target.value);
    });

    speedButton.addEventListener("click", () => {
        const rates = [1, 1.5, 2];
        const currentRate = wavesurfer.getPlaybackRate();
        const newRate = rates[(rates.indexOf(currentRate) + 1) % rates.length] || rates[0];
        wavesurfer.setPlaybackRate(newRate);
        speedButton.textContent = newRate + "x";
    });

    skipForwardButton.addEventListener("click", () => {
        wavesurfer.setCurrentTime(wavesurfer.getCurrentTime() + 10);
    });

    skipBackwardButton.addEventListener("click", () => {
        wavesurfer.setCurrentTime(wavesurfer.getCurrentTime() - 10);
    });

    playPauseButton.addEventListener("click", () => wavesurfer.playPause());

    wavesurfer.on("play", () => {
        playPauseButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>';
    });

    wavesurfer.on("pause", () => {
        playPauseButton.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>';
    });

    document.querySelectorAll(".play-button").forEach(button => {
        button.addEventListener("click", function() {
            document.querySelector(".episode-title").textContent = this.dataset.title;
            document.querySelector(".episode-author").textContent = this.dataset.author;
            document.querySelector(".episode-thumb").src = this.dataset.thumb;
            
            wavesurfer.load(this.dataset.audio);
            audioPlayer.style.display = "flex";
            
            wavesurfer.once("ready", () => {
                wavesurfer.play();
                wavesurfer.setVolume(1);
                volumeSlider.value = 1;
            });
        });
    });
});