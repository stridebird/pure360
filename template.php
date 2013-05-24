<html>
    <head>
        <title>pure360 jpgraph app</title>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="/css/reset.css" rel="stylesheet"/>
    <link href="/css/styles.css" rel="stylesheet"/>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".fileselector").change(function(){
                // reload page with new file
                window.location.href = "?file=" + $(this).val();
            });
            $(".typeselectorbutton").click(function(){
                // reload page with new file
                //                    alert("typeselectorbutton - ");
                $('img#drawgraph').attr('src', '/drawgraph.php?file=<?= $file ?>&types='+$(".typeselector").val() );
                return false;
            });
        });
    </script>
</head>
<body>
    <div class="container">
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
                <div style="">- or -</div>
                <form action="./" method="post" enctype="multipart/form-data">
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
                <div style="float: left; width: 200;">
                    <select class="typeselector" name="" multiple="true">
                        <?php foreach ($datatypes as $type) : 
                            $colour = $plotseriescolours[ $c++ % count($plotseriescolours )];
                            ?>
                            <option value="<?= $type ?>" selected='selected' style="color: <?= $colour ?>"> <?= $type ?> </option>
                        <?php endforeach; ?>
                    </select>
                    <br />
                    <input type="button" value="redraw" onclick="" class="typeselectorbutton"/>
                </div>
                <div style="">
                    <img id="drawgraph" src="/drawgraph.php?file=<?= $file ?>">
                </div>
            </div>
        <?php endif; ?>
        <div class="footer">
            pure360 graph app &copy; 2013 
        </div>
    </div>
</body>
</html>