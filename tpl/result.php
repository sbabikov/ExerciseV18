<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Expires" content="Fri, Jan 01 1900 00:00:00 GMT">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Lang" content="en">
    <meta name="author" content="Sergii Babikov">
    <meta name="description" content="PHP Exercise - v18.0.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>PHP Exercise - v18.0.0 - Result page</title>
    
    <link rel="stylesheet" href="css/style.css">
    
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<body>
    <h1>PHP Exercise - v18.0.0 - Result page</h1>
    <a href="index.php">Home</a> / <b>Result page</b>
    <div id="chart"></div>
    <table cellpadding="3" cellspacing="1">
    <?php foreach ($result['data'] as $n => $row) {?>
        <tr>
            <?php for ($i = 0; $i < 6; ++ $i) {?>
                <?php if (!$n) {?>
                    <th><?=$row[$i]?></th>
                    <?php continue;?>
                <?php }?>
                <td><?=$row[$i]?></td>
            <?php }?>
        </tr>
        <?php
            if ($n) {
                $dt[] = $row[0];
                $open[] = $row[1];
                $high[] = $row[2];
                $low[] = $row[3];
                $close[] = $row[4];
            }
        ?>
    <?php }?>
    </table>
    
    <script type="text/javascript">
        var trace1 = {
          x: ["<?=implode('","', $dt)?>"],
          close: [<?=implode(',', $close)?>],
          decreasing: {line: {color: '#7F7F7F'}},
          high: [<?=implode(',', $high)?>],
          increasing: {line: {color: '#17BECF'}},
          line: {color: 'rgba(31,119,180,1)'},
          low: [<?=implode(',', $low)?>],
          open: [<?=implode(',', $open)?>],
          type: 'candlestick',
          xaxis: 'x', 
          yaxis: 'y'
        };

        var data = [trace1];
        
        var layout = {
          dragmode: 'zoom', 
          margin: {
            r: 0, 
            t: 0, 
            b: 0, 
            l: 0
          }, 
          showlegend: false, 
          xaxis: {
            autorange: true, 
            type: 'date'
          }, 
          yaxis: {
            autorange: true, 
            domain: [0, 1], 
            type: 'linear'
          }
        };

        Plotly.newPlot('chart', data, layout);
    </script>
</body>
</html>
