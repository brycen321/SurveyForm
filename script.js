const tableId = document.getElementById("tableData");
const btn = document.getElementById("viewbutton");

function exportTabletoExcel(tableID, filename=''){
    console.log("working");
    let downloadLink;
    let dataType = 'application/vnd.ms-excel';
    let tableHTML = tableId.outerHTML.replace(/ /g,'%20');

    filename=filename?filename+'.xls':'survey_result.xls';

    downloadLink = document.createElement("a");

    document.body.appendChild(downloadLink);

    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML],{
            type: dataType
        });
        navigator.msSaveOrOpenBlob(blob, filename);
    }else{
        downloadLink.href='data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
    }
}
