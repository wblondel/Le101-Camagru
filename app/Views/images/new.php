<main role="main">
    <div class="py-5 bg-light">
        <div class="container">
            <div class="contentarea">
                <div class="camera">
                    <video id="video">Video stream not available.</video>
                    <div class="text-center">
                        <button id="startbutton">Take photo</button>
                        <input type="file" id="selectedFile" style="display: none;" onchange="previewFile()" />
                        <input id="uploadbutton" type="button" value="Upload photo" onclick="document.getElementById('selectedFile').click();" />
                    </div>
                </div>
                <canvas id="canvas">
                </canvas>
                <div class="output">
                    <img id="photo" alt="The screen capture will appear in this box.">
                </div>
            </div>
        </div>
    </div>
</main>