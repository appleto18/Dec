<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Reviews</h3>
      </div>
    </div>

    <div class="row">
 

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Reviews List</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
         
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>GST No</th>
                  <th>Review By</th>
                  <th>Rating</th>
                  <th>Review</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($Reviews as $row) { ?>
                  <tr>
                    <td><?=$i++?></td> 
                    <td><?=$row->gst_no?></td>
                    <td><?=$row->last_name.' '.$row->last_name?></td>
                    <td><?=$row->rating?></td>
                    <td><?=$row->review?></td>
                    <td>
                        <a href="<?php echo base_url().'Reviews/Edit/'.$row->id?>" class="btn btn-success" >Edit</a>
                        <a class="btn btn-danger" href="javascript:void(0);" onclick="delete_review(<?=$row->id?>)">Delete</a>
                    </td>
                  </tr>
                <?php } ?>
             
              </tbody>
            </table>
  
  
          </div>
        </div>
      </div>


    </div>
  </div>
</div>