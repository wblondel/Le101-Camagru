<main role="main">
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-9">
                    <div class="camera">
                        <video id="video">Video stream not available.</video>
                        <div class="text-center">
                            <button id="startbutton">Take photo</button>
                            <input type="file" id="selectedFile" style="display: none;" onchange="previewFile()"/>
                            <input id="uploadbutton" type="button" value="Upload photo" onclick="document.getElementById('selectedFile').click();"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <canvas id="canvas">
                    </canvas>
                    <div class="output">
                        <img id="photo" alt="The screen capture will appear in this box.">
                    </div>
                </div>
            </div>
            <div class="container effect-group">
                <div class="row text-center">
                    <div class="col-xs-4">1</div>
                    <div class="col-xs-4">2</div>
                    <div class="col-xs-4">3</div>
                    <div class="col-xs-4">4</div>
                    <div class="col-xs-4">5</div>
                    <div class="col-xs-4">6</div>
                    <div class="col-xs-4">7</div>
                    <div class="col-xs-4">8</div>
                </div>
            </div>
        </div>
    </div>
</main>
