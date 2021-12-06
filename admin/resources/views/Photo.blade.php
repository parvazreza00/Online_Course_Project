@extends('Layout.app')
@section('title','Photo Gallery')

@section('content')


<div class="container-fluid m-0 ">
        <div class="row">
            <div class="col-md-12">
                <button data-toggle="modal" data-target="#PhotoModal" id="addNewPhotoBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>
            </div>
        </div>         
</div>

		<div class="container-fluid">	
        	<div class="row photoRow">

	        	
        	</div>
        	 <button class="btn btn-sm btn-primary" id="LoadMoreBtn"> Load More </button>
        </div>

<!-- Modal -->
<div class="modal fade" id="PhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input class="form-control" id="imgInput" type="file">
                    <img class="imgPreview mt-3" id="imgPreview" src="{{asset('images/default-image.png')}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    <button id="SavePhoto" type="button" class="btn btn-sm btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
	<script type="text/javascript">

		$('#imgInput').change(function(){
			var reader = new FileReader();
			reader.readAsDataURL(this.files[0]);
			reader.onload=function(event){
				var ImgSource=event.target.result;
				$('#imgPreview').attr('src',ImgSource);
			}
		})		

		$('#SavePhoto').on('click',function(){

			$('#SavePhoto').html("<span class='spinner-border spinner-border-sm' role='status'></span>"); //animation...

			var PhotoFile = $('#imgInput').prop('files')[0];
			var formData = new FormData();
			formData.append('photo',PhotoFile);


			axios.post("/PhotoUpload",formData).then(function(response){

				if(response.status==200 && response.data==1){
					$('#SavePhoto').html('Save');
					toastr.success('Photo Upload Success');
					$('#PhotoModal').modal('hide');
				}
				else{
					toastr.error('Photo Upload Fail');
				}

			}).catch(function(error){
				$('#SavePhoto').html('Save');
				toastr.error('Photo Upload Fail');
				$('#PhotoModal').modal('hide');

			});

		})

		LoadPhoto();

		function LoadPhoto(){ 
			let url="/PhotoJSON";

			axios.get(url)
			.then(function(response){

				$.each(response.data,function(i,item){
						$("<div class='col-md-3 p-1'>").html(
						"<img data-id=" + item['id'] + " class='imgOnRow' src=" + item['location'] + ">"+
						 "<button data-id="+ item['id']+" data-photo="+ item['location']+" class='btn deletePhoto btn-sm'> Delete</button>"						
						).appendTo('.photoRow');
				});

				 $('.deletePhoto').on('click',function (event) {
                    let id=$(this).data('id');
                    let photo=$(this).data('photo');
                    PhotoDelete(photo,id);
                    event.preventDefault();
                })

			})
			.catch(function(error){

			});
		}



		var ImgId=0;
		function LoadById(FirstImgId,LoadMoreBtn){

			ImgId = ImgId+4;
			let photoId = ImgId + FirstImgId;

			let url="/PhotoJSONByID/"+photoId;

			LoadMoreBtn.html("<span class='spinner-border spinner-border-sm' role='status'></span>");//animation.....

		

			axios.get(url)
			.then(function(response){
				
				LoadMoreBtn.html("Load More");

				$.each(response.data,function(i,item){
						$("<div class='col-md-3 p-1'>").html(
						"<img data-id=" + item['id'] + " class='imgOnRow' src=" + item['location'] + ">"+
						 "<button data-id="+ item['id']+" data-photo="+ item['location']+" class='btn deletePhoto btn-sm'> Delete</button>"						
						).appendTo('.photoRow');
				});
			})
			.catch(function(error){

			});
		}


		$('#LoadMoreBtn').on('click',function(){
			let LoadMoreBtn = $(this);
			let FirstImgId = $(this).closest('div').find('img').data('id');
			LoadById(FirstImgId,LoadMoreBtn);
		})


		function PhotoDelete(OldPhotoURL,id) {
               
                let MyFormData=new FormData();
                MyFormData.append('OldPhotoURL',OldPhotoURL);
                MyFormData.append('id',id);
                axios.post("/PhotoDelete",MyFormData).then(function (response) {

                    if(response.status==200 && response.data==1){
                        toastr.success('Photo Delete Success');
                        $('.photoRow').empty();
                        LoadPhoto();
                         //window.location.href="/Photo";
                    }
                    else{
                        toastr.error('Delete Fail Try Again');
                    }
                }).catch(function(error){
                    toastr.error('Delete Fail Try Again');
                });
        }		

		</script>
@endsection