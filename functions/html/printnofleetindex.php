<?php

function PrintNoFleetIndexPage() {
    printf("<html>
                <head><title>Enter Fleet URL</title></head>
                <body>
                    <form action=\"formFleet.php\">
                    <label for=\"url\">Enter Fleet URL (copy from the fleet drop down while boss)</label><input type=\"text\" name=url>
                    <input type=submit>
                    </form>
                </body>
            </html>");
}