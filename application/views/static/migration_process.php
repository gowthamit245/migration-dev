
        <div class="col-md-10 mt-4 px-5 ">

	       	<div class="source-title ">
		        <h4 class="text-danger text-center"><b></b></h4>
		    </div>
		    <div>
		    	<table class=" table table-striped">
		    		<tr scope="col" class="table-danger">
		    			<th>Source</th>
		    			<th>Schemas</th>
		    			<th>Tables</th>
		    			<th>Targets</th>
		    		</tr>
		    		<tr scope="col" class="table table-striped" >
		    			<td>
		    				<div class="d-block">
		    					<?php foreach ($rec_source as $row) {
					    			echo "<span class=' d-block py-2 '>".$row['database_list']."</span>";

					    		} ?>	
		    				</div>
		    			</td>
		    			<td>
		    				<div class="d-block">
		    					<?php foreach ($rec_schema as $row) {
					    			echo "<span class=' d-block py-2 '>".$row['schema_list']."</span>";

					    		} ?>	
		    				</div>
		    			</td>
		    			<td>

		    				<div class="d-block">
		    					<?php foreach ($rec_tables as $row) {
					    			echo "<span class=' d-block py-2 '>".$row['table_list']."</span>";

					    		} ?>	
		    				</div>
		    				
		    			</td>
		    			<td>
		    				<div class="d-block">
		    					<?php foreach ($rec_target as $row) {
					    			echo "<span class=' d-block py-2 '>".$row['snow_flake']."</span>";

					    		} ?>	
		    				</div>
		    			</td>
		    		</tr>
		    	</table>
		    </div>
        	 <a  class="text-decoration-none btn btn-success text-light" href="<?php echo base_url();?>migration">
                                  Migration </a>
        </div>
    