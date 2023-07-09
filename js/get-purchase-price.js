function loadProduct(){
    fetch('../forms/get_price.php')
    .then((response)=>response.json())
    .then((data)=>{
        var product_input=document.getElementById('product');
        if(data['empty'])
        {
            document.getElementById("product").disabled = true;
            product_input.innerHTML=`<option selected>No Product Found</option>`;
         }
         else
         {
         var products=`<option selected>Select Product</option>`;
 
         product_input.setAttribute('onchange','select_Purchase_Price()');
         for(var i in data)
         {
             products+=`<option value="${data[i].product_id}"> ${data[i].product_name}</option>`
         }
         product_input.innerHTML=products;
     }
    })
    .catch((error)=>{
     show_message('error',error);
     })
 }
 function select_Purchase_Price() {
     var selectedProduct = document.getElementById("product").value;
     fetch('../forms/get_price.php')
     .then((response)=>response.json())
     .then((data)=>{
         var rate_input_field=document.getElementById("rate");
         rate_input_field.disabled=false;
         if(data['empty'])
         {
             document.getElementById("rate").value = 0;
         }
         else
         {
             for(var i in data)
             {
                 if(selectedProduct==data[i].product_id)
                 {
                     rate_input_field.value= data[i].purchase_price;
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
 loadProduct();
 
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
     }, 300000);
 }