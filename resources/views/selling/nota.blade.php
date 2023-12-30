@php
date_default_timezone_set('Asia/Jakarta');

function dateIndo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}    
@endphp

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Nota</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
            crossorigin="anonymous"
        />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter&display=swap"
            rel="stylesheet"
        />
    </head>
    <body style="font-family: Inter, sans-serif">
			
            <div id="customer" class="mt-3">
                <div class="row">
                    <div class="col-8">
                        <table style="font-size: 16px">
                            <tr>
                                <td rowspan="3" style="padding: 8px;">
                                    <img src="{{ asset('gambar/logo-kuning.jpg') }}" style="width: 100px;" alt="">
                                </td>
                                <th><h2>IMTSEL</h2></th>
                            </tr>
                            <tr>
                                <td>Ciputat, Tangerang Selatan</td>
                            </tr>
                            <tr>
                                <td>081211405279</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-4">
                        <table style="font-size: 16px">
                            <tbody>
                                <tr>
                                    <th>Tanggal : {{dateIndo($sales->sales_date)}}</th>
                                </tr>
                                <tr style="padding-top: 10px;">
                                    <th>&nbsp;</th>
                                </tr>
                                <tr>
                                    <td>Kepada Yth.</th>
                                </tr>
                                <tr>
                                    <td>{{$sales->customer_name}}</td>
                                </tr>
                                <tr>
                                    <td>{{$sales->customer_address}}</td>
                                </tr>
                                <tr>
                                    <td>{{$sales->customer_phone}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div id="data-transaksi" class="mt-3">
                <table style="font-size: 16px" width="100%">
                    <thead>
                        <tr style="border-top: 2px solid black; border-bottom: 2px solid black;">
                            <th style="padding-top: 10px; padding-bottom: 10px">
                                NO
                            </th>
                            <th style="padding-top: 10px; padding-bottom: 10px">
                                BANYAKNYA
                            </th>
                            <th style="padding-top: 10px; padding-bottom: 10px">
                                NAMA ITEM
                            </th>
                            <th style="padding-top: 10px; padding-bottom: 10px">
                                HARGA
                            </th>
                            <th style="padding-top: 10px; padding-bottom: 10px">
                                JUMLAH
                            </th>
                        </tr>
                    </thead>
                    <tbody style="border-bottom: 2px solid black">
                        @php
                            $no = 1;
                        @endphp
                        @foreach($salesDetail as $item)
                            @if ($item->id_sales == $sales->id_sales)
                                <tr class="align-middle">
                                    <td style="padding-top: 5px;">
                                        {{$no++}}
                                    </td>
                                    <td class="">
                                        {{$item->quantity_sales}} pcs
                                    </td>
                                    <td class="">
                                        {{$item->product_name}}
                                    </td>
                                    <td class="">
                                        {{number_format($item->sell_price_sales)}}
                                    </td>
                                    <td class="">
                                        {{number_format($item->total_price)}}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <td colspan="5" class="text-center">[ Printed by e-Nota ]</td>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th style="padding-top: 10px" class="text-end">Total QTY : </th>
                            <th style="padding-top: 10px">{{$sales->total_qty}}</th>
                            <th></th>
                            <th style="padding-top: 10px" class="text-end">TOTAL</th>
                            <th style="padding-top: 10px; width: 100px;" class="text-end">
                                <span class="float-end">{{ number_format($sales->total_amount) }}</span>
                            </th>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th class="text-end" style="padding-top: 10px">BAYAR</th>
                            <th class="text-end" style="padding-top: 10px">
                                <span class="float-end">{{ number_format($sales->total_pay) }}</span>
                            </th>
                        </tr>
                        <tr>
                            <th style="padding-top: 10px" class="text-end">Catatan : </th>
                            <td style="padding-top: 10px">{{$sales->notes}}</td>
                            <th></th>
                            <th class="text-end" style="padding-top: 10px">SISA</th>
                            <th class="text-end" style="padding-top: 10px">
                                <span class="float-end">{{ number_format($sales->remaining_amount) }}</span>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="row" style="padding-top: 30px;">
                <div class="col-12 text-center">
                    <table style="font-size: 16px" width="100%">
                        <tr>
                            <td>Tanda Terima</td>
                            <td></td>
                            <td>Hormat Kami</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                *** Thank You ***<br>
                                {{date('d/m/Y H:i:s')}}
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
            crossorigin="anonymous"
        ></script>
        <script>
            window.print();
        </script>
    </body>
</html>
