<html>
    <head>
        <title>pure360 jpgraph app</title>
        <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <link href="/css/reset.css" rel="stylesheet"/>
        <style type="text/css" media="screen">
            body {
                font-family: helvetica, arial, sans;
                font-size: 0.9em;
            }
            div.container {
                margin: 10px;
                border: 1px solid #e2e2e2;
                padding: 10px;
            }
            div.graph-input {
                clear: left;
                padding: 10px 0;
            }
            div.graph-output {
                clear: left;
                padding: 10px 0;
                border-top: 1px solid #e2e2e2;
            }
            div.footer {
                clear: left;
                padding: 10px 0;
            }
        </style>
        <script type="text/javascript">
            $(document).ready(function(){
                $(".fileselector").change(function(){
                    
                });
            });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="graph-input">
                Select file to graph:
                <select class="fileselector" name="" >
                    <option value="dummy">dummy-file.csv</option>
                    <option value="dummy">dummy-file.csv</option>
                    <?php foreach ($availablefiles as $file) : ?>
                        <option value="<?= $file ?>"><?= $file ?></option>
                    <?php endforeach; ?>
                </select>

                <form action="" method="post" enctype="multipart/form-data">
                    Upload new file: 
                    <input type="file" name="uploadfile" /><input type="submit" />
                </form>

            </div>

            <div class="graph-output">
                <div style="float: left; width: 200;">
                    <select class="fileselector" name="" multiple="true">
                        <option value="dummy">dummy-file.csv</option>
                        <option value="dummy">dummy-file.csv</option>
                        <?php foreach ($datatypes as $type) : ?>
                            <option value="<?= $type ?>"><?= $type ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div style="">
                    graph here
                </div>
            </div>
            <div class="footer">
                pure360 graph app &copy; 2013
            </div>
        </div>
    </body>
</html>