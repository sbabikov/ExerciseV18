# PHP Exercise - v18.0.0 for [XM] (www.xm.com)
In this exercise you need to create a form with 4 input fields: 
 
*  Company Symbol  
*  Start Date (YYYY-mm-dd)  
*  End Date (YYYY-mm-dd)  
*  Email  
 
When the user submits the form you must do the following: 
 
1) Validate the form both on client and server side and place appropriate messages on both cases. 
All fields must be mandatory. Include also validation for:  
- formatting and logic of dates  
- existence of company symbol  
- formatting of email 
 
2) Display on screen the historical quotes for the submitted company in the given date range in 
table format (Date, Open, High, Low, Close and Volume values).  
Company symbols can be found here:  
http://www.nasdaq.com/screening/companies-by-name.aspx  
(For download in excel format: http://www.nasdaq.com/screening/companies-by-name.aspx?&render=download)  
 
Data should be retrieved by using the API:  
> https://www.quandl.com/api/v3/datasets/WIKI/{symbol}.csv?order=asc&start_date={Y-m-d}&end_date={Y-m-d}
 
**Examples**
* https://www.quandl.com/api/v3/datasets/WIKI/AAPL.csv?order=asc&start_date=2003-01-01&end_date=2003-03-06
* https://www.quandl.com/api/v3/datasets/WIKI/GOOG.csv?order=asc&start_date=2017-01-01&end_date=2017-03-06
 
3) Display a chart of the open and close prices in the given date range.  
 
4) Send an email using the submitted company’s name as subject (i.e. Google) and the start date 
and end date as body (i.e. "From 2016-01-01 to 2016-02-01").  

**Notes**
*  The user must enter date using jQuery UI datepicker  
http://jqueryui.com/datepicker/  
*  You can develop the exercise using plain PHP, but PHP framework (Symfony, Laravel etc) is 
preferred.  
*  In case you will not use any PHP framework, the email must be send using the swift mailer 
https://github.com/swiftmailer/swiftmailer  


## Requirements and depends
> PHP >= 7.0.0

## Install

> $ composer install

## Uses

Public folder is 'web'. Setup your HTTP server to have access to this folder only.
You can switch on/off email sending through 

> define('SEND_EMAIL', true);

in /config/config.php

Also you have to define your E-mail for FROM field of email sending through

> define('EMAIL_FROM', ['test@test.com' => 'Ivan Pupkin']);

## Tests

You can call tests via console command:

> ./vendor/bin/phpunit
