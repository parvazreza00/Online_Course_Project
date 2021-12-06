@extends('Layout.app')
@section('title','Services')

@section('content')


<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

	<button id="addNewBtnId" class="btn btn-danger btn-sm my-3">ADD NEW</button>

<table id="serviceDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="service_table">
  
	
		
  </tbody>
</table>

</div>
</div>
</div>

<div id="loaderDiv" class="container">
    <div class="row">
        <div class="col-md-12 text-center p-5">

        	<img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">

        </div>
    </div>
</div>

<div id="wrongDiv" class="container d-none">
    <div class="row">
        <div class="col-md-12 text-center p-5">

        	<h3 class="text-danger">Something went wrong !</h3>

        </div>
    </div>
</div>


<!-- delete modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">      
      <div class="modal-body text-center p-3 mt-5">
      	<h5 class="text-danger">Do You Want To Delete?</h5>      	
      		<h6 id="serviceDeleteId" class="mt-4 d-none">  </h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-sm btn btn-primary" data-dismiss="modal">No</button>
        <button type="button" data-id=" " id="serviceDeleteConfirmBtn" class=" btn-sm btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- edit modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">  
    <div class="modal-header">
        <h5 class="modal-title">Update Services</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
     </div>    
      	<div class="modal-body text-center p-3">  
     		<h6 id="serviceEditId" class="mt-4 d-none">  </h6>	
     		<div id="serviceEditForm" class="w-100 d-none">
	      		<input type="text" id="serviceNameId" class="form-control mb-4" placeholder="Service Name"/>
	      		<input type="text" id="serviceDesId" class="form-control mb-4" placeholder="Service Desc.."/>
			    <input type="text" id="serviceImgId" class="form-control mb-4" placeholder="Image Link"/>	
		    </div>
		    	<img id="serviceEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
		    	<h5 id="serviceEditWrong" class="text-danger d-none">Something went wrong !</h5>
		</div>

      <div class="modal-footer">
        <button type="button" class="btn-sm btn btn-primary" data-dismiss="modal">Cancel</button>
        <button type="button" data-id=" " id="serviceEditConfirmBtn" class=" btn-sm btn btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

<!-- add modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">      
      	<div class="modal-body text-center p-3 mt-5">  

     		
     		<div id="serviceAddForm" class="w-100 ">
     			<h6 class="mb-3">Add new Services</h6>
	      		<input type="text" id="serviceNameAddId" class="form-control mb-4" placeholder="Service Name"/>
	      		<input type="text" id="serviceDesAddId" class="form-control mb-4" placeholder="Service Desc.."/>
			    <input type="text" id="serviceImgAddId" class="form-control mb-4" placeholder="Image Link"/>	
		    </div>
		    	
		</div>

      <div class="modal-footer">
        <button type="button" class="btn-sm btn btn-primary" data-dismiss="modal">Cancel</button>
        <button type="button" data-id=" " id="serviceAddConfirmBtn" class=" btn-sm btn btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>

@endsection




@section('script')
<script type="text/javascript">
	getServicesData();	


	//for services table
function getServicesData() {

    axios.get('/getServicesData')
        .then(function(response) {

            if (response.status == 200) {

                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

                $('#serviceDataTable').DataTable().destroy();
                $('#service_table').empty();

                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td> <img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                        "<td>" + jsonData[i].service_name + "</td>" +
                        "<td>" + jsonData[i].service_des + " </td>" +
                        "<td> <a class='serviceEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a> </td>" +
                        "<td> <a class='serviceDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#service_table');
                });

                //services table delete icon click
                $('.serviceDeleteBtn').click(function() {

                    var id = $(this).data('id');
                    $('#serviceDeleteId').html(id);
                    $('#deleteModal').modal('show');
                })


                //services table edit icon click
                $('.serviceEditBtn').click(function() {

                    var id = $(this).data('id');
                    $('#serviceEditId').html(id);
                    ServiceUpdateDetails(id);
                    $('#editModal').modal('show');
                })

                  //data table make  
                 $('#serviceDataTable').DataTable({"order":false});
                 $('.dataTables_length').addClass('bs-select');   



            } else {

                $('#loaderDiv').addClass('d-none');
                $('#wrongDiv').removeClass('d-none');

            }



        }).catch(function(error) {
            $('#loaderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');

        });

}


//services delete modal yes button
$('#serviceDeleteConfirmBtn').click(function() {
    var id = $('#serviceDeleteId').html();
    ServiceDelete(id);
})

//service delete
function ServiceDelete(deleteId) {

    $('#serviceDeleteConfirmBtn').html("<span class='spinner-border spinner-border-sm' role='status'></span>"); //animation...

    axios.post('/ServiceDelete', {
            id: deleteId
        })
        .then(function(response) {

            $('#serviceDeleteConfirmBtn').html("Yes");

            if (response.status == 200) {

                if (response.data == 1) {
                    $('#deleteModal').modal('hide');
                    toastr.success('Delete Success');
                    getServicesData()
                } else {
                    $('#deleteModal').modal('hide');
                    toastr.error('Delete Fail');
                    getServicesData()
                }
            } else {
                $('#deleteModal').modal('hide');
                toastr.error('Something went wrong !');
            }

        })
        .catch(function(error) {
            $('#deleteModal').modal('hide');
            toastr.error('Something went wrong !');

        });
}

//Each services update details
function ServiceUpdateDetails(detailsId) {

    axios.post('/getServicesDetails', {
            id: detailsId
        })
        .then(function(response) {

            if (response.status == 200) {
                $('#serviceEditForm').removeClass('d-none');

                $('#serviceEditLoader').addClass('d-none');

                var jsonData = response.data;
                $('#serviceNameId').val(jsonData[0].service_name);
                $('#serviceDesId').val(jsonData[0].service_des);
                $('#serviceImgId').val(jsonData[0].service_img);
            } else {
                $('#serviceEditLoader').addClass('d-none');
                $('#serviceEditWrong').removeClass('d-none');
            }

        })
        .catch(function(error) {
            $('#serviceEditLoader').addClass('d-none');
            $('#serviceEditWrong').removeClass('d-none');

        });
}



//services edit/update modal save button
$('#serviceEditConfirmBtn').click(function() {

    var id = $('#serviceEditId').html();
    var name = $('#serviceNameId').val();
    var des = $('#serviceDesId').val();
    var img = $('#serviceImgId').val();


    ServiceUpdate(id, name, des, img);

})

//Each services update details
function ServiceUpdate(serviceId, serviceName, serviceDes, serviceImg) {


    if (serviceName.length == 0) {
        toastr.error('Service name is empty!');
    } else if (serviceDes.length == 0) {
        toastr.error('Service des. is empty!');

    } else if (serviceImg.length == 0) {
        toastr.error('Service image is empty!');

    } else {
        $('#serviceEditConfirmBtn').html("<span class='spinner-border spinner-border-sm' role='status'></span>"); //animation...


        axios.post('/ServiceUpdate', {
                id: serviceId,
                name: serviceName,
                des: serviceDes,
                img: serviceImg,
            })
            .then(function(response) {
                $('#serviceEditConfirmBtn').html("Save");

                if (response.status == 200) {

                    if (response.data == 1) {
                        $('#editModal').modal('hide');
                        toastr.success('Update Success');
                        getServicesData()
                    } else {
                        $('#editModal').modal('hide');
                        toastr.error('Update Fail');
                        getServicesData()
                    }
                } else {
                    $('#editModal').modal('hide');
                    toastr.error('Something went wrong');

                }

            })
            .catch(function(error) {
                $('#editModal').modal('hide');
                toastr.error('Something went wrong !');

            });

    }


}

//service add new btn click
$('#addNewBtnId').click(function() {
    $('#addModal').modal('show');

});


//services add modal save button
$('#serviceAddConfirmBtn').click(function() {
    var name = $('#serviceNameAddId').val();
    var des = $('#serviceDesAddId').val();
    var img = $('#serviceImgAddId').val();
    ServiceAdd(name, des, img);
})

//service add method
function ServiceAdd(serviceName, serviceDes, serviceImg) {
    if (serviceName.length == 0) {
        toastr.error('Service name is empty!');
    } else if (serviceDes.length == 0) {
        toastr.error('Service des. is empty!');
    } else if (serviceImg.length == 0) {
        toastr.error('Service image is empty!');
    } else {
        $('#serviceAddConfirmBtn').html("<span class='spinner-border spinner-border-sm' role='status'></span>"); //animation...


        axios.post('/ServiceAdd', {
                name: serviceName,
                des: serviceDes,
                img: serviceImg,
            })
            .then(function(response) {
                $('#serviceAddConfirmBtn').html("Save");

                if (response.status == 200) {

                    if (response.data == 1) {
                        $('#addModal').modal('hide');
                        toastr.success('Add Success');
                        getServicesData()
                    } else {
                        $('#addModal').modal('hide');
                        toastr.error('Add Fail');
                        getServicesData()
                    }
                } else {
                    $('#addModal').modal('hide');
                    toastr.error('Something went wrong');
                }
            })
            .catch(function(error) {
                $('#addModal').modal('hide');
                toastr.error('Something went wrong !');

            });
    }
}
</script>
@endsection