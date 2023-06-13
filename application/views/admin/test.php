<?php 
$sc = $this->db->get('site_config')->row_array();
  ?>

 <div class="container">
 	<table>
 		<td width="1000"><?= $sc['header']; ?></td>
 	</table>
 	
 </div>