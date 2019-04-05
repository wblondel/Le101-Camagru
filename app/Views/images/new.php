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
                    <!-- scrollable capture history -->
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <!-- scrollable items to put on webcam images -->
                </div>
            </div>
    </div>
</main>
