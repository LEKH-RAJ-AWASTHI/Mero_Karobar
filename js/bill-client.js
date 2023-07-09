function loadClient(){
   fetch('../forms/bill_client.php')
   .then((response)=>response.json())
   .then((data)=>{
       var client_input=document.getElementById('client');
       if(data['empty'])
       {
           document.getElementById("client").disabled = true;
           client_input.innerHTML=`<option selected>No Client Found</option>`;
        }
        else
        {
        var clients=`<option selected>Select Client</option>`;

        client_input.setAttribute('onchange','selectPAN()');
        for(var i in data)
        {
            clients+=`<option value="${data[i].client_id}">${data[i].name}   ${data[i].phone_number}</option>`
        }
        client_input.innerHTML=clients;
    }
   })
   .catch((error)=>{
    show_message('error',error);
    })
}
function selectPAN() {
    var selectedClient = document.getElementById("client").value;
    fetch('../forms/bill_client.php')
    .then((response)=>response.json())
    .then((data)=>{
        var pan_input_field=document.getElementById("pan_number");
        pan_input_field.disabled=true;
        if(data['empty'])
        {
            document.getElementById("panNumDiv").style.display = "none";
        }
        else
        {
            for(var i in data)
            {
                if(selectedClient==data[i].client_id)
                {
                    pan_input_field.value= data[i].pan_number;
                    break;
                }
                else{
                    document.getElementById('error-message').innerHTML=`cant find the match`;
                }
            }
        }
    })
    .catch((error)=>{
        show_message('error',error);
    })

}
loadClient();

function show_message(type, text)
{
    if(type=='error')
        var message_box= document.getElementById('error-message');
    else
        var message_box= document.getElementById('success-message');
    
    message_box.innerHTML=text;
    message_box.style.display="block";
    setTimeout(() => {
        message_box.style.display="none";
    }, 100000);
}