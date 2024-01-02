 /* Task 1 */
 function getFile() {
     let f = document.querySelector('#f');
     let progressAnimation = document.querySelector('.upload-progress');
     let progressBar = document.querySelector('.upload-progress progress');
     let uploadForm = new FormData();
     uploadForm.append("file", f.files[0]);
     let url = "./upload.php";
     let xhr = new XMLHttpRequest();
     xhr.open('POST', url, true);
     let total = 0;
     let fileContent = document.querySelector('.file-content');
     let divideSymbol = document.querySelector('.divide-input input');
     uploadForm.append("symbol", divideSymbol.value.trim());
     // xhr.setRequestHeader('Content-type', 'multipart/form-data');//'application/json; charset=UTF-8'
     xhr.upload.onprogress = (evt) => {
         total = evt.loaded / evt.total * 100;
         progressBar.value = total;
         progressAnimation.style.background = `radial-gradient(closest-side, white 79%, transparent 80% 100%),conic-gradient(darkgreen ${total}%, pink 0deg)`;
     };
     xhr.responseType = "json";
     xhr.onreadystatechange = function() {
         if (xhr.readyState === 4 && xhr.status === 200) {
             let response = xhr.response;
             if (response.success) {
                 let time1 = setTimeout(() => {
                     clearTimeout(time1);
                     alert("File upload Successfully!");
                 }, 500);
                 if (response.array) {
                     let digitCount = 0;
                     fileContent.innerHTML = "";
                     response.array.forEach((item) => {
                         digitCount = (Object.values(item)[0].match(/\d/g) || []).length;
                         fileContent.innerHTML += `Letters count ${Object.keys(item)[0]} and digits count ${digitCount} in string : ${Object.values(item)[0]}` + '<br>';
                     });
                 }
             } else {
                 progressAnimation.style.background = `radial-gradient(closest-side, white 79%, transparent 80% 100%),conic-gradient(darkred ${total}%, pink 0deg)`;
                 if (response.errors) {
                     let time2 = setTimeout(() => {
                         clearTimeout(time2);
                         alert(xhr.response.errors.message.toString());
                     }, 500);
                 }
             }
         }
     };
     if (f.files.length)
         xhr.send(uploadForm);
 }

 /*Task 2*/
 function toggleNodes() {
     let elementsWithText = Array.from(document.querySelectorAll('*')).filter((elem) => elem.getAttribute('name') !== null &&
         (elem.getAttribute('name').includes('button_') ||
             elem.getAttribute('name').includes('input_')) &&
         elem.getAttribute('name').match(/\d/g));

     let selectNode = document.querySelector("select[name='type_val']");
     let selectedItem = 1;
     elementsWithText.forEach((item) => {
         let elem_value = item.getAttribute('name').split('_')[1];
         if (selectedItem === elem_value)
             item.parentNode.style.display = "inline-block";
         else
             item.parentNode.style.display = "none";
     });
     selectNode.addEventListener('change', (evt) => {
         selectedItem = evt.target.value;
         elementsWithText.forEach((item) => {
             let elem_value = item.getAttribute('name').split('_')[1];
             if (selectedItem === elem_value)
                 item.parentNode.style.display = "inline-block";
             else
                 item.parentNode.style.display = "none";
         });
     });
 }
 toggleNodes();

 /*Test 3*/
 alert('Please enable the geolocation from popup after this alert message');
 let ip = '';
 if(document.querySelector('.task3_link'))
    ip = document.querySelector('.task3_link').dataset.ip;

  if ("geolocation" in navigator) {
         navigator.geolocation.getCurrentPosition(
             (position) => {
                const userLatitude = position.coords.latitude;
                const userLongitude = position.coords.longitude;
                 // Geolocation is enabled
                 console.log("Geolocation is enabled");
                 fetch(`https://us1.locationiq.com/v1/reverse.php?key=pk.3582f16784040682120ba48c6fc58c32&lat=${userLatitude}&lon=${userLongitude}&format=json`) //https://extreme-ip-lookup.com/json/
                     .then(response => response.json())
                     .then(async (data) => {
                         // const ipAddress = ip;
                         const city = await data.address.city;
                         const visitorTime = new Date().toLocaleString();
                         console.log(ip);
                         const userAgent = navigator.userAgent;
                         // console.log(userAgent);
                         const device = userAgent.match(/Windows|Linux|Mac|Mobi|Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i)[0]
                         const userData = {
                             ip,
                             city,
                             visitorTime,
                             device
                         };


                         fetch('visitors.php', {
                                 method: "POST",
                                 headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json'
                                    // 'Content-Type': 'application/x-www-form-urlencoded'
                                 },
                                 redirect: 'follow',
                                 mode: "same-origin",
                                 cache: 'no-cache',
                                 credentials: "same-origin",

                                 body: JSON.stringify({
                                    userData
                                 })
                             }).then(response => response.json())
                             .then(res => {
                                 console.log(JSON.stringify(res));
                             })
                             .catch(err => {
                                 console.log('Error retrieving user data:', err);
                             })
                     })
                     .catch(error => {
                         console.log('Error retrieving user data:', error);
                     });
             },
             function(error) {
                 // Geolocation is disabled or blocked by the user
                 console.log("Geolocation is disabled or blocked by the user");
             }
         );
     } else {
         // Geolocation is not supported
         console.log("Geolocation is not supported by this browser");
     }