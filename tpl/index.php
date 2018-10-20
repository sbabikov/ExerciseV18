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
    
    <title>PHP Exercise - v18.0.0</title>
    
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/style.css">
    
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
    <h1>PHP Exercise - v18.0.0</h1>
    <form action="result.php" method="post" id="qform" onsubmit="return Validator.onSubmit()">
        <div id="message"><?=empty($error) ? '' : '<span class="error">ERROR: ' . $error . '</span>'?></div>
        
        <div>
            <label for="company-symbol" class="control-label">Company Symbol:</label>
            <input type="text" name="company-symbol" id="company-symbol" pattern="[A-Z\^]{1,6}" placeholder="Enter uppercase latin symbols" value="<?=!empty($data['company-symbol']) ? htmlentities(trim($data['company-symbol']), ENT_NOQUOTES) : ''?>" required>
        </div>
      
        <div>
            <label for="start-date" class="control-label">Start Date:</label>
            <input type="text" name="start-date" id="start-date" class="datepicker" pattern="[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}" placeholder="YYYY-mm-dd" autocomplete="off" value="<?=!empty($data['start-date']) ? htmlentities(trim($data['start-date']), ENT_NOQUOTES) : ''?>" required>
        </div>
          
        <div>  
            <label for="end-date" class="control-label">End Date:</label>
            <input type="text" name="end-date" id="end-date" class="datepicker" pattern="[0-9]{4}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}" placeholder="YYYY-mm-dd" autocomplete="off" value="<?=!empty($data['end-date']) ? htmlentities(trim($data['end-date']), ENT_NOQUOTES) : ''?>" required>
        </div>
      
        <div>
            <label for="email" class="control-label">E-mail:</label>
            <input type="email" name="email" id="email" value="<?=!empty($data['email']) ? htmlentities(trim($data['email']), ENT_NOQUOTES) : ''?>" required>
        </div>
      
        <button type="submit">Submit</button>
    </form>
</body>
</html>
