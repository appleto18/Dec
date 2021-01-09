<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Users</h3>
      </div>
    </div>

    <div class="row">
 

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
         
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Profile Image</th>
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Country</th>
                  <th>City</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($users as $row):?>
                  <tr>
                    <td><?=$i++?></td> 
                    <td><img src="<?=$row->profile_image?>" style="width:50px;height:50px"></td>
                    <td><?=$row->user_name?></td>
                    <td><?=$row->user_email?></td>
                    <td><?=$row->phone?></td>
                    <td><?=$row->country?></td>
                    <td><?=$row->city?></td>
                    <td>
                        <a class="btn btn-primary"  href="<?=base_url('Product/index/'.$row->user_id)?>"  title="View Products"><i class="fa fa-eye" aria-hidden="true"></i></a>
                        <a class="btn btn-success"  href="<?=base_url('Orders/index/'.$row->user_id)?>"  title="View Order"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        <a class="btn btn-primary"  href="<?=base_url('Users/edit/'.$row->user_id)?>"  title="Edit User"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        <a class="btn btn-danger" href="javascript:void(0);" onclick="delete_users(<?=$row->user_id?>)" title="Delete User"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        <a class="btn btn-primary"  href="<?=base_url('Notification/index/'.$row->user_id)?>"  title="Notification"><i class="fa fa-bell" aria-hidden="true"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
             
              </tbody>
            </table>
  
  
          </div>
        </div>
      </div>


    </div>
  </div>
</div>