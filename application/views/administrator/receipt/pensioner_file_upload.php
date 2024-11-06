<script type="text/javascript" src="<?php echo base_url('includes/js/bootstrap.file-input.js'); ?>"></script>

<h3>Upload Pensioner Files</h3><hr style="margin: 5px 0 20px 0;">
 <?php if(@$_GET['msg']!=''){ ?>
  <center>
  <div id="sc" class="alert alert-success" style="width:700px;font-family:Segoe UI">  
  <a  onclick="$('#sc').hide()" class="close" data-dismiss="alert" style="float:right;cursor:pointer"><span id="success" class="glyphicon glyphicon-remove">X</span></a>  
  <strong>Success!</strong> <?php echo base64_decode(@$_GET['msg']);?>.
</div>
  </center>
<?php }?>

<form id="file_form" action="<?php echo site_url('administrator/receipt/pensionser_file_upload'); ?>" method="post" enctype="multipart/form-data">
	<input value="<?php echo $f;?>" title="Enter file number" autocomplete="off" type="text" name="file_no" id="file_no" placeholder="Enter file number"/>
	<p style='font-size:10px'>Please upload .jpg .gif .png .pdf .doc or .docx files not exceeding 10MB size</p>
  <div><select name="check" id="check"><option>Select</option><option value="1">Alive</option><option value="0">Dead</option></select></div>
	<div class="container">
		<div id="row1" class="rowIndex fixedRow">
			<input onclick="showdel()" class="form-control" type="checkbox" name="chk[]" value="1">
            <select   title="Select File Name" id="file_desc1" class="file_desc" name="file_desc_1">
               
                <?php //foreach (getAllDocument() as $doc) { ?>
                    <option value="<?php //echo $doc['doc_no']; ?>"><?php //echo $doc['doc_name']; ?></option>
                <?php //} ?>
            </select>
          
            <script type="text/javascript">
            $('.file_desc').live('change', function() {
            	var me = $(this);
				//alert(me);
            	var length = $('.file_desc').length;
            	var currentRow = $(this).closest('.rowIndex').attr('id');
				//alert(currentRow);
            	$.each($('.file_desc'), function() {
            		var insideRow = $(this).closest('.rowIndex').attr('id');
            		if(currentRow==insideRow) {
            		} else {
            			if(me.val()==$(this).val()) {
            				alert("File Name should not be same.");
            			}
            		}
            	})
            });

  $('#file1').live('change', function(){
		var maximum =  104857600; // 1MB
		var inputFile = $('#file1');

	 var filename=inputFile.val();
	 var valid_extensions = /(\.jpg|\.jpeg|\.png|\.gif|\.pdf|\.doc|\.docx)$/i;   
	  var extension=filename.substr((Math.max(0, filename.lastIndexOf(".")) || Infinity) + 1);
	  //alert(extension);

if(!valid_extensions.test(filename))
{ 
   alert('Please upload a file in image format of either  .jpeg .jpg .gif .png .pdf .doc or .docx formats');
   inputFile.val('');
   inputFile.next('.file-input-name').html('');
   return false;
}
		
		
  else if (inputFile.files && inputFile.files[0].size > maximum) {
    alert("Photo size exceeded 100MB. Please choose a file that is less than or equal to 100MB"); // Do your thing to handle the error.
    inputFile.val(''); // Clear the field.
    inputFile.next('.file-input-name').html('');
	return false;
   }
   else { 

        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file1").files[0]);
if(extension.toLowerCase()=='jpg' || extension.toLowerCase()=='jpeg' || extension.toLowerCase()=='png' || extension.toLowerCase()=='gif'){
        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview1").src = oFREvent.target.result;
          

            $("#uploadPreview1").show();
			  }
              $("#uploadPreviewFile1").hide();
document.getElementById("typical1").value='image';

          }
          else {
$("#uploadPreview1").hide();
$("#uploadPreviewFile1").show();
 document.getElementById("typical1").value='file';
          }
         }
});
            </script>
         <?php $i=1;?>      
  &nbsp;<button id="butt" onclick="$('#file1').click();" type="button" class="btn btn-warning">Choose File</button> 
			<input  style="display:none" id="file1" type="file" name="file_1" class="file" />
			<img title="Document" id="uploadPreview1" height="30px" width="30px"   style=" border:1px solid #3b5999; border-radius:5px" hidden="true" />
  <img title="Document" id="uploadPreviewFile1" height="30px" width="30px"   
  style=" border:1px solid #3b5999; border-radius:5px" hidden="true" src="<?php echo base_url();?>includes/images/dc.png" />
  <input type="text" style="display: none" value="" name="typical1" id="typical1">
		</div>
	</div>
	<br />
	<input type="submit" name="submit" id="save" class="btn btn-success" value="Upload Document(s)">
	<a title="Select a checkbox and Remove files" class="btn btn-danger del-files" style="display:none" href="#">Remove</a>
	<a href="#" id="addMore" class="btn btn-info">Add More Document(s)</a>
</form>
<script type="text/javascript">
	$(document).ready(function(){
$('#file_no').live('blur', function(e) {
	if($.trim($("#file_no").val())!='') {
$.post("<?php echo site_url('administrator/receipt/checkFileNo'); ?>", {file_no: $('#file_no').val()}, function(data) {
	            	if(data=='problem'){
	            		alert('File number that you have entered is not available in the receipt branch. Please try again!!');
	            		$('#file_no').val('').focus();
	            	} else {
	            		if(data == 'Late') {
	            			//$('#check').val('0');
	            			$('#check').html('<option value="0">Dead</option>');
	            			onChangeCheck();
	            		} else {
	            			//$('#check').val('1');
	            			$('#check').html('<option value="1">Alive</option>');
	            			onChangeCheck();
	            		}
	           		}
	 });
}
});

        $('#check').on('change', function() {
        	onChangeCheck();
        });
        
        var onChangeCheck = function() {
        	var i=$('.container .rowIndex:last').attr('id').replace("row","");
            $.post('<?php echo site_url("administrator/receipt/getPensioner_Document/"); ?>', {chk: $('#check').val()},function(data) {
                //$('#file_desc'+i).html(data);
                $('.file_desc').html(data);
			});
        }

$('#save').live('click', function(e) {
	if($.trim($("#file_no").val())=="") {
				e.preventDefault();
				alert("Please enter a file number to proceed.");
				$('#file_no').focus();

			} 
			else {

	
				if($('#file_desc1').val()==0){

e.preventDefault();
				alert("You must select a file name for this file");
				$('#file_desc1').focus();	

}
else if($('#file1').val()==''){
e.preventDefault();
				alert("You must upload a file against each selection to save file information");
				$('#butt').focus();	
}
				//e.preventDefault();
				$.post("<?php echo site_url('administrator/receipt/checkFileNo');?>",{file_no: $('#file_no').val()}, function(data) {
	            	if(data=='problem') {
	            		alert('File number that you have entered is not available in the receipt branch. Please try again!!');
	            		$('#file_no').val('').focus();
	            	} else {
	            		 
	            	}
	            });
			}
		
		});

		$('#addMore').click(function(){
			var i = $('.container .rowIndex:last').attr('id').replace("row","");
			$.post('<?php echo site_url("administrator/receipt/getPensioner_Document/"); ?>', {chk: $('#check').val()},function(data) {
                $('#file_desc'+i).html(data);
				});
			i++;
			var row = '<div id="row'+i+'" class="rowIndex addedRow"><input onclick="showdel()" class="form-control" type="checkbox" name="chk[]" value="'+i+'"><select id="file_desc'+i+'" title="Select file name" class="file_desc" name="file_desc_'+i+'"><option value="0">Select file name</option><?php foreach (getAllDocument() as $doc){?><option value="<?php echo $doc['doc_no']; ?>"><?php echo $doc['doc_name']; ?></option><?php } ?></select><button id="butt'+i+'" type="button" class="btn btn-warning">Choose File</button> <input type="file" id="file'+i+'"  name="file_'+i+'" class="file"  style="display:none;left: left: -182.75px; top: 7px;" /><img title="Document" id="uploadPreview'+i+'" height="30px" width="30px"   style=" border:1px solid #3b5999; border-radius:5px" hidden="true" /><img title="Document" id="uploadPreviewFile'+i+'" height="30px" width="30px"   style=" border:1px solid #3b5999; border-radius:5px" hidden="true" src="<?php echo base_url();?>includes/images/dc.png" /><input type="text" style="display: none" value="" name="typical'+i+'" id="typical'+i+'"></div>';
			$('.container').append(row);
			$('#save').live('click', function(e){
			if($('#file_desc'+i).val()==0){
e.preventDefault();
				alert("You must select a file name for this file");
				$('#file_desc'+i).focus();	

}

				
else if($('#file'+i).val()==''){

e.preventDefault();
				alert("You must upload a file against each selection to save file information");
				$('#butt'+i).focus();	

}
});

			$("#butt"+i).click(function()
			{
          $("#file"+i).click();

				 
			});

 
			$('#file'+i).live('change', function(){
		var maximum =  104857600; // 1MB

		 var inputFile = $('#file'+i);

	 var filename=inputFile.val();
	 var valid_extensions = /(\.jpg|\.jpeg|\.png|\.gif|\.pdf|\.doc|\.docx)$/i; 
	  var extension=filename.substr((Math.max(0, filename.lastIndexOf(".")) || Infinity) + 1);

if(!valid_extensions.test(filename))
{ 
  alert('Please upload a file in image format of either  .jpeg .jpg .gif .png .pdf .doc or .docx formats');
   inputFile.val('');
   inputFile.next('.file-input-name').html('');
   return false;
   
}
		
		
  else if (inputFile.files && inputFile.files[0].size > maximum) {
    alert("Photo size exceeded 100MB. Please choose a file that is less than or equal to 100MB"); // Do your thing to handle the error.
    inputFile.val(''); // Clear the field.
    inputFile.next('.file-input-name').html('');
	return false;
   }
   else { 
 var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("file"+i).files[0]);
if(extension.toLowerCase()=='jpg' || extension.toLowerCase()=='jpeg' || extension.toLowerCase()=='png' || extension.toLowerCase()=='gif'){
        oFReader.onload = function (oFREvent) {
        
            document.getElementById("uploadPreview"+i).src = oFREvent.target.result;
            $("#uploadPreview"+i).show();

 
             
        }
         $("#uploadPreviewFile"+i).hide();
           document.getElementById("typical"+i).value='image';

     }

     else {

  $("#uploadPreview"+i).hide();
  $("#uploadPreviewFile"+i).show();
    document.getElementById("typical"+i).value='file';


     }





        
   }
	});
    


		

		});

		$('.del-files').click(function(){
			var length = $('[name="chk[]"]:checked').length;
			if(length == 1) {
				var delRowID = $('[name="chk[]"]:checked').closest('.rowIndex').attr('id');
				$('#'+delRowID).remove();
			} else {
				$.each($('[name="chk[]"]:checked'), function() {
                    var delRowID = $(this).closest('.rowIndex').attr('id');
                    $('#'+delRowID).remove();
                });
			}
			$('.del-files').hide();
		});
	});

	function showdel(){
 		var row = $('.container .rowIndex').length;
	  	var ln= $('[name="chk[]"]:checked').length;
   		if(row>1) {
   			if(row == ln) {
                alert('Can\'t delete all row.');
                $.each($('[name="chk[]"]'), function(){
                    $(this).prop('checked', false);
                });
                $('.del-files').hide();
            } else {
				if(ln>=1) {
					$('.del-files').show();
				} else {
					$('.del-files').hide();
				}
			}
		}
	}
</script>
<style type="text/css">
	.fixedRow .file_desc {margin-top: 10px;}
	.addedRow .file_desc {margin: 5px;}
	.rowIndex {height: 38px;}
	.fixedRow {margin-bottom: 5px;}
	.addedRow input[type="text"] {margin: 5px 4px;}
</style>