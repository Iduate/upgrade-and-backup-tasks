<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper site-min-height">
        <!-- page start-->
        <div class="col-md-12 row">
            <section class="col-md-10 row">
                <header class="panel-heading">
                    <?php echo lang('language'); ?> <?php echo lang('translation'); ?>
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                            <?php echo validation_errors(); ?>
                            <form role="form" action="settings/addLanguageTranslation" class="clearfix" method="post" enctype="multipart/form-data">
                                <table class="table table-striped table-hover table-bordered" id="editable-sample">
                                    <thead>
                                        <tr>

                                            <th><?php echo lang('name'); ?></th>
                                            <th><?php echo lang('translation'); ?></th>
                                        </tr>
                                    </thead><tbody>
                                        <?php foreach ($languages as $key => $value) {
                                            ?>
                                            <tr class="table-bordered">
                                                <td class="table-bordered">  
                                                    <div class="form-group">
                                                    <input type="text" class="form-control" name="index[]" id="exampleInputEmail1" value='<?php
                                                        echo $key;
                                                        ?>' placeholder="" readonly> </div>
                                                </td>
                                                <td class="table-bordered">
                                                    <div class="form-group">
                                                    <input type="text" class="form-control" name="value[]" id="exampleInputEmail1" value="<?php
                                                        echo $value;
                                                        ?>" placeholder="">  
                                                    </div> 
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td></td>
                                            <td> <button type="submit" name="submit" class="btn btn-info pull-right"><?php echo lang('submit'); ?></button></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                    <input type="hidden" name="id" value="<?php echo $languagename; ?>">



                                    </tfoot>
                                    <style>
                                        .table-bordered {
                                            border: 1px solid #ddd !important;
                                        }
                                    </style>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->
<!--footer start-->

<script src="common/js/codearistos.min.js"></script>
<script>
    $(document).ready(function () {
        $(".flashmessage").delay(3000).fadeOut(100);
    });
</script>
