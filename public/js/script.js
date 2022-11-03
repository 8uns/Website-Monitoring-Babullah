// var BASEURL = "http://localhost/upbumonitoring/public/";
// var BASEURL = "https://simpelbabullah.online/";

const http = window.location.origin;
let pathArray = window.location.pathname.split("/");
const path = pathArray[1] + "/" + pathArray[2];
const BASEURL = http + "/" + path + "/";


// $.ajax({
//     url: BASEURL + 'dashboard/getDurk',

//     method: 'post',
//     dataType: 'json',
//     success: function (data) {
//         $('#totaldurk').append(data.ttl);
//     }
// });

// $.ajax({
//     url: BASEURL + 'dashboard/getDurkKel',

//     method: 'post',
//     dataType: 'json',
//     success: function (data) {
//         $('#totaldurkkel').append(data.ttl);
//     }
// });

// $.ajax({
//     url: BASEURL + 'dashboard/getAlamat',

//     method: 'post',
//     dataType: 'json',
//     success: function (data) {
//         $('#totalkel').append(data.jml_alamat);
//     }
// });

// $.ajax({
//     url: BASEURL + 'dashboard/getPengguna',

//     method: 'post',
//     dataType: 'json',
//     success: function (data) {
//         $('#totalpengguna').append(data.jml_pengguna);
//     }
// });



// // $.ajax({
// //     url: BASEURL + 'dashboard/getDurkRek',
// //     method: 'post',
// //     dataType: 'json',
// //     success: function (dataRek) {

// // chart 1
// // console.log(dataRek)
// // const ctx = document.getElementById('myChart').getContext('2d');    
// const ctx = document.getElementById('myChart').getContext('2d');

// const myChart = new Chart(ctx, {
//     type: 'line',
//     data: {
//         labels: ['Januari', 'Fehruari', 'Maret', 'April'],
//         datasets: [{
//             label: '# of Votes',
//             data: [12, 19, 3, 5, 2, 3],
//             // backgroundColor: [
//             //     'rgba(255, 99, 132, 0.2)',
//             //     'rgba(54, 162, 235, 0.2)',
//             //     'rgba(255, 206, 86, 0.2)',
//             //     'rgba(75, 192, 192, 0.2)'

//             // ],
//             borderColor: [
//                 'rgb(75, 192, 192)'

//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });


// const ctx122 = document.getElementById('myChart122').getContext('2d');

// const myChart122 = new Chart(ctx122, {
//     type: 'line',
//     data: {
//         labels: ['Januari', 'Fehruari', 'Maret', 'April'],
//         datasets: [{
//             label: '# of Votes',
//             data: [12, 19, 3, 5, 2, 3],
//             // backgroundColor: [
//             //     'rgba(255, 99, 132, 0.2)',
//             //     'rgba(54, 162, 235, 0.2)',
//             //     'rgba(255, 206, 86, 0.2)',
//             //     'rgba(75, 192, 192, 0.2)'

//             // ],
//             borderColor: [
//                 'rgb(75, 192, 192)'

//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         scales: {
//             y: {
//                 beginAtZero: true
//             }
//         }
//     }
// });

// //     }
// // });

// $.ajax({
//     url: BASEURL + 'dashboard/getDurkApp',
//     method: 'post',
//     dataType: 'json',
//     success: function (dataRek) {

//         //  chart 2
//         const ctxc = document.getElementById('myChart12').getContext('2d');
//         const data12 = {
//             labels: [
//                 'Approved',
//                 'Dibatalkan',
//                 'Menunggu Approve',
//                 'Belum diverifikasi'
//             ],
//             datasets: [{
//                 label: 'My First Dataset',
//                 data: [dataRek.rek.ttl, dataRek.bat.ttl, dataRek.men.ttl, dataRek.bel.ttl],
//                 backgroundColor: [
//                     'rgb(75, 192, 192)',
//                     'rgb(255, 99, 132)',
//                     'rgb(255, 205, 86)',
//                     'rgb(201, 203, 207)'
//                 ]
//             }]
//         };
//         const config12 = {
//             type: 'polarArea',
//             data: data12,
//             options: {}
//         };
//         const myChart12 = new Chart(
//             document.getElementById('myChart12'),
//             config12
//         );

//     }
// });








// $.ajax({
//     url: BASEURL + 'dashboard/getDurkRekKel',
//     method: 'post',
//     dataType: 'json',
//     success: function (dataRek) {

//         // chart 1
//         console.log(dataRek)
//         const ctx = document.getElementById('chartKel').getContext('2d');
//         const data = {
//             labels: [
//                 'Direkomendasikan',
//                 'Dibatalkan',
//                 'Menunggu Verifikasi',
//                 'Belum diverifikasi'
//             ],
//             datasets: [{
//                 label: 'My First Dataset',
//                 data: [dataRek.rek.ttl, dataRek.bat.ttl, dataRek.men.ttl, dataRek.bel.ttl],
//                 backgroundColor: [
//                     'rgb(75, 192, 192)',
//                     'rgb(255, 99, 132)',
//                     'rgb(255, 205, 86)',
//                     'rgb(201, 203, 207)'
//                 ],
//                 hoverOffset: 4
//             }]
//         };
//         const config = {
//             type: 'doughnut',
//             data: data,
//             options: {}
//         };
//         const chartKel = new Chart(
//             document.getElementById('chartKel'),
//             config
//         );

//     }
// });

// $.ajax({
//     url: BASEURL + 'dashboard/getDurkAppKel',
//     method: 'post',
//     dataType: 'json',
//     success: function (dataRek) {

//         //  chart 2
//         const ctxc = document.getElementById('chartKel12').getContext('2d');
//         const data12 = {
//             labels: [
//                 'Approved',
//                 'Dibatalkan',
//                 'Menunggu Approve',
//                 'Belum diverifikasi'
//             ],
//             datasets: [{
//                 label: 'My First Dataset',
//                 data: [dataRek.rek.ttl, dataRek.bat.ttl, dataRek.men.ttl, dataRek.bel.ttl],
//                 backgroundColor: [
//                     'rgb(75, 192, 192)',
//                     'rgb(255, 99, 132)',
//                     'rgb(255, 205, 86)',
//                     'rgb(201, 203, 207)'
//                 ]
//             }]
//         };
//         const config12 = {
//             type: 'polarArea',
//             data: data12,
//             options: {}
//         };
//         const chartKel12 = new Chart(
//             document.getElementById('chartKel12'),
//             config12
//         );

//     }
// });






function getItemTrans(button) {

    let modelItem = document.getElementById('modelItemTrans');
    let titleitem = document.getElementById('titleshowitem');

    let html = `
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col text-center fw-bold">
                                            Nama Produk
                                            </div>
                                            <div class="col text-center fw-bold">
                                              Harga Produk
                                            </div>
                                            <div class="col text-center fw-bold">
                                                Quantity
                                            </div>

                                        </div>
                                    </li>
    `;

    $.ajax({
        url: BASEURL + 'Dashboardupbu/getItamTransac/' + button.value,
        method: 'post',
        dataType: 'json',
        success: function (dataRek) {

            dataRek.forEach(element => {
                html += `
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col text-center">
                                                ${element.name}
                                            </div>
                                            <div class="col text-center">
                                               ${element.price}
                                            </div>
                                            <div class="col text-center">
                                                ${element.quantity}
                                            </div>
                                           
                                        </div>
                                    </li>
                `;

            });
            html += `
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col text-center fw-bold">
                                            Total
                                            </div>
                                            <div class="col text-center fw-bold">
                                             
                                            </div>
                                            <div class="col text-center fw-bold">
                                                ${button.attributes.totaltrans.value}
                                            </div>

                                        </div>
                                    </li>
            `;
            modelItem.innerHTML = html;
            titleitem.innerHTML = 'Data ' + button.value;

        }
    })
}