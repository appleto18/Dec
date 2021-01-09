<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Notification</h3>
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
                  <th>Notification Title</th>
                  <th>Notification Date</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($notification as $row):?>
                  <tr>
                    <td><?=$i++?></td> 
                    <td><?=$row->title?></td>
                    <td><?=$row->date?></td>
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