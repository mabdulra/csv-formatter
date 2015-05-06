<!DOCTYPE html>

<html>
    <head>

        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta charset="UTF-8">
        <title>CSV Formatter</title>
        <link rel="stylesheet" type="text/css" href="theme.css">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script type="text/javascript" src="script.js"></script>

    </head>
    <body>
        <div id="container">
            <h2>Simple CSV Formatter</h2>
            <p class="left">This is a simple tool where you can upload a CSV file and view its results online. The purpose of this tool is to server as an alternative to Microsoft Excel or other such tools. This tool will generate a table to fill 100% of the width of the page, unlike Excel where you have to manually resize column width. The tool is still in development and may not work the best for CSV files that contain a large number of rows. You can track development on <a href='https://github.com/mabdulra/csv-formatter' target=_blank>GitHub</a>.</p>

            <form id="submission" action="upload.php" method="post" enctype="multipart/form-data">
                Select CSV file to upload:
                <input type="file" name="csvFile" id="csvFile" accept=".csv"><br>
                <input type="submit" name="submit" id="submit" value="Upload CSV">
            </form>

            <div id="results"></div>
        </div>
    </body>
</html>