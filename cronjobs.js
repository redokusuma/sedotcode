function cronExecute() {
//tutorial https://goo.gl/4hBu3R
var url = "URL";

var options = {
"method" : "get",
"headers" : {'User-Agent' : 'Mozilla Firefox 14.0',
             'Accept-Charset' : 'ISO-8859-1,utf-8;q=0.7,*;q=0.7'
            },
"payload" : "",
"contentType" : "application/xml; charset=utf-8"
};

var request_starttime = new Date();
// fetch the HTTP / HTTPS request and get the response
var response = UrlFetchApp.fetch(url,options);
var request_endtime = new Date();

// use any spreadsheet, use its key
// var ss = SpreadsheetApp.openById("1h1Ub-ASUKtUt39XoncxOOiBKfwID9HNnY-osMIC17AM");
// use this script's default spreadsheet
var ss = SpreadsheetApp.getActiveSpreadsheet();
// get the worksheet
var sheet = ss.getSheets()[0];

// inserting values into the sheet
sheet.insertRowBefore(1);
var colValues = [[ request_starttime, request_endtime,
                 response.getResponseCode(), response.getHeaders().toSource(),
                 url, response.getContentText() ]];
sheet.getRange(1, 1, 1, 6).setValues(colValues);

} 
