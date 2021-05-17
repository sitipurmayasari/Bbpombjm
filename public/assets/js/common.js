/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".delete", function(){
		var id = $(this).data("id"),
			controller = $(this).data("controller"),
			hitURL = baseURL +"admin/"+controller+ "/delete",
			currentRow = $(this);
		
		var confirmation = confirm("Apakah kamu yakin ingin menghapus data ini ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : id } 
			}).done(function(data){
				console.log(data);
				console.log(data.status);
				if(data.status == true) {
					currentRow.parents('tr').remove();
					alert("Data successfully terhapus");
				 }
				else if(data.status == false) {
					 alert("Data Tidak Bisa dihapus"); 
				}
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
