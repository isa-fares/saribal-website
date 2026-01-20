
    <div class="modal fade"  id="<?=((isset($id)) ? $id:null)?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
        <div class="modal-dialog modal-lg modal-center"  role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">

                    <h4 class="modal-title" id="exampleModalLabel"><?=((isset($title)) ? $title:null)?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea style="width: 100%; height: 110px;"><?=((isset($data)) ? $data:null)?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Kapat</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
