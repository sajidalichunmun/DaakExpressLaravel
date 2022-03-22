
   function insertUrlParam(key, value) {
    if (history.pushState) {
        let searchParams = new URLSearchParams(window.location.search);
        searchParams.set(key, value);
        let newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + searchParams.toString();
        window.history.pushState({path: newurl}, '', newurl);
    }
}


//export html table to word function
function Export2Doc(element, filename = ''){
    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Exported Document</title></head><body>";
    var postHtml = "</body></html>";
    var html = preHtml+document.getElementById(element).innerHTML+postHtml;

    var blob = new Blob(['\ufeff', html], {
        type: 'application/msword'
    });
    
    // Specify link url
    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
    
    // Specify file name
    filename = filename?filename+'.doc':'document.doc';
    
    // Create download link element
    var downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob ){
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = url;
        
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
    
    document.body.removeChild(downloadLink);
}
//export html table to excel function

var tableToExcel = (function() {
    var uri = 'data:application/vnd.ms-excel;base64,'
      , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
      , base64 = function(s) { return window.btoa(unescape(encodeURIComponent(s))) }
      , format = function(s, c) { return s.replace(/{(\w+)}/g, function(m, p) { return c[p]; }) }
    return function(table, name, fileName) {
      if (!table.nodeType) table = document.getElementById(table)
      var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
      
      var link = document.createElement("A");
      link.href = uri + base64(format(template, ctx));
      link.download = fileName || 'Workbook.xls';
      link.target = '_blank';
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    }
  })();

  //direct print function

  function printContent(el){
	var restorepage = document.body.innerHTML;

var anchors = document.getElementById(el).getElementsByTagName("a");
var no_links=anchors.length;
for ( var i=no_links-1; i >=0; i-- ) {
    var span = document.createElement("span");
    if ( anchors[i].className ) {
        span.className = anchors[i].className;
    }

    if ( anchors[i].id ) {
        span.id = anchors[i].id;
    }
    span.innerHTML = anchors[i].innerHTML;
    anchors[i].parentNode.replaceChild(span, anchors[i]);
}	
	
    var printcontent = document.getElementById(el).innerHTML;
    //console.log(printcontent);
	
    document.body.innerHTML = printcontent;
    //delay until images are loaded


   
   //document.write(printcontent);
    // setTimeout(function () {
    //     window.print();
       
    // }, 500)

  
    window.print();
 
//     window.onafterprint = function(){
//         window.location.reload(true);
//    }
location.reload(true);
    document.body.innerHTML = restorepage;

   // window.opener.location.reload(true);
    
}



function printData(e)
{
   var divToPrint=document.getElementById(e);
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
     setTimeout(function () {
        newWin.print();
        newWin.close();
    }, 500)
  // newWin.print();

}




 