<!-- Baris Overview Content -->
<div class="row">

    <div class="table-responsive table-striped table-hover">

        <table class="table noto-sans-font text-brown">
        
            <tr>
            
                <th class="pl-5">Dashboard</th>
                <th class="text-center"><a class="custom-color" href="#">Today</a></th>
                <th class="text-center"><a class="custom-color" href="#">This Week</a></th>
                <th class="text-center"><a class="custom-color" href="#">This Month</a></th>
            
            </tr>
    
            <tr>
            
                <th class="p-5">Overview</th>
                <td class="text-center p-5">Jumlah User Terdaftar    <span>+5</span></td>
                <td class="text-center p-5">Jumlah Produk Saat ini   <span>+5</span></td>
                <td class="text-center p-5">Jumlah Pembelian Hari ini<span>+5</span>   </td>
            
            </tr>
        
        </table>
        
    </div>

</div>

<!-- baris Content Menu  -->
<div class="row">


    <div class="col-md-6 col-6">

        <!-- chart Bar Untuk User yang terdaftar -->
        <div style="width:500px; margin:0px auto;"> 

            <canvas id="myChartUser"></canvas>

        </div>

    </div>

    <div class="col-md-6 col-6">

        <!-- chart pie untuk Jumlah Produk Saat Ini -->
        <div style="width:500px; margin:0px auto;"> 

            <canvas id="myChartProduk"></canvas>

        </div>

    </div>


</div>
<script>

    // data Chart untuk User
    var ctxUser = document.getElementById("myChartUser").getContext("2d");
    var myChartUser = new Chart(ctxUser,{
        type:"bar",
        data:{
            labels:['user terdaftar'],
            datasets:[{

                label: 'user terdaftar',
                data:['5'],
                backgroundColor:['#6C63FF'],
                borderColor:['#b85a3c'],
                borderWidth:1

            }],
        },
        option:{
            scales:{
                yaxes:[{
                    ticks:{
                        beginAtZero:true
                    }
                }]
            }
        }
    });

    var ctxProduk = document.getElementById('myChartProduk').getContext("2d");

    var myChartProduk  = new Chart(ctxProduk,{
        type:"pie",
        data:{
            labels:['Robusta','Arabica'],
            datasets:[{

                label:'# Jumlah produk',
                data:[1,2],
                backgroundColor:['#6C63FF','#b85a3c'],
                borderColor:['#b85a3c','#6C63FF'],
                borderWidth:1

            }]
        },
        option:{
            scales:{
                yaxes:{
                    ticks:{
                        beginAtZero:true
                    }
                }
            }
        }
    });

</script>