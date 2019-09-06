
        <div class="col-md-10 mt-4 px-5 ">

	       	<div class="source-title ">
		        <h4 class="text-danger text-center"><b>Preview</b></h4>
		    </div>
		    <div>
		    	<table class="table table-striped">
		    		<tr class="table-danger">
		    			<th>Souces</th>
		    			<th>Schemas</th>
		    			<th>Tables</th>
		    			<th>Targets</th>
		    		</tr>

		    		<?php foreach ($rec as $row) {
		    			echo "<tr><td>".$row['database_list']."</td>";
		    			echo "<td>".$row['schema_list']."</td>";
		    			echo "<td>".$row['table_list']."</td>";
		    			foreach ($rec_target as $row) { 
		    				echo "<td>".$row['snow_flake']."</td>";
		    			}
		    			echo "</tr>";

		    		} ?>
		    	</table>
		    </div>
        	 <a  class="text-decoration-none btn btn-success text-light" href="<?php echo base_url();?>migration">
                                  Migration </a>
        </div>
    