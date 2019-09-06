
              <div class="col-md-10 mt-4 px-5 ">
                <!-- <div class="row">
                          <button class="btn btn-danger" data-toggle='modal' data-target='#GSCCModal' id="">Create Job</button>

                      </div> -->
                  <div class="row">
                      <div class="col-md-1"></div>
                      <div class="col-md-5">
                          <div class="source">
                              <div class="source-title bg-danger">
                                  <h4 class="text-light text-center">Source</h4>
                              </div>
                              <div>
                                  <table class="table mb-1" id="schema_list">
                                      <tbody>
                                           <?php foreach ($rec as $row) { ?>

                                          <tr class="<?php if($row['status'] == 1){ echo 'selected'; }?>">
                                              <td onclick="get_connection(<?= $row['id'] ?> );"><?= $row['database_list'] ?></td>
                                          </tr>
                                          <?php } ?>
                                      </tbody>
                                  </table>
                              </div>
                              <div class="source-footer bg-danger">
                                  
                                  <div class="row source-footer bg-00b0cc align-items-center justify-content-end pr-5 pb-0 pt-0 mb-1">
                              <a class="text-decoration-none btn bg-087486 text-light" href="<?php echo base_url();?>schema-list/<?php if($selected_id){echo $selected_id;}?>">
                                  Next </a>
                          </div>
                                
                              </div>
                          </div>
                      </div>
                  </div>
                  <div id="GSCCModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog custom-modeal-body" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h3 class="modal-title" id="exampleModalLabel">Create Job</h3>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body pb-2">
                                  <form action="new_crete_job" method="POST">
                                    <div class="form-group">
                                          <label for="recipient-name" class="col-form-label"> Name:</label>
                                          <input type="text" class="form-control"  id="job_name" name="job_name">
                                      </div>
                                      <div class="modal-footer">
                                          <input type="submit" class="btn btn-success" name="submit" value="Submit">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                      </div>
                                      
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div id="getConModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog custom-modeal-body" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h3 class="modal-title" id="exampleModalLabel">Choose Connection</h3>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body pb-2">
                                  <form action="new_crete_job" method="POST">
                                    <div class="parent" id="parent">
                                      
                                    </div>
                                   
                                
                                      
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
              
<script type="text/javascript">
    function source_selected(id)      {
   window.location.href = weblink + 'create-job/' + id ;
//           var status=0;
//       //alert(id);
//       $.ajax(
//       {
//       url:"source_update/"+id,
//       type:"POST",
//       datatype:"json",
//       success:function()
//       {
//        window.location.href = weblink ;
//       }
//       });
//      /* if(status==1){
//        $("#id").css("background","red");
//       }*/
//         //$("#id").parent('tr').css("background","red");
// $(".clr")
}
function get_connection(id)
{
  $("#getConModal").modal('show');
  var data='   <div class="row">';
  data+='<div class="col"><h6>Host Name</h6></div><div class="col"><h6>Port</h6></div><div class="col"><h6>Username</h6></div><div class="col"><h6>Action</h6></div></div>';
         $.ajax({
                            url: weblink + "get_connection_data/"+id,
                           type:"GET",
                            datatype:"json",
                           // data: {'id': schemaList },
                            success:function(result){
                                 var d= JSON.parse(result);
                                 for(var i=0;i<d.length;i++)
                                 {
                                  data+='<div class="row mt-1">';
                                  data+='<div class="col">'+d[i].hosturl+'</div>';
                                   data+='<div class="col">'+d[i].port+'</div>';
                                   data+='<div class="col">'+d[i].userid+'</div>';
                                   data+='<div class="col"><a href="'+weblink + 'create-job/' + id+'" class="btn btn-success">Connect</a></div>';
                                   data+='</div>';
                                 }
                                 $("#parent").html(data);
                              console.log(result);
                             /*   result = JSON.parse(result);
                                if(result.status == 'success'){
                                    
                             window.location.href = weblink + 'table'  ;          
                            }*/
                        }
                        });
 return false;
}
</script> 