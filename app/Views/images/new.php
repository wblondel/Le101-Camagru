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
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="effects_list">
                    <!-- scrollable items to put on webcam images -->
                    <?php foreach ($effects as $effect) : ?>
                        <div class="effect">
                            <p>Test</p>
                        </div>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
