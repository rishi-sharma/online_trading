var get=[];
$("document").ready(function(){
    get_url_variables();
    var where_clause={"search_term" : get["search_bar"]};
    load_filter(get["search_bar"]);
    // console.log(JSON.stringify(where_clause));
   	load_items(JSON.stringify(where_clause));
    load_promotions(get["search_bar"]);
    $(document.body).on("change",":radio",function(){
        //:radio is pseudo selector we could have used "input[type='radio']"
        // SInce the elements are loaded through ajax so the .ready event happens before the elements are loaded
        // as a result if I bind it directly to radio, at the time this event handelr is being bound no radio is present
        // so it bounds to none so I bounded it to body and then checked if the change is on :radio
        if($(this).hasClass("category")){
            if($(this).prop("checked")==true){
                if($(this).attr("value")==""){
                    delete where_clause["category like"];//will delete if it exist..??
                }else{
                    where_clause["category like"]=$(this).attr("value");
                }
            }else{//redundent code we don't need the else part as we are using radio button so he cannot uncheck
                delete where_clause["category like"];
            }
            load_items(JSON.stringify(where_clause));
        }else if($(this).hasClass("type")){
            if($(this).prop("checked")==true){
                if($(this).attr("value")==""){
                    delete where_clause["type ="]
                }else{
                    where_clause["type ="]=$(this).attr("value");   
                }
            }else{
                delete where_clause["type ="];   
            }
            load_items(JSON.stringify(where_clause));
        }else if($(this).hasClass("cost")){
            if($(this).prop("checked")==true){
                if($(this).attr("value")==""){
                    delete where_clause["cost <"];
                    delete where_clause["cost >="];
                }else{
                    var cost_span=$(this).attr("value").split(":");
                    where_clause["cost <"]=cost_span[0];
                    where_clause["cost >="]=cost_span[1];   
                }
            }else{
                delete where_clause["cost <"];
                delete where_clause["cost >="];
            }
            
            load_items(JSON.stringify(where_clause));
        }
        
    });
});

function load_items(where_clause){
    document.getElementById("item_list").innerHTML="";
	$.ajax({
        url: "get_search_result.php",
        dataType: "json",
        type: "POST",
        data: { where_clause : where_clause },
        success: function(response_data){
            // as we have written datatype as json so jquery automatically converts the result 
            //from json... so responce_data is not json its already parsed
            var item_list=document.getElementById("item_list");
            for (var row in response_data){
                var table_row=$("<tr>");
                table_row.attr("id",response_data[row]["item_id"]);
                table_row.addClass("clickableRow");
                // table_row.attr("href","http://localhost/online_trading/files/template.php");
                var pic_col=$("<td>");
                var img_box=$("<img>");
                img_box.css("width","120px");
                img_box.css("height","150px");
                img_box.attr("src",response_data[row]["pic_loc"]);
                img_box.appendTo(pic_col);
                var detail_col=$("<td>");
                detail_col.append("<a href='"+response_data[row]["type"]+".php?item_id="+response_data[row]["item_id"]+"'>"+response_data[row]["item_nm"]+"</a>");
                detail_col.append("<br>Seller : "+response_data[row]["user_nm"]);
                detail_col.append("<br> Cost: "+response_data[row]["cost"]);
                var type_col=$("<td>");
                type_col.append("Type :"+response_data[row]["type"]);
                if(response_data[row]["type"]=="auction")
                    type_col.append("<br> Last Date :"+response_data[row]["last_date"]);
                pic_col.appendTo(table_row);
                detail_col.appendTo(table_row);
                type_col.appendTo(table_row);
                table_row.appendTo(item_list);
            }
        },
        /*As of jQuery 1.5, the $.ajax() method returns the jqXHR object, which is a superset of the XMLHTTPRequest object.
        error:  Function( jqXHR jqXHR, String textStatus, String errorThrown )
        */
        error: function (request, status, error) {
            if(request.readyState==4){// 4 means complete
                if(request.status!=200){
                    alert(ajaxOptions);
                    alert(xhr.status);
                    alert(thrownError);        
                }else{
                    var item_list=document.getElementById("item_list");
                    var table_row=$("<tr>");
                    table_row.text("No search results");
                    table_row.appendTo(item_list);
                }    
            }
        }
    });
}

function get_url_variables(){
    location.search.replace('?', '').split('&').forEach(function (val) {
        split = val.split("=", 2);
        get[split[0]] = split[1];
    });
}   

function load_filter(search_term){
    $.ajax({
        url: "load_filter.php",
        dataType: "json",
        type: "POST",
        data: { search_term : search_term },
        success: function(response_data){
            // as we have written datatype as json so jquery automatically converts the result 
            //from json... so responce_data is not json its already parsed
            var filter_list=document.getElementById("filter_list");
            var category_distribution=response_data["category_distribution"];
            var type_distribution=response_data["type_distribution"];
            var cost_distribution=response_data["cost_distribution"];
            var category=$("<li>");
            var type=$("<li>");
            var cost=$("<li>");
            category.append("<h3>Categories</h3>");
            type.append("<h3>Type</h3>");
            cost.append("<h3>Cost</h3>");
            var category_list=$("<ul>");
            var type_list=$("<ul>");
            var cost_list=$("<ul>");
            //Default main category
                var category_element=$("<li>");
                var main_category=$("<input>");
                main_category.attr("type","radio");
                main_category.attr("value","");
                main_category.attr("name","category");
                main_category.addClass("category");
                main_category.appendTo(category_element);
                category_element.append("Default");
                category_element.appendTo(category_list);
            /////////////////////////////////

            for(var row in category_distribution){
                var category_element=$("<li>");
                var main_category=$("<input>");
                main_category.attr("type","radio");
                main_category.attr("value",category_distribution[row]["category"]+"%");// % will help in like sql statement
                main_category.attr("name","category");
                main_category.addClass("category");
                main_category.appendTo(category_element);
                category_element.append(category_distribution[row]["category"]+"("+category_distribution[row]["count"]+")");
                if(category_distribution[row]["sub_category"]!=null){
                    var sub_category_list=$("<ul>");
                    ////////////////Default sub category
                        var sub_category_li=$("<li>");
                        var sub_category_element=$("<input>");
                        sub_category_element.attr("type","radio");
                        sub_category_element.attr("value",category_distribution[row]["category"]+"%");
                        sub_category_element.attr("name",category_distribution[row]["category"]);
                        sub_category_element.addClass("category");
                        sub_category_element.appendTo(sub_category_li);
                        sub_category_li.append("Default");
                        sub_category_li.appendTo(sub_category_list);
                    //////////////////////////////////
                    
                    for(var i in category_distribution[row]["sub_category"]){
                        var sub_category_li=$("<li>");
                        var sub_category_element=$("<input>");
                        sub_category_element.attr("type","radio");
                        sub_category_element.attr("value",category_distribution[row]["category"]+":"+category_distribution[row]["sub_category"][i]["sub_category_name"]);
                        sub_category_element.attr("name",category_distribution[row]["category"]);
                        sub_category_element.addClass("category");
                        sub_category_element.appendTo(sub_category_li);
                        sub_category_li.append(category_distribution[row]["sub_category"][i]["sub_category_name"]+"("+category_distribution[row]["sub_category"][i]["count"]+")");
                        sub_category_li.appendTo(sub_category_list);
                    }
                    sub_category_list.appendTo(category_element);
                }
                category_element.appendTo(category_list);
            }
            //Default type destribuiton
                var type_element_li=$("<li>");
                var type_element=$("<input>");
                type_element.attr("type","radio");
                type_element.attr("name","type");
                type_element.addClass("type");
                type_element.attr("value","");
                type_element.appendTo(type_element_li);
                type_element_li.append("Default");
                type_element_li.appendTo(type_list);

            ///////////////////////////////////
            for(var type_name in type_distribution){
                var type_element_li=$("<li>");
                var type_element=$("<input>");
                type_element.attr("type","radio");
                type_element.attr("name","type");
                type_element.addClass("type");
                type_element.attr("value",type_name);
                type_element.appendTo(type_element_li);
                type_element_li.append(type_name+"("+type_distribution[type_name]+")");
                type_element_li.appendTo(type_list);
            }
                //default cost
                var cost_element_li=$("<li>");
                var cost_element=$("<input>");
                cost_element.attr("type","radio");
                cost_element.attr("name","cost");
                cost_element.addClass("cost");
                cost_element.attr("value","");
                cost_element.appendTo(cost_element_li);
                cost_element_li.append("Default");
                cost_element_li.appendTo(cost_list);
            ////////////////////////////////////////

            var previous_cost=0;
            for(var row in cost_distribution){
                var cost_element_li=$("<li>");
                var cost_element=$("<input>");
                cost_element.attr("type","radio");
                cost_element.attr("name","cost");
                cost_element.addClass("cost");
                cost_element.attr("value",cost_distribution[row]["less_than"]+":"+previous_cost);
                cost_element.appendTo(cost_element_li);
                cost_element_li.append(">="+previous_cost+" , < "+cost_distribution[row]["less_than"]+"("+cost_distribution[row]["count"]+")");
                cost_element_li.appendTo(cost_list);
                previous_cost=cost_distribution[row]["less_than"];
            }
            category_list.appendTo(category);
            type_list.appendTo(type);
            cost_list.appendTo(cost);
            category.appendTo(filter_list);
            type.appendTo(filter_list);
            cost.appendTo(filter_list);
        },
        /*As of jQuery 1.5, the $.ajax() method returns the jqXHR object, which is a superset of the XMLHTTPRequest object.
        error:  Function( jqXHR jqXHR, String textStatus, String errorThrown )
        */
        error: function (request, status, error) {
            if(request.readyState==4){// 4 means complete
                if(request.status!=200){
                    alert(ajaxOptions);
                    alert(xhr.status);
                    alert(thrownError);        
                }else{
                    var filter_list=document.getElementById("filter_list");
                    filter_list.append("<li>No filters</li>")
                }    
            }
        }
    });   
}


function load_promotions(search_term){
    $.ajax({
        url: "promotions.php",
        dataType: "json",
        type: "POST",
        data: { search_term : search_term },
        success: function(response_data){
            // as we have written datatype as json so jquery automatically converts the result 
            //from json... so responce_data is not json its already parsed
            var promotion_list=document.getElementById("promotions");
            for (var row in response_data){
                var promotion_element=$("<li>");
                var element_div=$("<div>");
                element_div.css("padding","5px");
                element_div.addClass("container");
                var pic_box=$("<img>");
                pic_box.addClass("img-thumbnail");
                pic_box.css("align","center");
                pic_box.css("width","120px");
                pic_box.css("height","150px");
                pic_box.attr("src",response_data[row]["pic_loc"]);
                pic_box.appendTo(element_div);
                element_div.append("<br><a href='"+response_data[row]["type"]+".php?item_id="+response_data[row]["item_id"]+"'>"+response_data[row]["item_nm"]+"<a>");
                element_div.append("<br> Cost: "+response_data[row]["cost"]);
                element_div.append("<br> Type: "+response_data[row]["type"]);
                element_div.addClass("img-thumbnail");
                element_div.appendTo(promotion_element);
                element_div.css("align","center");
                promotion_element.appendTo(promotion_list);
            }
        },
        /*As of jQuery 1.5, the $.ajax() method returns the jqXHR object, which is a superset of the XMLHTTPRequest object.
        error:  Function( jqXHR jqXHR, String textStatus, String errorThrown )
        */
        error: function (request, status, error) {
            if(request.readyState==4){// 4 means complete
                if(request.status!=200){
                    alert(ajaxOptions);
                    alert(xhr.status);
                    alert(thrownError);        
                }else{
                    var promotion_list=document.getElementById("promotions");
                    var element=$("<li>");
                    element.text("No search results");
                    element.appendTo(item_list);
                }    
            }
        }
    });
}