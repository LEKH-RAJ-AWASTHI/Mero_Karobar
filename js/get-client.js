function loadClient(){
    fetch('../forms/bill_client.php')
    .then((response)=>response.json())
    .then((data)=>{
        
        var client_input=document.getElementById('client');

        if(data['empty'])
        {
            // document.getElementById("client").disabled = true;
            client_input.innerHTML=`<option value="" style="color: red;">No Items found</option>`;
         }
         else
         {
           var clients=`<option selected value="">Client</option>`;
           for(var i in data)
           {
               clients+=`<option value="${data[i].client_id}">${data[i].name}   ${data[i].phone_number}</option>`;
           }
           client_input.innerHTML=clients;
         }
    })
    .catch((error)=>{
     show_message('error',error);
     })
 }
 
 loadClient();
 console.log("hello");
 
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