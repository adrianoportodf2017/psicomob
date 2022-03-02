
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <section class="panel">
            <header class="panel-heading">
                <?php
                if (!empty($gridsection->id))
                    echo '<i class="fa fa-edit"></i> ' . lang('edit_gridsection');
                else
                    echo '<i class="fa fa-plus-circle"></i> ' . lang('add_gridsection');
                ?>
            </header>
            <div class="panel-body">
                <div class="adv-table editable-table ">
                    <div class="clearfix">

                        <div class="col-lg-12">
                            <section class="panel">
                                <div class="panel-body">
                                    <div class="col-lg-12">
                                        <div class="col-lg-3"></div>
                                        <div class="col-lg-6">
                                            <?php echo validation_errors(); ?>
                                            <?php echo $this->session->flashdata('feedback'); ?>
                                        </div>
                                        <div class="col-lg-3"></div>
                                    </div>
                                    <form role="form" action="gridsection/addNew" method="post" enctype="multipart/form-data">
                                        <div class="form-group">    
                                            <label for="exampleInputEmail1"><?php echo lang('title'); ?></label>
                                            <input type="text" class="form-control" name="title" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('name');
                                            }
                                            if (!empty($gridsection->title)) {
                                                echo $gridsection->title;
                                            }
                                            ?>' placeholder="">   
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('category'); ?></label>
                                            <input type="text" class="form-control" name="category" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('category');
                                            }
                                            if (!empty($gridsection->category)) {
                                                echo $gridsection->category;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('description'); ?></label>
                                            <input type="text" class="form-control" name="description" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('gridsection');
                                            }
                                            if (!empty($gridsection->description)) {
                                                echo $gridsection->description;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('position'); ?></label>
                                            <input type="text" class="form-control" name="position" id="exampleInputEmail1" value='<?php
                                            if (!empty($setval)) {
                                                echo set_value('gridsection');
                                            }
                                            if (!empty($gridsection->position)) {
                                                echo $gridsection->position;
                                            }
                                            ?>' placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1"><?php echo lang('status'); ?></label>
                                            <select class="form-control m-bot15" name="status" value=''>
                                                <option value="Active" <?php
                                                if (!empty($setval)) {
                                                    if ($gridsection->status == set_value('status')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($gridsection->status)) {
                                                    if ($gridsection->status == 'Active') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('active'); ?> 
                                                </option>
                                                 <option value="Inactive" <?php
                                                if (!empty($setval)) {
                                                    if ($gridsection->status == set_value('status')) {
                                                        echo 'selected';
                                                    }
                                                }
                                                if (!empty($gridsection->status)) {
                                                    if ($gridsection->status == 'Inactive') {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?> > <?php echo lang('in_active'); ?> 
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Image</label>
                                            <input type="file" name="img_url">
                                        </div>
                                        <input type="hidden" name="id" value='<?php
                                        if (!empty($gridsection->id)) {
                                            echo $gridsection->id;
                                        }
                                        ?>'>
                                        <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                    </form>
                                </div>
                            </section>
                        </div>  
                    </div> 
                </div>
            </div>
        </section>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->
