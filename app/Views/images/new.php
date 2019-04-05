<main role="main">
    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-9">
                    <div class="camera">
                        <video id="video">Video stream not available.</video>
                        <canvas id="effect-canvas"></canvas>
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
                    <?php foreach ($effects as $effect) : ?>
                        <div class="col-sm-2 effect">
                            <img src="/img/effects/<?= $effect->filename ?>" class="img-fluid" alt="<?= $effect->name ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>
