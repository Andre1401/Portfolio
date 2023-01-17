<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Cetak Barcode</title>

	<style type="text/css">
		.text-center {
			text-align: center;
		}
	</style>
</head>
<body>
	<table width="100%">
		<tr>
			@foreach ($dataProduk as $produk)
				<td class="text-center" style="border: 1px solid #333;">
					<p>{{ $produk->nama_produk }} ~ Rp. {{ format_uang($produk->harga_jual) }}</p>
					<img src="data:image/png;base64,{{ DNS1D::getBarcodePNG("$produk->kode_produk", 'C39') }}" alt="" width="180" height="60"/>
					<br>
					{{ $produk->kode_produk }}
				</td>
			@endforeach
			if ($no++ % 3 == 0)
				</tr><tr>
			endif
		</tr>
	</table>
</body>
</html>