<html>
    <head>
        <title>pure360 jpgraph app</title>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="css/reset.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".fileselector").change(function(){
                // reload page with new file
                window.location.href = "?file=" + $(this).val();
            });
            $(".typeselectorbutton").click(function(){
                var activetypes = $('input:checkbox:checked').map(function(){
                    return this.value;
                }).get();
                // reload page with new file
                //                    alert("typeselectorbutton - ");
                $('img#drawgraph').css('opacity', '0.5');
                $('img#drawgraph').attr('src', 'drawgraph.php?file=<?= $file ?>&types='+activetypes );
                $('img#drawgraph').css('opacity', '1');
                return false;
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h1>Pure360 JPGraph application</h1>
        <div class="graph-input">
            Select file to graph: 
            <select class="fileselector" name="fileselector" >
                <option value=""></option>
                <?php foreach ($availablefiles as $f) : ?>
                    <?php $selected = ( $f == $file) ? "selected='selected'" : ""; ?>
                    <option value="<?= $f ?>" <?= $selected ?>><?= $f ?></option>
                <?php endforeach; ?>
            </select>
            <?php if ($uploadpathwritable) : ?>
                OR
                <form action="./" method="post" enctype="multipart/form-data" style="display: inline;">
                    Upload new file: 
                    <input type="file" name="uploadfile" /><input type="submit" />
                </form>
            <?php else: ?>
                <div class="errorbox">
                    Warning! Upload folder is not writable. Upload disabled.
                </div>
            <?php endif; ?>

        </div>


        <?php if ($file) : ?>
            <div class="graph-output">
                <div style="float: left; width: 200; margin-top: 40px">
                    <p>select data series</p>
                        <?php $c = 0; foreach ($datatypes as $type) : 
                            $colour = $plotseriescolours[ $c++ % count($plotseriescolours )];
                            ?>
                <div>
                            <input type="checkbox" name="datatypes[]" value="<?= $type ?>" checked='checked' /> 
                            <span style="color: <?= $colour ?>; font-weight: bold;"><?= $type ?></span>
                </div>
                        <?php endforeach; ?>
                    <br />
                    <input type="button" value="redraw" onclick="" class="typeselectorbutton"/>
                </div>
                <div style="">
                    <img id="drawgraph" src="drawgraph.php?file=<?= $file ?>">
                </div>
            </div>
        <?php endif; ?>
        <div class="footer">
            pure360 graph app &copy; 2013 || download the code: <a href="pure360demo.tar.gz">[tar.gz]</a> | <a href="pure360demo.zip">[zip]</a>
        </div>
    </div>
</body>
</html>
