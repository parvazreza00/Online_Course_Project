@extends('Layout.app')
@section('title','Courses')
@section('content')

<div id="mainDivCourses" class="container d-none">
	<div class="row">
		<div class="col-md-12 p-3">

			<button id="addNewCoursesBtnId" class="btn btn-danger btn-sm my-2">ADD NEW</button>

			<table id="coursesTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			  <thead>
			    <tr>			      
				  <th class="th-sm">Name</th>
				  <th class="th-sm">Fee</th>
				  <th class="th-sm">Class</th>
				  <th class="th-sm">Enroll</th>				 
				  <th class="th-sm">Edit</th>
				  <th class="th-sm">Delete</th>
			    </tr>
			  </thead>
			  <tbody id="Courses_table">			
						
				
			  </tbody>
			</table>
		</div>
	</div>
</div>


<div id="loaderDivCourses" class="container">
    <div class="row">
        <div class="col-md-12 text-center p-5">
        	<img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
        </div>
    </div>
</div>

<div id="wrongDivCourses" class="container d-none">
    <div class="row">
        <div class="col-md-12 text-center p-5">
        	<h3 class="text-danger">Something went wrong !</h3>
        </div>
    </div>
</div>



<!-- course add Modal open -->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<!-- course update Modal open -->
<div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
     <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
     </div>
      <div class="modal-body  text-center">
      	<h6 id="courseEditId" class="mt-4 d-none">  </h6>	
       <div id="courseUpdateForm" class="container d-none">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
       		<img id="courseEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
		    	<h5 id="courseEditWrong" class="text-danger d-none">Something went wrong !</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



<!-- delete modal -->
<div class="modal fade" id="CoursedeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">      
      <div class="modal-body text-center p-3 mt-5">
      	<h5 class="text-danger">Do You Want To Delete?</h5>      	
      		<h6 id="CourseDeleteId" class="mt-4 d-none">  </h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-sm btn btn-primary" data-dismiss="modal">No</button>
        <button type="button" data-id=" " id="CourseDeleteConfirmBtn" class=" btn-sm btn btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>






@endsection






@section('script')
<script type="text/javascript">
getCoursesData();



//for services table
function getCoursesData() {

    axios.get('/getCoursesData')
        .then(function(response) {

            if (response.status == 200) {

                $('#mainDivCourses').removeClass('d-none');
                $('#loaderDivCourses').addClass('d-none');

                $('#coursesTable').DataTable().destroy();
                $('#Courses_table').empty();

                var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td>" + jsonData[i].course_name + "</td> " +
                        "<td>" + jsonData[i].course_fee + "</td> " +
                        "<td>" + jsonData[i].course_totalclass + "</td> " +
                        "<td>" + jsonData[i].course_totalenroll + "</td> " +                                    
                        "<td> <a class='coursesEditBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a> </td>" +
                        "<td> <a class='coursesDeleteBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#Courses_table');
                });

                //delete modal show 
                $('.coursesDeleteBtn').click(function(){
                    var id= $(this).data('id');
                    $('#CourseDeleteId').html(id);
                    $('#CoursedeleteModal').modal('show');
                })

                //update course modal show 
                $('.coursesEditBtn').click(function(){ 
                    var id= $(this).data('id');
                    CourseUpdateDetails(id) ; 
                    $('#courseEditId').html(id);                 
                    $('#updateCourseModal').modal('show');
                })

                //data table make
                $('#coursesTable').DataTable({"order":false});
                $('.dataTables_length').addClass('bs-select');

            } else {

                $('#loaderDivCourses').addClass('d-none');
                $('#wrongDivCourses').removeClass('d-none');

            }

        }).catch(function(error) {
            $('#loaderDivCourses').addClass('d-none');
            $('#wrongDivCourses').removeClass('d-none');

        });



}


$('#addNewCoursesBtnId').click(function(){

    $('#addCourseModal').modal('show');
});

// Courses add save
$('#CourseAddConfirmBtn').click(function(){

    var CourseName= $('#CourseNameId').val();
    var CourseDes= $('#CourseDesId').val();
    var CourseFee= $('#CourseFeeId').val();
    var CourseEnroll= $('#CourseEnrollId').val();
    var CourseClass= $('#CourseClassId').val();
    var CourseLink= $('#CourseLinkId').val();
    var CourseImg= $('#CourseImgId').val();

    CoursesAdd(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg);

});


// Courses add method
function CoursesAdd(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg) {
    if (CourseName.length == 0) {
        toastr.error('Course name is empty!');
    } 
    else if (CourseDes.length == 0) {
        toastr.error('Course des. is empty!');
    } 
    else if (CourseFee.length == 0) {
        toastr.error('CourseFee is empty!');
    } 
    else if (CourseEnroll.length == 0) {
        toastr.error('Course Enroll is empty!');        
    } 
    else if (CourseClass.length == 0) {
        toastr.error('CourseClass is empty!');        
    } 
    else if (CourseLink.length == 0) {
        toastr.error('CourseLink is empty!');
    } 
    else if (CourseImg.length == 0) {
        toastr.error('CourseImg is empty!');
    } 
    else {
        $('#CourseAddConfirmBtn').html("<span class='spinner-border spinner-border-sm' role='status'></span>"); //animation...


        axios.post('/CoursesAdd', {
                course_name: CourseName,
                course_des: CourseDes,
                course_fee: CourseFee,
                course_totalenroll: CourseEnroll,
                course_totalclass: CourseClass,
                course_link: CourseLink,
                course_img: CourseImg,
            })
            .then(function(response) {
                $('#CourseAddConfirmBtn').html("Save");

                if (response.status == 200) {

                    if (response.data == 1) {
                        $('#addCourseModal').modal('hide');
                        toastr.success('Add Success');
                        getCoursesData();
                    } else {
                        $('#addCourseModal').modal('hide');
                        toastr.error('Add Fail');
                        getCoursesData();
                    }
                } else {
                    $('#addCourseModal').modal('hide');
                    toastr.error('Something went wrong');
                }
            })
            .catch(function(error) {
                $('#addCourseModal').modal('hide');
                toastr.error('Something went wrong !');

            });
    }
}

//Courses delete confirm
$('#CourseDeleteConfirmBtn').click(function(){
    var id = $('#CourseDeleteId').html();
    CoursesDelete(id);
})

//Courses delete
function CoursesDelete(deleteId) {

    $('#CourseDeleteConfirmBtn').html("<span class='spinner-border spinner-border-sm' role='status'></span>"); //animation...

    axios.post('/CoursesDelete', {
            id: deleteId
        })
        .then(function(response) {

            $('#CourseDeleteConfirmBtn').html("Yes");

            if (response.status == 200) {

                if (response.data == 1) {
                    $('#CoursedeleteModal').modal('hide');
                    toastr.success('Delete Success');
                    getCoursesData();
                } else {
                    $('#CoursedeleteModal').modal('hide');
                    toastr.error('Delete Fail');
                    getCoursesData();
                }
            } else {
                $('#CoursedeleteModal').modal('hide');
                toastr.error('Something went wrong !');
            }

        })
        .catch(function(error) {
            $('#CoursedeleteModal').modal('hide');
            toastr.error('Something went wrong !');

        });

        }


        //course update method
        function CourseUpdateDetails(detailsId){
            axios.post('/getCoursesDetails', {
            id: detailsId
        })
        .then(function(response) {

            if (response.status == 200) {
                $('#courseUpdateForm').removeClass('d-none');
                $('#courseEditLoader').addClass('d-none');

                var jsonData = response.data;

                $('#CourseNameUpdateId').val(jsonData[0].course_name);
                $('#CourseDesUpdateId').val(jsonData[0].course_des);
                $('#CourseFeeUpdateId').val(jsonData[0].course_fee);
                $('#CourseEnrollUpdateId').val(jsonData[0].course_totalenroll);
                $('#CourseClassUpdateId').val(jsonData[0].course_totalclass);
                $('#CourseLinkUpdateId').val(jsonData[0].course_link);
                $('#CourseImgUpdateId').val(jsonData[0].course_img);
            } else {
                $('#courseEditLoader').addClass('d-none');
                $('#courseEditWrong').removeClass('d-none');
            }

        })
        .catch(function(error) {
            $('#courseEditLoader').addClass('d-none');
            $('#courseEditWrong').removeClass('d-none');

        });

    }

    //update save 
    $('#CourseUpdateConfirmBtn').click(function(){

        var courseId=$('#courseEditId').html();
        var courseName=$('#CourseNameUpdateId').val();
        var courseDes=$('#CourseDesUpdateId').val();
        var courseFee=$('#CourseFeeUpdateId').val();
        var courseEnroll=$('#CourseEnrollUpdateId').val();
        var courseClass=$('#CourseClassUpdateId').val();
        var courseLink=$('#CourseLinkUpdateId').val();
        var courseImg=$('#CourseImgUpdateId').val();

        CourseUpdate(courseId, courseName, courseDes, courseFee,courseEnroll,courseClass,courseLink,courseImg);


    });

    //Course update details
function CourseUpdate(courseId, courseName, courseDes, courseFee,courseEnroll,courseClass,courseLink,courseImg) {


    if (courseName.length == 0) {
        toastr.error('Course name is empty!');
    } 
    else if (courseDes.length == 0) {
        toastr.error('Course des. is empty!');
    } 
    else if (courseFee.length == 0) {
        toastr.error('Course fee is empty!');
    } 
    else if (courseEnroll.length == 0) {
        toastr.error('Course Enroll is empty!');
    } 
    else if (courseClass.length == 0) {
        toastr.error('Course Class is empty!');
    } 
    else if (courseLink.length == 0) {
        toastr.error('Course Link is empty!');
    }
    else if (courseImg.length == 0) {
        toastr.error('Course Image is empty!');
    } 
    else {
        $('#CourseUpdateConfirmBtn').html("<span class='spinner-border spinner-border-sm' role='status'></span>"); //animation...


        axios.post('/CoursesUpdate', {
                id: courseId,
                course_name: courseName,
                course_des: courseDes,
                course_fee: courseFee,
                course_totalenroll: courseEnroll,
                course_totalclass: courseClass,
                course_link: courseLink,
                course_img: courseImg,
            })
            .then(function(response) {
                $('#CourseUpdateConfirmBtn').html("Save");

                if (response.status == 200) {

                    if (response.data == 1) {
                        $('#updateCourseModal').modal('hide');
                        toastr.success('Update Success');
                        getCoursesData();
                    } else {
                        $('#updateCourseModal').modal('hide');
                        toastr.error('Update Fail');
                        getCoursesData();
                    }
                } else {
                    $('#updateCourseModal').modal('hide');
                    toastr.error('Something went wrong');

                }

            })
            .catch(function(error) {
                $('#updateCourseModal').modal('hide');
                toastr.error('Something went wrong');


            });

    }


}


</script>
@endsection