function setType(){
    type = document.getElementById('type').value;
    if(type == "black_box"){
        document.getElementById('blackbox').style.display="table";
        document.getElementById('color').style.display="none";
        document.getElementById('securitybox').style.display="none";
        document.getElementById('surprisebox').style.display="none";
    }
    else if(type == "security_box"){
        document.getElementById('securitybox').style.display="table";
         document.getElementById('color').style.display="block";
        document.getElementById('blackbox').style.display="none";
        document.getElementById('surprisebox').style.display="none";
    }
    else if(type == "surprise_box"){
        document.getElementById('surprisebox').style.display="table";
        document.getElementById('color').style.display="block";
        document.getElementById('blackbox').style.display="none";
        document.getElementById('securitybox').style.display="none";
        
    }
}

function loadShelfNumber(){
   dataString = "loadShelfNumber="+document.getElementById('shelvesSelect').value;
   var xhttp = new XMLHttpRequest();
   if(window.XMLHttpRequest){
         xhttp.open("POST","./controller/freeshelves_controller.php",true);
         xhttp.onreadystatechange = function(){
            if(xhttp.readyState==4){
             document.getElementById('shelfNumber').innerHTML = xhttp.responseText;
         }
       }
        xhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");      
        xhttp.send(dataString);
   }
}

function showTable(){
    document.getElementById('bbox_tb').style.display = "none";
    document.getElementById('sebox_tb').style.display = "none";
    document.getElementById('subox_tb').style.display = "none";
    document.getElementById("sebox_head").style.display = "none";
     document.getElementById("subox_head").style.display = "none";
      document.getElementById("bbox_head").style.display = "none";
    
    type = document.getElementById("typeSelect").value;
    switch(type){
        case 'blackbox':      
            document.getElementById('boxtype_header').innerHTML = "Black Boxes";
            document.getElementById('bbox_tb').style.display = "table";
            break;
        case 'securitybox':   
            document.getElementById('boxtype_header').innerHTML = "Security Boxes";
            document.getElementById('sebox_tb').style.display = "table";
            break;
        case 'surprisebox':
            document.getElementById('boxtype_header').innerHTML = "Surprise Boxes";
            document.getElementById('subox_tb').style.display = "table";
            break;
        default: 
            document.getElementById("sebox_head").style.display = "block";
            document.getElementById("bbox_head").style.display = "block";
            document.getElementById("subox_head").style.display = "block";
            document.getElementById('boxtype_header').innerHTML = "All Boxes";
            document.getElementById('bbox_tb').style.display = "table";
            document.getElementById('sebox_tb').style.display = "table";
            document.getElementById('subox_tb').style.display = "table";
    }
    resetAsideHeight();
}

function resetAsideHeight(){
    if(document.getElementById('section').clientHeight > document.getElementById('aside').clientHeight) document.getElementById('aside').style.height = (document.getElementById('section').clientHeight+1)+"px";
        else document.getElementById('section').style.height = (document.getElementById('aside').clientHeight-10)+"px";
}