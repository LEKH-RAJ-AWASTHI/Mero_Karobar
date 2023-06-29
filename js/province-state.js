var districtsByState = {
    Koshi: ["Morang", "Sunsari", "Dhankuta", "Sankhuwasabha", "Bhojpur", "Terhathum", "Okhaldhunga", "Khotang", "Solukhumbu", "Udayapur"],
    Madhesh: ["Saptari", "Siraha", "Dhanusha", "Mahottari", "Sarlahi", "Bara", "Parsa", "Rautahat"],
    Bagmati: ["Sindhuli", "Ramechhap", "Dolakha", "Sindhupalchok", "Kavrepalanchok", "Lalitpur", "Bhaktapur", "Kathmandu", "Nuwakot", "Rasuwa", "Dhading", "Makwanpur", "Chitwan"],
    Gandaki: ["Gorkha", "Manang", "Mustang", "Parbat", "Baglung", "Gulmi", "Palpa", "Nawalpur", "Syangja", "Tanahun", "Lamjung"],
    Lumbini: ["Arghakhanchi", "Kapilvastu", "Parasi", "Rupandehi", "Gulmi", "Palpa", "Nawalpur", "Syangja", "Tanahun", "Lamjung"],
    Karnali: ["Dolpa", "Humla", "Jumla", "Kalikot", "Mugu", "Banke", "Bardiya", "Dailekh", "Jajarkot", "Surkhet", "Salyan", "Rukum", "Rolpa"],
    Sudurpaschim: ["Achham", "Baitadi", "Bajhang", "Bajura", "Dadeldhura", "Darchula", "Doti", "Kailali", "Kanchanpur"]
      // Add more districts for each state here
  };

  // Function to populate the district select options based on the selected state
  function populateDistricts() {
      var stateSelect = document.getElementById("state");
      var districtSelect = document.getElementById("districts");
      var selectedState = stateSelect.value;

      // Clear previous district options
      districtSelect.innerHTML = "<option value=''>Select a district</option>";

      // Populate district options based on the selected state
      if (selectedState) {
          var districts = districtsByState[selectedState];
          for (var i = 0; i < districts.length; i++) {
              var option = document.createElement("option");
              option.value = districts[i];
              option.textContent = districts[i];
              districtSelect.appendChild(option);
          }
      }

  }