const flashdata = $('.flash-data').data('flashdata');
console.log(flashdata);
if (flashdata) {
	Swal.fire({
		title: 'Berhasil ',
		text:  flashdata + ' berhasil',
		icon: 'success'
	})
} 

const flashdata1 = $('.flash-data').data('flash');
console.log(flashdata1);
if (flashdata1) {
	Swal.fire({
		title: 'Gagal ',
		text: flashdata1 + ' gagal',
		icon: 'error'
	})
} 

// tombol hapus
$('.tombolHapus').on('click', function(e) {

	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
	  title: 'Apakah Anda Yakin?',
	  text: "data akan dihapus",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#d33',
	  cancelButtonColor: '#3085d6',
	  confirmButtonText: 'Hapus Data!'
	}).then((result) => {
	  if (result.value) {
	     	document.location.href = href;
	  } else if (result.dismiss === Swal.DismissReason.cancel) {
	  	Swal.fire(
	  	  'Terbatalkan',
	      'data aman :)',
	      'error'
	  	)
	  }	
	})

});

// tombol hapus
$('.tombolHapusGuru').on('click', function(e) {

	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
	  title: 'Apakah Anda Yakin?',
	  text: "Hapus terlebih dahulu guru ini apabila ada di tabel wali kelas",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#d33',
	  cancelButtonColor: '#3085d6',
	  confirmButtonText: 'Hapus Data!'
	}).then((result) => {
	  if (result.value) {
	     	document.location.href = href;
	  } else if (result.dismiss === Swal.DismissReason.cancel) {
	  	Swal.fire(
	  	  'Terbatalkan',
	      'data aman :)',
	      'error'
	  	)
	  }	
	})

});

// tombol hapus
$('.tombolHapusSiswa').on('click', function(e) {

	e.preventDefault();
	const href = $(this).attr('href');

	Swal.fire({
	  title: 'Apakah Anda Yakin?',
	  text: "Apabila data siswa dihapus maka tagihan ikut terhapus",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#d33',
	  cancelButtonColor: '#3085d6',
	  confirmButtonText: 'Hapus Data!'
	}).then((result) => {
	  if (result.value) {
	     	document.location.href = href;
	  } else if (result.dismiss === Swal.DismissReason.cancel) {
	  	Swal.fire(
	  	  'Terbatalkan',
	      'data aman :)',
	      'error'
	  	)
	  }	
	})

});
