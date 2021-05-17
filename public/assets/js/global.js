function currency_to_num(str)
{
	if (str == '') return 0;
	str = str.replace(/\./g, '');
	return parseInt(str);
}


$().ready(function() {
	/*$('#example').DataTable( {
        "processing": true,
        "serverSide": true,
    } );*/
    $(".gp-search").on("change", function(event) { 
   		this.form.submit();
	});
	
	
	function check_required()
	{
		if ($(this).val() == '') $(this).closest('.form-group').addClass('has-error');
		else $(this).closest('.form-group').removeClass('has-error');
	}

	$('[type=text], [type=email], [type=password]').attr('autocomplete', 'off');

	autosize($('textarea[class*=autosize]'));

	$(document).one('ajaxloadstart.page', function(e) {
		autosize.destroy('textarea[class*=autosize]')
		
		$('.limiterBox,.autosizejs').remove();
		$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
	});

	// $('.datepicker').Zebra_DatePicker({ offset: [ -226, 303 ] });
	// $('.datepicker-month').Zebra_DatePicker({ view: 'months', format: 'Y-m', offset: [ -226, 303 ] });
	// $('.datepicker-year').Zebra_DatePicker({ view: 'years', format: 'Y', offset: [ -226, 303 ] });
	
	$('.required').blur(check_required);
	$('select.required').change(check_required);
	
	// $('select').not(".select").select2({ allowClear: true });
	// $('select').on('change', function() {
	// 	$(this).select2('open').select2('close');
	// });
	
	$('.number').autoNumeric('init', {
		aSep: '.', aDec: ',', aSign: '', mDec: '0'
	});
	
	$('.decimal').autoNumeric('init', {
		aSep: '.', aDec: ',', aSign: ''
	});
	
	$('.currency').autoNumeric('init', {
		aSep: '.', aDec: ',', aSign: 'Rp ', mDec: '0'
	});
	
	$('.percent').autoNumeric('init', {
		aSep: '.', aDec: ',', aSign: '%', pSign: 's'
	});

	// get flashdata, to display toastr alert
	var flash_data = $('#flashdata').val();

	if(flash_data != '' && flash_data != undefined){
		if( flash_data == 'insert'){
		toastr.success("Data Berhasil Disimpan");
		}else if (flash_data == 'update'){
			toastr.success("Data Berhasil Diubah");
		}else if (flash_data == 'delete'){
			toastr.success("Data Berhasil Dihapus");
		}else{
			toastr.info(flash_data);
		}
	}
	
	$('.validate-form').submit(function() {
		var has_error = false;
		$.each($('.required'), function(idx, obj) {
			if ($(obj).val() == '') {
				$(obj).closest('.form-group').addClass('has-error');
				has_error = true;
			}
		});

		if (has_error) {
			// swal('Mohon lengkapi form!');
			toastr.error("Mohon Lengkapi Form",{
            "timeOut": "0",
            "extendedTImeout": "0"
        	});
			$(this).find('.has-error .form-control').first().focus();
		}
		else {
			$(this).find('.form-control').attr('readonly', true);
			$(this).find('button[type=submit]').attr('disabled', true);
			$(this).find('button[type=submit]').text('Sedang menyimpan...');
		}
		
		return !has_error;
	});

	function check_row(obj)
	{
		var border;
		var color;
		
		if ($(obj).is(':checked')) {
			border = '#aca';
			if ($(obj).hasClass('odd')) color = '#bfefbf';
			if ($(obj).hasClass('even')) color = '#cfffcf';
		}
		else {
			border = '#ddd';
			if ($(obj).hasClass('odd')) color = '#f9f9f9';
			if ($(obj).hasClass('even')) color = '#fff';
		}
		
		$(obj).parent().parent().children().css({ 'border-top-color': border });
		$(obj).parent().parent().children().css({ 'background': color });
	}

	$('.check-all').click(function() {
		var is_checked = $(this).is(':checked');
		$('.checkbox').each(function() {
			$(this).prop('checked', is_checked);
			check_row(this);
		});
	});
	
	$('.checkbox').click(function() {
		check_row(this);

		jml_checked = $('.checkbox:checked').length;
		jmlall_checked = $('.checkbox').length;

		if(jml_checked == jmlall_checked){
        	$('.check-all').prop("checked", true);
		}else{
        	$('.check-all').attr("checked", false);
		}
	});
	
	$('.profile-tab a').click(function() {
		$('.profile-tab li.active').removeClass('active');
		$(this).parent().addClass('active');
	});
	
	$('#btn-delete').click(function() {
		var can_submit = false;
		$('.checkbox').each(function() {
			if ($(this).is(':checked')) can_submit = true;
		});
		
		if (can_submit) {
			swal ({
				title: 'Hapus Data!'
				, text: 'Apa Anda yakin untuk menghapus data?'
				, type: 'warning'
				, showCancelButton: true
				, confirmButtonClass: 'btn-danger'
				, confirmButtonText: 'Ya, hapus data!'
				, cancelButtonText: 'Tidak'
				, closeOnConfirm: false
				, closeOnCancel: true
			},
			function(is_confirmed) {
				if (is_confirmed) $('#form-grid').submit();
			});
		}
		else {
			// swal('Tidak ada data yang dihapus!');
			toastr.error("Tidak ada data yang dihapus",{
            "timeOut": "0",
            "extendedTImeout": "0"
        	});
			return false;
		}
	});

	$('[title=Hapus]').click(function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		
		swal ({
			title: 'Hapus Data!'
			, text: 'Apa Anda yakin untuk menghapus data tersebut?'
			, type: 'warning'
			, showCancelButton: true
			, confirmButtonClass: 'btn-danger'
			, confirmButtonText: 'Ya, hapus data!'
			, cancelButtonText: 'TIDAK'
			, closeOnConfirm: false
			, closeOnCancel: true
		},
		function(is_confirmed) {
			if (is_confirmed) {
				$('.sa-confirm-button-container button').attr('disabled', true);
				window.location = href;
			}
		});
	});
	
	$('[title=Status]').click(function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		
		swal ({
			title: 'Perubahan Status Data!'
			, text: 'Apa Anda yakin untuk mengubah data tersebut?'
			, type: 'warning'
			, showCancelButton: true
			, confirmButtonClass: 'btn-danger'
			, confirmButtonText: 'Ya, ubah data!'
			, cancelButtonText: 'TIDAK'
			, closeOnConfirm: false
			, closeOnCancel: true
		},
		function(is_confirmed) {
			if (is_confirmed) {
				$('.sa-confirm-button-container button').attr('disabled', true);
				window.location = href;
			}
		});
	});

	$('[title=Batalkan]').click(function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		
		swal ({
			title: 'Pembatalan Data!'
			, text: 'Apa Anda yakin untuk membatalkan data tersebut?'
			, type: 'warning'
			, showCancelButton: true
			, confirmButtonClass: 'btn-danger'
			, confirmButtonText: 'Ya, batalkan!'
			, cancelButtonText: 'TIDAK'
			, closeOnConfirm: false
			, closeOnCancel: true
		},
		function(is_confirmed) {
			if (is_confirmed) {
				$('.sa-confirm-button-container button').attr('disabled', true);
				window.location = href;
			}
		});
	});

	$('[title=Approve]').click(function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		
		swal ({
			title: 'Approval Data!'
			, text: 'Apa Anda yakin untuk meng-approve data tersebut?'
			, type: 'warning'
			, showCancelButton: true
			, confirmButtonClass: 'btn-danger'
			, confirmButtonText: 'Ya, approve data!'
			, cancelButtonText: 'TIDAK'
			, closeOnConfirm: false
			, closeOnCancel: true
		},
		function(is_confirmed) {
			if (is_confirmed) {
				$('.sa-confirm-button-container button').attr('disabled', true);
				window.location = href;
			}
		});
	});

	$('[title=Publish]').click(function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		
		swal ({
			title: 'Perubahan ke Publish!'
			, text: 'Apa Anda yakin untuk mengubah status postingan ke publish?'
			, type: 'warning'
			, showCancelButton: true
			, confirmButtonClass: 'btn-danger'
			, confirmButtonText: 'Ya, ubah status!'
			, cancelButtonText: 'TIDAK'
			, closeOnConfirm: false
			, closeOnCancel: true
		},
		function(is_confirmed) {
			if (is_confirmed) {
				$('.sa-confirm-button-container button').attr('disabled', true);
				window.location = href;
			}
		});
	});

	$('[title=Selesai]').click(function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		
		swal ({
			title: 'Pelaksanaan Selesai!'
			, text: 'Apa Anda yakin untuk menyelesaikan Pelaksanaan'
			, type: 'warning'
			, showCancelButton: true
			, confirmButtonClass: 'btn-danger'
			, confirmButtonText: 'Ya, selesaikan!'
			, cancelButtonText: 'TIDAK'
			, closeOnConfirm: false
			, closeOnCancel: true
		},
		function(is_confirmed) {
			if (is_confirmed) {
				$('.sa-confirm-button-container button').attr('disabled', true);
				window.location = href;
			}
		});
	});

	$('[title=Draf]').click(function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		
		swal ({
			title: 'Perubahan ke Draf!'
			, text: 'Apa Anda yakin untuk mengubah postingan ke draf?'
			, type: 'warning'
			, showCancelButton: true
			, confirmButtonClass: 'btn-danger'
			, confirmButtonText: 'Ya, ubah status!'
			, cancelButtonText: 'TIDAK'
			, closeOnConfirm: false
			, closeOnCancel: true
		},
		function(is_confirmed) {
			if (is_confirmed) {
				$('.sa-confirm-button-container button').attr('disabled', true);
				window.location = href;
			}
		});
	});

	$('[title=Restore]').click(function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		
		swal ({
			title: 'Restore Postingan!'
			, text: 'Apa Anda yakin untuk merestore postingan?'
			, type: 'warning'
			, showCancelButton: true
			, confirmButtonClass: 'btn-danger'
			, confirmButtonText: 'Ya, ubah status!'
			, cancelButtonText: 'TIDAK'
			, closeOnConfirm: false
			, closeOnCancel: true
		},
		function(is_confirmed) {
			if (is_confirmed) {
				$('.sa-confirm-button-container button').attr('disabled', true);
				window.location = href;
			}
		});
	});


	$('#id-input-file-1 , #id-input-file-2,.input_document').ace_file_input({
		no_file:'No File ...',
		btn_choose:'Choose',
		btn_change:'Change',
		droppable:false,
		onchange:null,
		thumbnail:true //| true | large
		//whitelist:'gif|png|jpg|jpeg'
		//blacklist:'exe|php'
		//onchange:''
		//
	});

	$('#input_file_image').ace_file_input({
		style: 'well',
		btn_choose: 'Drop images here or click to choose',
		btn_change: null,
		no_icon: 'ace-icon fa fa-picture-o";',
		droppable: true,
		thumbnail: 'large',//large | fit,
		allowExt: ["jpeg", "jpg", "png", "gif" , "bmp"],
		allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"]
		//,icon_remove:null//set null, to hide remove/reset button
		// ,before_change:function(files, dropped) {
		// 	var before_change;
		// 	var btn_choose;
		// 	var mb = Math.round(files[0].size/1024/1024);
		// 	if(parseInt(mb) < 3){
		// 		return true;
		// 	}else{
		// 		alert("Ukuran Image tidak lebih dari 3 Mb");
		// 		btn_choose = "Drop images here or click to choose";
		// 		no_icon = "ace-icon fa fa-picture-o";

		// 		var file_input = jQuery('#input_file_image');					
		// 			file_input.ace_file_input('update_settings', {'btn_choose': btn_choose, 'no_icon':no_icon});	

		// 		file_input.ace_file_input('reset_input');
		// 		return false;
		// 	}
		// }
		/**,before_remove : function() {
			return true;
		}*/
		,
		preview_error : function(filename, error_code) {
			//name of the file that failed
			//error_code values
			//1 = 'FILE_LOAD_FAILED',
			//2 = 'IMAGE_LOAD_FAILED',
			//3 = 'THUMBNAIL_FAILED'
			//alert(error_code);
		}

	}).on('change', function(){
		//console.log($(this).data('ace_input_files'));
		//console.log($(this).data('ace_input_method'));
	});

	$('#input_file_image2').ace_file_input({
		style: 'well',
		btn_choose: 'Drop images here or click to choose',
		btn_change: null,
		no_icon: 'ace-icon fa fa-picture-o";',
		droppable: true,
		thumbnail: 'large',//large | fit,
		allowExt: ["jpeg", "jpg", "png", "gif" , "bmp"],
		allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"]
		
		,
		preview_error : function(filename, error_code) {
			
		}

	}).on('change', function(){
		//console.log($(this).data('ace_input_files'));
		//console.log($(this).data('ace_input_method'));
	});

	$('#input_file_image3').ace_file_input({
		style: 'well',
		btn_choose: 'Tambahkan Foto Sampul',
		btn_change: null,
		no_icon: 'ace-icon fa fa-picture-o";',
		droppable: true,
		thumbnail: 'large',//large | fit,
		allowExt: ["jpeg", "jpg", "png", "gif" , "bmp"],
		allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"]
		
		,
		preview_error : function(filename, error_code) {
			
		}

	}).on('change', function(){
		//console.log($(this).data('ace_input_files'));
		//console.log($(this).data('ace_input_method'));
	});

	$('.input-daterange').datepicker({
		autoclose: true,
		format 	 : "yyyy-mm-dd"});

	$('.date-picker').datepicker({
			autoclose: true,
			todayHighlight: true,
		})
		//show datepicker when clicking on the icon
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
	});

	$('.date-picker-ym').datepicker({
			autoclose: true,
			todayHighlight: true,
			format: "yyyy-mm",
    		startView: "months", 
    		minViewMode: "months"
		})
		//show datepicker when clicking on the icon
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
	});

	$('.date-picker-y').datepicker({
			autoclose: true,
			todayHighlight: true,
			format: "yyyy",
    		startView: "years", 
    		minViewMode: "years"
		})
		//show datepicker when clicking on the icon
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
	});

	$('.datepicker-pick').datepicker({
			autoclose: true,
			format:"yyyy-mm",
			minViewMode: 1
		})
		//show datepicker when clicking on the icon
		.next().on(ace.click_event, function(){
			$(this).prev().focus();
	});


	$('.timepicker').timepicker({
		minuteStep: 1,
		showSeconds: false,
		showMeridian: false,
		disableFocus: true,
		icons: {
			up: 'fa fa-chevron-up',
			down: 'fa fa-chevron-down'
		}
	}).on('focus', function() {
		$('.timepicker').timepicker('showWidget');
	}).next().on(ace.click_event, function(){
		$(this).prev().focus();
	});

	$('.chosen-select').chosen({allow_single_deselect:true});

	// CKEDITOR.replace( 'editor' );

	// $('.form-group').find('.form-field-select-3').attr('onchange','this.form.submit()');
	// $('#form-field-select-3').attr('onchange','this.form.submit()');
	$(".date-gp").on("change" , function(event){
		this.form.submit();
	});
	
});

	
var enable_numeric = 1;

function numeric()
{

	if(enable_numeric == 0)
    {
        $(".numeric").off('keydown');
    }

	var keys = 0;
	$(".numeric").keydown(function(event) {
		keys = event.keyCode;
		// Allow: backspace, delete, tab, escape, and enter
        if (event.keyCode == 116 || event.keyCode == 46 || event.keyCode == 188 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39) || event.keyCode == 190 || event.keyCode == 110|| event.keyCode == 188) {
                 // let it happen, don't do anything
				return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });

}

function FormatCurrency(objNum)
    {	
        var num = objNum.value
        if(num==undefined)
            var num = objNum.val();
        var ent, dec;

        if (num != '' && num != objNum.oldvalue)
        {
            num = MoneyToNumber(num);
            if (isNaN(num))
            {		
                objNum.value = (objNum.oldvalue)?objNum.oldvalue:'';
            } else {
                var ev = (navigator.appName.indexOf('Netscape') != -1)?Event:event;
		
                if (ev.keyCode == 190 || !isNaN(num.split('.')[1]))
                {	
                    objNum.value = AddCommas(num.split('.')[0])+'.'+num.split('.')[1];
                }
                else
                {	
                    objNum.value = AddCommas(num.split('.')[0]);
                }
		
                objNum.oldvalue = objNum.value;
            }
        }
    }

function MoneyToNumber(num)
        {
            if(num != '' && num != null)
            {
                // return num.split(',').join('');
                return num.toString().replace(/,/g, '');
            }
            else
            {
                return parseInt(0);
            }
        }

function AddCommas(num)
        {
            numArr=new String(num).split('').reverse();
            for (i=3;i<numArr.length;i+=3)
            {
                numArr[i]+=',';
            }
            return numArr.reverse().join('');
        }

function cek_session(){
		var href = site_url;
		
		swal ({
			title: 'Session User Habis!'
			, text: 'Silahkan login kembali'
			, type: 'warning'
			, showCancelButton: false
			, confirmButtonClass: 'btn-danger'
			, confirmButtonText: 'Ya'
			, closeOnConfirm: false
			, closeOnCancel: true
		},
		function(is_confirmed) {
			if (is_confirmed) {
				$('.sa-confirm-button-container button').attr('disabled', true);
				window.location = href;
			}
		});
}

function get_month($date){
	$arr = $date.split("-");
	switch ($arr[1])
	{
		case '01'	: return "Januari";break;
		case '02'	: return "Februari";break;
		case '03'	: return "Maret";break;
		case '04'	: return "April";break;
		case '05'	: return "Mei";break;
		case '06'	: return "Juni";break;
		case '07'	: return "Juli";break;
		case '08'	: return "Agustus";break;
		case '09'	: return "September";break;
		case '10'	: return "Oktober";break;
		case '11'	: return "November";break;
		case '12'	: return "Desember";break;
	}
}

function tgl_indo(date){
	var arr = date.split("-");
	var bln = '';

	switch (arr[1])
	{
		case '01'	: bln="Januari";break;
		case '02'	: bln="Februari";break;
		case '03'	: bln="Maret";break;
		case '04'	: bln="April";break;
		case '05'	: bln="Mei";break;
		case '06'	: bln="Juni";break;
		case '07'	: bln="Juli";break;
		case '08'	: bln="Agustus";break;
		case '09'	: bln="September";break;
		case '10'	: bln="Oktober";break;
		case '11'	: bln="November";break;
		case '12'	: bln="Desember";break;
	}

	return arr[2]+" "+bln+" "+arr[0];
}

function jenis_program(per){
	var val = '';
	if(per == '1'){
		val = 'Sertifikasi';
	}
	else if(per == '2'){
		val = 'Training';
	}else if(per == '3'){
		val = 'Sertifikasi & Training';
	}else if(per == '4'){
		val = 'Program Terjadwal';
	}

	return val;
}

function status_verifikasi(per){
	var val = '';
	if(per == '1'){
		val = '<span class="label label-sm label-success arrowed">V E R I F I K A S I</span>';
	}else{
		val = '<span class="label label-sm label-danger arrowed">BELUM VERIFIKASI</span>';
	}

	return val;
}

function status_verifi_perpanjangan(per){
	switch (per) {
		case '0': return '<span class="label label-md label-warning">BELUM DIPROSES</span>';
		case '1': return '<span class="label label-md label-success">VERIFIKASI</span>';
		case '2': return '<span class="label label-md label-yellow">BELUM LENGKAP</span>';
		case '3': return '<span class="label label-md label-danger">D I T O L A K</span>';
	}
}

function hasil_sertifikasi(per){
	var val = '';
	if(per == '1'){
		val = '<span class="label label-sm label-success arrowed">L U L U S</span>';
	}else if(per == '3'){
		val = '<span class="label label-sm label-danger arrowed">TIDAK HADIR</span>';
	}else if(per == '2'){
		val = '<span class="label label-sm label-warning arrowed">TIDAK LULUS</span>';
	}else{
		val = '<span class="label label-sm label-grey arrowed">BELUM DINILAI</span>';
	}

	return val;
}

function adm_lengkap(per){
	var val = '';
	if(per == '1'){
		val = '<span class="label label-sm label-success arrowed">L E N G K A P</span>';
	}else{
		val = '<span class="label label-sm label-danger arrowed">BELUM LENGKAP</span>';
	}

	return val;
}

function chart_bar($data,$graph){

	$namay = [];
	$datagrfik = [];

	$.each($data.data, function(i, data){
		$namay.push(data.periode);
		$datagrfik.push(parseFloat(data.jumlah));
	});

	Highcharts.chart($graph, {
	  chart: {
		type: 'column'    
	  },
	  title: {
		text: null
	  },
	  subtitle: {
		text: null
	  },
	  xAxis: {
		categories: $namay,
		lineWidth: 2,
		title: {
		  text: null
		}
	  },
	  yAxis: {
		min: 0,
		title: {
		  text: '',
		  align: 'high'
		},
		labels: {
		  overflow: 'justify'
		}
	  },
	  tooltip: {
		valueSuffix: ''
	  },
	  plotOptions: {
		bar: {
		  dataLabels: {
			enabled: true
		  }
		}
	  },
	  legend: {
	  	enabled: false,
		layout: 'vertical',
		align: 'right',
		verticalAlign: 'top',
		x: -40,
		y: 80,
		floating: true,
		borderWidth: 1,
		backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
		shadow: true
	  },
	  credits: {
		enabled: false
	  },
	  series: [{
		showInLegend: false,
		name: '',
		data: $datagrfik
	  },],

	},function(chart){

		// console.log('end Loading');

	});
}

function chart_line($data,$graph){

	$namay = [];
	$datagrfik = [];

	$.each($data.data, function(i, data){
		$namay.push(data.periode);
		$datagrfik.push(parseFloat(data.penjualan));
	});

	Highcharts.chart($graph, {

		  title: {
		    text: null
		  },

		  subtitle: {
		    text: null
		  },

		  credits: {
		        enabled: false
		      },
		  legend: {
			      enabled: false,
			      align: 'right',
			      verticalAlign: 'middle'
			  },
		  xAxis: {
		categories: $namay,
		lineWidth: 2,
		title: {
		  text: null
		}
	  },
	  yAxis: {
		min: 0,
		title: {
		  text: '',
		  align: 'high'
		},
		labels: {
		  overflow: 'justify'
		}
	  },

		  plotOptions: {
		    series: {
		      label: {
		        connectorAllowed: false
		      },
		      pointStart: 2010
		    }
		  },

		  series: [{
		    showInLegend: false,
			name: '',
			data: $datagrfik
		  }],

		  responsive: {
		    rules: [{
		      condition: {
		        maxWidth: 500
		      },
		      chartOptions: {
		        legend: {
		          layout: 'horizontal',
		          align: 'center',
		          verticalAlign: 'bottom'
		        }
		      }
		    }]
		  }

		});
}

function chart_line_ads($data,$graph){

	$namay = [];
	$datagrfik = [];

	$.each($data.data, function(i, data){
		$namay.push(data.periode);
		$datagrfik.push(parseFloat(data.jumlah));
	});

	Highcharts.chart($graph, {

		  title: {
		    text: null
		  },

		  subtitle: {
		    text: null
		  },

		  credits: {
		        enabled: false
		      },
		  legend: {
			      enabled: false,
			      align: 'right',
			      verticalAlign: 'middle'
			  },
		  xAxis: {
		categories: $namay,
		lineWidth: 2,
		title: {
		  text: null
		}
	  },
	  yAxis: {
		min: 0,
		title: {
		  text: '',
		  align: 'high'
		},
		labels: {
		  overflow: 'justify'
		}
	  },

		  plotOptions: {
		    series: {
		      label: {
		        connectorAllowed: false
		      },
		      pointStart: 2010
		    }
		  },

		  series: [{
		    showInLegend: false,
			name: '',
			data: $datagrfik
		  }],

		  responsive: {
		    rules: [{
		      condition: {
		        maxWidth: 500
		      },
		      chartOptions: {
		        legend: {
		          layout: 'horizontal',
		          align: 'center',
		          verticalAlign: 'bottom'
		        }
		      }
		    }]
		  }

		});
}

function number_format(number, decimals, dec_point, thousands_sep) {
// Formats a number with grouped thousands

// *     example 1: number_format(1234,56);
// *     returns 1: '1.235'
// *     example 2: number_format(1234.56, 2, ',', ' ');
// *     returns 2: '1 234,56'
// *     example 3: number_format(1234.5678, 2, '.', '');
// *     returns 3: '1234.57'
// *     example 4: number_format(67, 2, ',', '.');
// *     returns 4: '67.00'
// *     example 5: number_format(1000);
// *     returns 5: '1.000'
// *     example 6: number_format(67,311, 2);
// *     returns 6: '67,31'
// *     example 7: number_format(1000,55, 1);
// *     returns 7: '1.000,6'
// *     example 8: number_format(67000, 5, ',', '.');
// *     returns 8: '67.000,00000'
// *     example 9: number_format(0,9, 0);
// *     returns 9: '1'
// *     example 10: number_format('1,20', 2);
// *     returns 10: '1,20'
// *     example 11: number_format('1,20', 4);
// *     returns 11: '1,2000'
// *     example 12: number_format('1,2000', 3);
// *     returns 12: '1,200'
	var n = number, prec = decimals;

	var toFixedFix = function (n,prec) {
		var k = Math.pow(10,prec);
		return (Math.round(n*k)/k).toString();
	};

	n = !isFinite(+n) ? 0 : +n;
	prec = !isFinite(+prec) ? 0 : Math.abs(prec);
	var sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep;
	var dec = (typeof dec_point === 'undefined') ? ',' : dec_point;

	var s = (prec > 0) ? toFixedFix(n, prec) : toFixedFix(Math.round(n), prec); //fix for IE parseFloat(0.55).toFixed(0) = 0;

	var abs = toFixedFix(Math.abs(n), prec);
	var _, i;

	if (abs >= 1000) {
		_ = abs.split(/\D/);
		i = _[0].length % 3 || 3;

		_[0] = s.slice(0,i + (n < 0)) +
			  _[0].slice(i).replace(/(\d{3})/g, sep+'$1');
		s = _.join(dec);
	} else {
		s = s.replace(',', dec);
	}

	var decPos = s.indexOf(dec);
	if (prec >= 1 && decPos !== -1 && (s.length-decPos-1) < prec) {
		s += new Array(prec-(s.length-decPos-1)).join(0)+'0';
	}
	else if (prec >= 1 && decPos === -1) {
		s += dec+new Array(prec).join(0)+'0';
	}

	if(number<0){
    	s="("+s.replace("-","")+")";
    }
	return s; 
}

function month_to_num_month(month)
{
	switch (month)
	{
		case 'Januari'	: return "01";break;
		case 'Februari'	: return "02";break;
		case 'Maret'	: return "03";break;
		case 'April'	: return "04";break;
		case 'Mei'	: return "05";break;
		case 'Juni'	: return "06";break;
		case 'Juli'	: return "07";break;
		case 'Agustus'	: return "08";break;
		case 'September'	: return "09";break;
		case 'Oktober'	: return "10";break;
		case 'November'	: return "11";break;
		case 'Desember'	: return "12";break;
	}
}

function num_to_month(month)
{
	switch (month)
	{
		case '01'	: return "Januari";break;
		case '02'	: return "Februari";break;
		case '03'	: return "Maret";break;
		case '04'	: return "April";break;
		case '05'	: return "Mei";break;
		case '06'	: return "Juni";break;
		case '07'	: return "Juli";break;
		case '08'	: return "Agustus";break;
		case '09'	: return "September";break;
		case '10'	: return "Oktober";break;
		case '11'	: return "November";break;
		case '12'	: return "Desember";break;
	}
}

function status_pelaksanaan(per){
	var val = '';
	if(per == '3'){
		val = '<span class="label label-sm label-success arrowed">SELESAI</span>';
	}else{
		val = '<span class="label label-sm label-danger arrowed">BATAL</span>';
	}

	return val;
}

function status_pelaksanaan__(per){
	var val = '';
	if(per == '3'){
		val = '<span class="label label-lg label-success label-white middle">SELESAI</span>';
	}else{
		val = '<span class="label label-lg label-danger label-white middle">BATAL</span>';
	}

	return val;
}

function status_pelaksanaan_jadwal(per){
	var val = '';
	if(per == '1'){
		val = '<span class="label label-lg label-success label-white middle">SELESAI</span>';
	}else{
		val = '<span class="label label-lg label-danger label-white middle">BELUM</span>';
	}

	return val;
}

function status_wow(per){
	var val = '';
	if(per == '1'){
		val = '<button class="btn btn-success " type="button">'+
					'<i class="ace-icon fa fa-check bigger-110"></i>Selesai'+
				'</button>';
	}else{
		val = '<button class="btn btn-danger " type="button">'+
					'<i class="ace-icon fa fa-close bigger-110"></i>Belum'+
				'</button>';
	}

	return val;
}