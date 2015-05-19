<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <script  type="text/javascript">
            function textSearchCheckboxHandler() {
                if (document.getElementById("textSearchCheckboxId").checked) {
                    document.getElementById("textSearchId").style.visibility = "visible";
                } else {
                    document.getElementById("textSearchId").style.visibility = "hidden";
                }
            };
        </script>
    </head>
    <body>
        <form action="2_action.php" method="GET">
            <span>File name: </span>
            <input type="text" name="fileName"/><br/><br/>
            <input type="checkbox" name="textSearchCheckbox" id="textSearchCheckboxId" onchange="textSearchCheckboxHandler();"/>
            <span>Text search: </span>
            <input type="text" name="textSearch" id="textSearchId"/><br/><br/>
            <input type="submit" value="Submit"/>
        </form>     
        <script  type="text/javascript">
            textSearchCheckboxHandler();
        </script>
    </body>
</html>