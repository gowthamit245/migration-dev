<?php
if($pagename!='home'){
?>
<div class="col-md-2 sidebar accordion" id="accordionExample">
  <div class="col-12 py-2 mt-2 pl-1 border-bottom">
            <?php if($this->session->userdata('jobname') != ''){
                echo "<b>".$this->session->userdata('jobname')."</b>";
            }
                else{?>
            <b>Job Name</b> <?php } ?>
    </div>
    
    <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link text-dark" type="button" data-toggle="collapse" data-target="#collapse11" aria-expanded="true" aria-controls="collapseOne">
          <b>Source Connection</b>
        </button>
      </h2>
    </div>

    <div id="collapse11" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
                <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button class="btn btn-link text-dark" type="button" data-toggle="collapse" data-target="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                      <b>Select Database</b>
                    </button>
                  </h2>
                </div>
                <div id="collapsetwo" class="collapse " aria-labelledby="headingOne" data-parent="#collapse11">
                  <div class="card-body">
                    <?php if($this->session->userdata('jobname') != '' && count($source)>0){
                            echo "<b>".$source[0]['database_list']."</b>";
                        }?> 
                  </div>
                </div>
                <div class="card-header" id="headingOne">
                  <h2 class="mb-0">
                    <button class="btn btn-link  text-dark" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                      <b>Select Schemas</b>
                    </button>
                  </h2>
                </div>
                <div id="collapseThree" class="collapse " aria-labelledby="headingOne" data-parent="#collapse11">
                  <div class="card-body">
                    <?php if($this->session->userdata('jobname') != '' && count($schema)>0){
                 foreach ($schema as $key => $value) {
                        echo "<b>".$value['schema_list']."</b><br>";
                     }
                
                    }
                        ?> 
                  </div>
                </div>
                <div class="card-header" id="headingOne">
                      <h2 class="mb-0">
                        <button class="btn btn-link  text-dark" type="button" data-toggle="collapse" data-target="#collapsefour" aria-expanded="true" aria-controls="collapsefour">
                          <b>Select Tables</b>
                        </button>
                      </h2>
                </div>
                <div id="collapsefour" class="collapse " aria-labelledby="headingOne" data-parent="#collapse11">
                  <div class="card-body">
                   <?php if($this->session->userdata('jobname') != '' && count($tables)>0){
                  foreach ($tables as $key => $value) {
                        echo "<b>".$value['table_list']."</b><br>";
                 }
                
            }?> 
                  </div>
                </div>
      </div>
    </div>
  </div>

    <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link  text-dark" type="button" data-toggle="collapse" data-target="#collapsefive" aria-expanded="true" aria-controls="collapseOne">
          <b>Target Connection</b>
        </button>
      </h2>
    </div>

    <div id="collapsefive" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
         <?php if($this->session->userdata('jobname') != '' && count($target)>0){
                  foreach ($target as $key => $value) {
                    if($value['status'] == 1 ){
                        echo "<b>".$value['snow_flake']."</b><br>";
                    }
                 }
                
            }?> 
      </div>
    </div>
  </div>
    
        <div class="col-12 py-2 mt-2 pl-2 border-bottom">
            <b>Data Migration</b>
        </div> 
        <div class="col-12 py-2 mt-2 pl-2 border-bottom">
            <b>Summary</b>
        </div>  
    

</div>
<?php }?>

