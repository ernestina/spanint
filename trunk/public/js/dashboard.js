function resizeDisplay() {
        
    if ($(window).innerWidth() <= 1440) {
        $("#pie-container > div").each(function() {
            $(this).addClass("low-res");
        });
    } else {
        $("#pie-container > div").each(function() {
            $(this).removeClass("low-res");
        });
    }

}

function resizeSummary(target) {
    
    $("#" + target).css("overflow-x","auto");
    if (($(window).innerHeight()-600) > 200) {
        $("#" + target + " > .ticker-content").css("max-height",($(window).innerHeight()-600));
    } else {
        $("#" + target + " > .ticker-content").css("max-height",200);
    }
    
    $("#" + target + " > .ticker-header table").css("width","100%");
    $("#" + target + " > .ticker-summary table").css("width","100%");
    
    colCount = 0;
    $("#" + target + " .total > td").each(function() {
        colCount ++;
    });
        
    for (i=0; i<(colCount-1); i++) {   
        $("#" + target + " > .ticker-summary .col-" + i).css("width", $("#" + target + " > .ticker-content > table .col-" + i).width()+1);
    }
    $("#" + target + " > .ticker-summary .col-" + colCount).css("width", "auto");

    for (i=0; i<(colCount-1); i++) {   
        $("#" + target + " > .ticker-header .col-" + i).css("width", $("#" + target + " > .ticker-content > table .col-" + i).width()+1);
    }
    $("#" + target + " > .ticker-header .col-" + colCount).css("width", "auto");
}

function processSummary(target) {
    
    colCount = 0;
    $("#" + target + " .total > td").each(function() {
        colCount ++;
    });
    
    for (i=1; i<=(colCount-1); i++) {

        $("#" + target + " > .ticker-summary .col-" + i).html("0");

    }
    
    $("#" + target + " .ticker-content tr").each(function() {
        for (i=1; i<=(colCount-1); i++) {
            
            cellValue = $(".col-" + i, this).html();
            cellValue = parseInt(cellValue.replace(',',''));
            
            sumValue = $("#" + target + " > .ticker-summary .col-" + i).html();
            sumValue = parseInt(sumValue.replace(',',''));
            
            totalValue = cellValue + sumValue;
            
            $("#" + target + " > .ticker-summary .col-" + i).html(accounting.formatNumber(totalValue));
            
        }
    });
    
    resizeSummary(target);

}

function prependSummaryItem(data,target) {
    
    colCount = 0;
    $("#" + target + " .total > td").each(function() {
        colCount ++;
    });
    
    displayRow = false;
    
    for (i=0; i<data.rowContents.length; i++) {
        if (data.rowContents[i] > 0) {
            displayRow = true;
            break;
        }
    }
    
    if (displayRow) {
        rowData = "<tr>";
        rowData += "<td class='col-0' style='text-align: left;'><a href='" + data.rowLink + "'>" + data.rowHeader + "</a></td>";
        dataCount = 0;
        colCount = 0;

        for (i=0; i<summaryHeader.listHeader.length; i++) {
            if (summaryHeader.listHeader[i].listColGroup != undefined) {
                sum = 0;
                for (j=0; j<summaryHeader.listHeader[i].listColGroup.length; j++) {
                    colCount++;
                    rowData += "<td class='col-" + colCount + "' style='min-width: 75px'>" + accounting.formatNumber(data.rowContents[dataCount]) + "</td>";
                    if ((summaryHeader.listHeader[i].sumCol != undefined) && (summaryHeader.listHeader[i].sumCol > 0)) {
                        sum += data.rowContents[dataCount];
                    }
                    dataCount++;
                }
                if ((summaryHeader.listHeader[i].sumCol != undefined) && (summaryHeader.listHeader[i].sumCol > 0)) {
                    colCount++;
                    rowData += "<td class='bold col-" + colCount + "' style='min-width: 75px'>" + accounting.formatNumber(sum) + "</td>";
                }
            } else {
                colCount++
                rowData += "<td class='col-" + colCount + "' style='min-width: 75px'>" + accounting.formatNumber(data.rowContents[dataCount]) + "</td>";
                dataCount++;
            }
        }

        rowData += "</tr>";

        $("#" + target + " .ticker-content > table").append(rowData);

        processSummary(target);
    }
    
}

function streamSummaryData() {
    
    if (unit_list.length > 0) {
        for (i=0; i<unit_list.length; i++) {
            $.ajax({
                'global': false,
                'url': serverUrl + 'DataJSON/summaryUnit/' + unit_list[i] + '/' + $("#pie-status-lhp .pie-info-title").html().substring(5,15).replace('-','').replace('-',''),
                'dataType': 'json',
                'success': function (data) {
                    prependSummaryItem(data,"summary-container");
                }
            });
            console.log(serverUrl + 'DataJSON/summaryUnit/' + unit_list[i] + '/' + $("#pie-status-lhp .pie-info-title").html().substring(5,15).replace('-','').replace('-',''));
        }
        
    }
    
}

function dataLoaded() {
    loadedData ++;
    if (loadedData >= totalData) {
        $("#loading-animation").removeAttr("style");
        loadedData = 0;
    }
}

function renderSummary(data,target) {
    
    var summaryContent = "";
    
    summaryContent += "<div class='ticker-header'><table>";
    
    if (data.listHeader.length > 0) {
        
        summaryContent += "<tr class='bold'>";
        summaryContent += "<td class='col-0' rowspan=2 style='text-align: left;'>" + data.rowHeader + "</td>";
        
        colCount = 0;
        
        for (i=0; i<data.listHeader.length; i++) {
            
            if ((data.listHeader[i].listColGroup != undefined) && (data.listHeader[i].listColGroup.length > 1)) {
                if ((data.listHeader[i].sumCol != undefined) && (data.listHeader[i].sumCol > 0)) {
                    summaryContent += "<td colspan=" + (data.listHeader[i].listColGroup.length + 1) + ">" + data.listHeader[i].listColTitle + "</td>";
                } else {
                    summaryContent += "<td colspan=" + data.listHeader[i].listColGroup.length + ">" + data.listHeader[i].listColTitle + "</td>";
                }
            } else {
                colCount++
                summaryContent += "<td rowspan=2 class='col-" + colCount + "'>" + data.listHeader[i].listColTitle + "</td>";
            }
            
        }
        
        summaryContent += "</tr><tr class='bold'>";
        
        for (i=0; i<data.listHeader.length; i++) {
            if (data.listHeader[i].listColGroup != undefined) {
                for (j=0; j<data.listHeader[i].listColGroup.length; j++) {
                    colCount++;
                    summaryContent += "<td class='col-" + colCount + "'>" + data.listHeader[i].listColGroup[j] + "</td>";
                }
                if ((data.listHeader[i].sumCol != undefined) && (data.listHeader[i].sumCol > 0)) {
                    
                    colCount++;
                    summaryContent += "<td class='col-" + colCount + "'>Total</td>";
                    
                }
            }
        }
        
        summaryContent += "</tr>";
        
    }
    
    summaryContent += "</table></div><div class='ticker-content'><table></table></div><div class='ticker-summary'><table>";
    
    summaryContent += "<tr class='total bold'>";
    summaryContent += "<td class='col-0' rowspan=2 style='text-align: left;'>Total</td>";
    colCount = 0;
        
    for (i=0; i<data.listHeader.length; i++) {

        if ((data.listHeader[i].listColGroup != undefined) && (data.listHeader[i].listColGroup.length > 1)) {
            for (j=0; j<data.listHeader[i].listColGroup.length; j++) {
                colCount++;
                summaryContent += "<td class='col-" + colCount + "'>0</td>";
            }
            if ((data.listHeader[i].sumCol != undefined) && (data.listHeader[i].sumCol > 0)) {  
                colCount++;
                summaryContent += "<td class='col-" + colCount + "'>0</td>";
            }
        } else {
            colCount++;
            summaryContent += "<td class='col-" + colCount + "'>0</td>";
        }

    }
    
    summaryContent += "</tr>";
    
    summaryContent += "</table></div>";
    
    $("#" + target).html(summaryContent);
    
    streamSummaryData();
    
    dataLoaded();
    
}

function renderPie(data,target) {

    var pieContainerContent = "";

    pieContainerContent += "<canvas id='" + target + "-canvas'></canvas>";
    pieContainerContent += "<div class='pie-info'>";
    pieContainerContent += "<div class='pie-info-title'>" + data.title + "</div>";

    for (i=0; i<data.pieData.length; i++) {

        if (data.pieData.length > 2) {

            pieContainerContent += "<div class='pie-info-content half'>";


        } else {

            pieContainerContent += "<div class='pie-info-content full'>";

        }

        pieContainerContent += "<div class='sphere' style='background: " + data.pieData[i].color + "'></div>"
        pieContainerContent += "<span class='info-number'>" + data.pieData[i].index + "</span><br/><span class='info-text'>" + data.pieData[i].label + "</span>"
        pieContainerContent += "</div>";

    }

    pieContainerContent += "</div>";

    $("#" + target).html(pieContainerContent);
    $("#" + target).fadeIn(400, "swing", function() {
        $("#" + target + "-canvas").attr("width",$("#" + target + "-canvas").width()-5);
        $("#" + target + "-canvas").attr("height",$("#" + target + " > .pie-info").height());

        dataExists = false;

        for (i=0; i<data.pieData.length; i++) {

            if ((data.pieData[i].value != 0) && (data.pieData[i].value != null)) {

                dataExists = true;
                break;

            }

        }

        var pieData = new Array();

        if (dataExists) {

            for (i=0; i<data.pieData.length; i++) {

                pieData[i] = new Array();
                pieData[i].value = data.pieData[i].value;
                pieData[i].color = data.pieData[i].color;

            }

        } else {

            pieData[0] = new Array();
            pieData[0].value = 1;
            pieData[0].color = "#e5e5e5";
        }

        var canvas = $("#" + target + "-canvas").get(0).getContext("2d");
        var chart = new Chart(canvas).Doughnut(pieData);

        dataLoaded();
        
    });

}

function renderList(data,target) {
    
    $("#" + target).html("");

    var listContainerContent = "";

    listContainerContent += "<div class='ticker-title'>" + data.title + "<div class='ticker-total'>" + data.listRow.length + "</div></div>";
    listContainerContent += "<div class='ticker-header'></div>";
    listContainerContent += "<div class='ticker-content'></div>";
    if ((data.sumList != undefined) && (data.sumList == 1)) {
        listContainerContent += "<div class='ticker-footer'></div>";    
    }
    
    $("#" + target).html(listContainerContent);
    
    if ((data.listRow.length > 0) && (data.listHeader.length > 0)) {
        
        listContents = "<table><tr>";
        listContents += "<td class='col-0' style='font-weight: bold; text-align: center'>No.</td>";

        for (j=0; j<data.listHeader.length; j++) {

            if (data.listType[j] == "Number") {

                listContents +=   "<td class='col-" + (j+1) + "' style='font-weight: bold; text-align: right'>" + data.listHeader[j] + "</td>";

            } else {

                listContents +=   "<td class='col-" + (j+1) + "' style='font-weight: bold; text-align: center'>" + data.listHeader[j] + "</td>";

            }

        }

        listContents += "</tr></table>";
        
        $("#" + target + " > .ticker-header").html(listContents);

    } else {
        
        listContents = "<table><tr><td>Tidak ada data.</td></tr></table>";
        $("#" + target + " > .ticker-header").html(listContents);
    }
    
    sumCol = new Array();
    for (j=0; j<data.listHeader.length+1; j++) {
        sumCol[j] = 0;
    }
    
    if (data.listRow.length > 0) {
        
        listContents = "<table>";
        
        for (i=0; i<data.listRow.length; i++) {

            listContents += "<tr>";
            listContents += "<td class='col-0' style='text-align: center; min-width: 20px;'>" + (i+1) + "</td>";
            
            for (j=0; j<data.listRow[j].listCol.length; j++) {
                
                if (data.listType[j] == "Number") {
                    listContents += "<td class='col-" + (j+1) + "' style='text-align: right'>";
                    listContents += accounting.formatNumber(data.listRow[i].listCol[j]);
                    sumCol[j+1] += data.listRow[i].listCol[j];
                } else {
                    listContents += "<td class='col-" + (j+1) + "' style='text-align: center'>";
                    listContents += data.listRow[i].listCol[j];
                }
                
                listContents += "</td>";
            }
            
            listContents += "</tr>";

        }
        
        listContents += "</table>";
        
        $("#" + target + " > .ticker-content").append(listContents);
        
        console.log(sumCol);
        
        if ((data.sumList != undefined) && (data.sumList == 1)) {
            listSumContents = "<table><tr class='bold'><td colspan=";
            
            colSpan = 0;
            
            for (i=0; i<data.listType.length; i++) {
                if (data.listType[i] == "String") {
                    colSpan++;
                }
            }
            
            listSumContents += colSpan +">Total</td>";
            for (i=(colSpan-1); i<data.listType.length; i++) {
                if (data.listType[i] == "Number") {
                    listSumContents += "<td class='col-" + (i+1) + "' style='text-align: right'>" + accounting.formatNumber(sumCol[i+1]) + "</td>";
                }
            }
            listSumContents += "</tr></table>";
            
            $("#" + target + " > .ticker-footer").append(listSumContents);
            
        }
        
    }
    
    footerHeight = 0;
    
    if ($("#" + target + " > .ticker-footer").html() != undefined) {
        footerHeight = $("#" + target + " > .ticker-footer").outerHeight();
        console.log(footerHeight);
    }
    
    $("#" + target + " > .ticker-content").height($(window).innerHeight()-600-footerHeight);
    
    if ($("#" + target + " > .ticker-content").height() < (200-footerHeight)) {
        
        $("#" + target + " > .ticker-content").height(200-footerHeight);
        
    }
    
    $("#" + target).slideDown();
    
    for (j=0; j<data.listHeader.length; j++) {
            
        $("#" + target + " > .ticker-header > table .col-" + j).css("width", $("#" + target + " > .ticker-content > table .col-" + j).width()+1);

    }

    $("#" + target + " > .ticker-header > table .col-" + data.listHeader.length).css("width", "auto");
    $("#" + target + " > .ticker-header > table").css("width", "100%");
    
    resizeList(target);
    
    dataLoaded();

}

function resizeList(target) {
    
    if ($("#" + target + " > .ticker-footer").html() != undefined) {
        footerHeight = $("#" + target + " > .ticker-footer").outerHeight();
    }
    
    $("#" + target + " > .ticker-content").height($(window).innerHeight()-600-footerHeight);
    
    if ($("#" + target + " > .ticker-content").height() < 200-footerHeight) {
        
        $("#" + target + " > .ticker-content").height(200-footerHeight);
        
    }
    
    setTimeout(function() {
    
        colCount = $("#" + target + " > .ticker-header td").length - 1;

        for (j=0; j<(colCount-1); j++) {

            $("#" + target + " > .ticker-header > table .col-" + j).css("width", $("#" + target + " > .ticker-content > table .col-" + j).width()+1);

        }

        $("#" + target + " > .ticker-header > table .col-" + colCount).css("width", "auto");
        
    }, 100);
    
}

function renderLine(data,target) {
    
    var lineContainerContent = "<div id='line-chart-container'><div class='ticker-title'>" + data.title + "<div class='line-legend'><span class='sphere blue'></span>Gaji</div><div class='line-legend'><span class='sphere purple'></span>Non Gaji</div><div class='line-legend'><span class='sphere yellow'></span>Lainnya</div><div class='line-legend'><span class='sphere red'></span>Void</div></div><canvas id='" + target + "-canvas'></canvas></div>";
    
    $("#" + target).html(lineContainerContent);
    $("#" + target).fadeIn(400, "swing", function() {
        $("#" + target + "-canvas").attr("width",$("#" + target).innerWidth()-40);
        $("#" + target + "-canvas").attr("height",$(window).innerHeight()-600);

        var canvas = $("#" + target + "-canvas").get(0).getContext("2d");
        var chart = new Chart(canvas).Line(data.lineData);

        dataLoaded();
        
    });
}

function addLoadingAnimation(target) {
        
    $(target).append("<div class='modalDialog' id='loading-animation'><div class='loading-sphere' style='width: 40px; height: 40px; border-radius: 30px; overflow: hidden; padding: 0; margin: auto; position: absolute; top: 0; left: 0; bottom: 0; right: 0; background: rgba(0,0,0,0); border: 4px solid #fff;'></div></div>");

}