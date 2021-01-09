<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Cms</h3>
      </div>
    </div>

    <div class="row">
 

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Cms List</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
         
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Sr.No</th>
                  <th>Name</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($Cms as $c) { ?>
                  <tr>
                    <td><?=$i++?></td>
                    <td><?=$c->page_type?></td>
                    <td>
                        <center>
                            <a class="btn btn-success" href="<?=base_url()?>Cms/Edit/<?=$c->id?>">Edit Cms</a>
                        </center>    
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