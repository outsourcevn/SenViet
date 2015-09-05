$(document).ready(function(){
	$('.item-checkbox').click(function(){
		if($('.item-checkbox').length == $('.item-checkbox:checked').length){
			$('#check_all').attr('checked', 'true');
		}else{
			$('#check_all').removeAttr('checked');
		}
	});
	
	$('#check_all').change(function(){
		if(!$('#check_all').attr('checked')){
			$('.item-checkbox:checked').removeAttr('checked');
		}
		else{
			$('.item-checkbox').attr('checked', 'checked');
		}
	});
	
	$('.show_items').click(function(){
        $('input[value=show]').click();
	});
	
	$('.delete_items').click(function(){
        if(confirm('Bạn có chắc muốn xóa các mục đã chọn không ?'))
            $('input[value=delete]').click();
	});
    
    $('.sort_items').click(function(){
        $('input[value=sort]').click();
	});
    
    
    //Chuyen Tab trong trang admin
    $('.tabs-menu-item a').click(function(){
        $('.tabs-menu-item.active').removeClass('active');
        $(this).parent().addClass('active');
        
        $('.tabs-item').addClass('hidden');
        
        $('div'+$(this).attr('rel')).removeClass('hidden');
        
        return false;
    });
    
    //DatePicker
     $( ".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd",
     });
});

function BrowseServer( startupPath, functionData )
{
	// You can use the "CKFinder" class to render CKFinder in a page:
	var finder = new CKFinder();

	// The path for the installation of CKFinder (default = "/ckfinder/").
	finder.basePath = 'http://senviet.vn/library/ckfinder/';

	//Startup path in a form: "Type:/path/to/directory/"
	finder.startupPath = startupPath;

	// Name of a function which is called when a file is selected in CKFinder.
	finder.selectActionFunction = SetFileField;

	// Additional data to be passed to the selectActionFunction in a second argument.
	// We'll use this feature to pass the Id of a field that will be updated.
	finder.selectActionData = functionData;

	// Name of a function which is called when a thumbnail is selected in CKFinder.
	finder.selectThumbnailActionFunction = ShowThumbnails;

	// Launch CKFinder
	finder.popup();
}

function SetFileField( fileUrl, data )
{
	document.getElementById( data["selectActionData"] ).value = fileUrl;
}

function ShowThumbnails( fileUrl, data )
{
	// this = CKFinderAPI
	var sFileName = this.getSelectedFile().name;
	document.getElementById( 'thumbnails' ).innerHTML +=
			'<div class="thumb">' +
				'<img src="' + fileUrl + '" />' +
				'<div class="caption">' +
					'<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
				'</div>' +
			'</div>';

	document.getElementById( 'preview' ).style.display = "";
	// It is not required to return any value.
	// When false is returned, CKFinder will not close automatically.
	return false;
}

