

<?php

if (isset($_GET["space"])) {


    header('Content-type: application/json');
    $response = array();
    $space = $_GET["space"];
    $json = json_decode(file_get_contents("https://api-mainnet.pool.space/api/pool"));
    $blocksFound = $json->last24HourStats->blocksFound;
    $poolNetSpaceTiB = $json->poolNetSpaceTiB;

    $dailyXCH= round(1.75 * $blocksFound / $poolNetSpaceTiB ,5);
    $dailyProfit = round($dailyXCH*$space,5);
    $response["usedSpace"] = $space;
    $response["dailyXCH"]=$dailyXCH;
    $response["dailyProfit"] = $dailyProfit;


    echo json_encode($response);
} else {
?>
    <html>
    <style>
        table,
        tr,
        td {
            border: 1px solid;
            margin-top: 100px;
            border-collapse: collapse;
            padding: 10px;
        }

        .center {
            margin-left: auto;
            margin-right: auto;

        }
    </style>

    <body>
        <form method='get' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
            <table class=center>
                <tr>
                    <td colspan="2">
                        <h1>Calculate your daily profit mining Chia</h1>
                <tr>
                    <td>Total space filled with plot:
                    <td><input type=text name=space />
                <tr>
                    <td class=center colspan=2><input type=submit name=submit value="submit" />
            </table>
        </form>
    </body>

    </html>



<?php
}


























?>
